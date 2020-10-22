<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $user = User::all()->except(auth()->user()->id);
        return view('users.index', compact('user'));
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
        $file = $request->profile_pic;
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filePath = "user/" . $fileName . time() . "." . $file->getClientOriginalExtension();
        $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
        $user->profile_pic = $filePath;
        $user->save();   
        $user->assignRole($request->input('roles'));
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
        $user = User::findOrFail($id);
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
            'password' => 'sometimes|required|min:8',
            'phone' => 'sometimes|required|numeric',  
            'profile_pic' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'role' => 'required'
        ]);
       
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        if($request->has('profile_pic')) 
        {
            Storage::disk('user_profile')->deleteDirectory('users/' . $id);
            $file = $request->profile_pic;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath =  "users/".$id."/". $fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('user_profile')->put( $filePath, file_get_contents($file));
            $user->profile_pic =  $filePath;
          
        }
        $user->assignRole($request->input('roles'));
        $user->save();   
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
        Storage::disk('user_profile')->deleteDirectory('users/' . $id);
        $user = User::findOrFail($id);
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