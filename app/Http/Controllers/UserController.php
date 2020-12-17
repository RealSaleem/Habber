<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Book;
use App\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);

        $this->middleware('permission:join-us-create', ['only' => ['allJoinUsRequest','store']]);
        $this->middleware('permission:join-us-list', ['only' => ['showJoinUsRequest']]);
        $this->middleware('permission:join-us-delete', ['only' => ['destroyRequest']]);        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $users = User::with('languages','currencies','roles')->get()->except(auth()->user()->id);  
        return view('users.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'phone' => 'required|numeric', 
            'profile_pic' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'role' => 'required'
        ]);
            
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->profile_pic = "null"; 
        $user->currency_id = 1;
        $user->language_id = 1;
        $user->save();   
        $user->assignRole($request->input('role'));
        $updateUser = User::find($user->id);
        $file = $request->profile_pic;
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filePath = "users/".$user->id."/". $fileName . time() . "." . $file->getClientOriginalExtension();
        $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
        $updateUser->profile_pic = $filePath;
        $updateUser->update();
     
        return back()->with('success', 'User successfully saved');

    }
    
    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
  

    }
    
    public function allJoinUsRequest()
    {
        $user = User::with('businesses')->where('joining_request',1)->get();
        return view('join_us.index',compact('user'));
    }

    public function showJoinUsRequest($id)
    {
        $user = User::with('businesses')->find($id);
        return view('join_us.detail',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::with('roles')->findOrFail($id);
        // dd($user);
        $roles = Role::pluck('name','name')->all();
        return view('users.edit', compact('user','roles'));
    

    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'first_name' => 'sometimes|required',
            'last_name' => 'sometimes|required',
            'password' => 'required|min:8',
            'phone' => 'sometimes|required|numeric',  
            'profile_pic' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required'
        ]);
       
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->currency_id = 1;
        $user->language_id = 1;
        if($request->has('profile_pic')) 
        {
            Storage::disk('user_profile')->deleteDirectory('users/' . $id);
            $file = $request->profile_pic;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath =  "users/".$id."/". $fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('user_profile')->put( $filePath, file_get_contents($file));
            $user->profile_pic =  $filePath;
          
        }
        $user->save();   
        $user->syncRoles($request->input('role'));
        // dd($user);
        return back()->with('success', 'User updated sucessfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = User::role('admin')->first();
        Storage::disk('user_profile')->deleteDirectory('users/' . $id);
        $user = User::with('books')->findOrFail($id);
     
        $userBooks = $user->books->pluck('id');
     
        $userBookmarks = $user->bookmarks->pluck('id');
     
        if(count($userBooks) > 1 ) {
            Book::whereIn('id',$userBooks )->update(['user_id'=> $admin->id]);
        }
        else if(count($userBooks) > 0 && count($userBooks) < 2) {
            Book::where('id',$userBooks[0] )->update(['user_id'=> $admin->id]);
        }
        if(count($userBookmarks) > 1 ) {
            Bookmark::whereIn('id',$userBookmarks )->update(['user_id'=> $admin->id]);
        }
        else if(count($userBookmarks) > 0 && count($userBookmarks) < 2) {
            Bookmark::where('id',$userBookmarks[0] )->update(['user_id'=> $admin->id]);  
        }        
        $user->delete();
        return back()->with('success', 'User deleted successfully');   
    } 
    

    public function destroyRequest($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User Request deleted successfully');
        
    }

    public function updateRequest(Request $request,$id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->update();
        return back()->with('success', 'User Request Updated successfully');
        
    }
    public function deactivateUser($id) {
        $error = false;
        try {
            $user = User::findOrFail($id);
            $user->status = false;
            $user->save();
            return 'true';
        }
        catch(\Exception $e) {
            $error = true;
            $message = $e->getMessage(); 
        }
        if($error) {
            return $message;
        }

    }

    public function activateUser($id) {
        $error = false;
        try {
            $user = User::findOrFail($id);
            $user->status = true;
            $user->save();
            return 'true';
        }
        catch(\Exception $e) {
           $error = true;
           $message = $e->getMessage(); 
        }
        if($error) {
            return $message;
        }

    }
    
}