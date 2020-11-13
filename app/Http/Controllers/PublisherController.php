<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Country;
use App\Business;
class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $publisher = $user = User::with('businesses')->role('publisher')->get();
        return view('publisher.index', compact('publisher'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publisher = User::all();
        $country = Country::all();
        return view('publisher.create',compact('publisher','country'));
    
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
            'product_type' => 'required', 
            'country'=> 'required',
            'profile_pic' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required'
        ]);
            
        $publisher = new User();
        $publisher->first_name = $request->first_name;
        $publisher->last_name = $request->last_name;
        $publisher->email = $request->email;
        $publisher->password = Hash::make($request->password);
        $publisher->country_id = $request->country;
        $publisher->profile_pic = "null"; 
        $publisher->save();
        $publisher->assignRole('publisher');
        $updatePublisher = User::find($publisher->id);
        $file = $request->profile_pic;
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filePath = "users/".$publisher->id."/". $fileName . time() . "." . $file->getClientOriginalExtension();
        $store = Storage::disk('user_profile')->put( $filePath, file_get_contents($file));
        $updatePublisher->profile_pic = $filePath;
        $updatePublisher->update();
        $business= new Business();
        $business->user_id = $publisher->id;
        $business->name = $publisher->first_name .' '.$publisher->last_name;
        $business->product_type= $request->product_type;
        $business->business_type = 'individual';
        $business->save();
        return back()->with('success', 'Publisher successfully saved');
    }
    
    /**
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
  

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
      
        $publisher = User::findOrFail($id);
        $country= Country::all();

        return view('publisher.edit',compact('publisher','country'));

    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) 
    {
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:8',
            'product_type' => 'required', 
            'country'=> 'required',
            'profile_pic' => 'sometimes|required|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required'
        ]);
        $publisher = User::find($id);
        $publisher->first_name = $request->first_name;
        $publisher->last_name = $request->last_name;
        $publisher->email = $request->email;
        $publisher->password = Hash::make($request->password);
        $publisher->country_id = $request->country;
        if($request->has('profile_pic')) 
        {
            Storage::disk('user_profile')->deleteDirectory('users/' . $id);
            $file = $request->profile_pic;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath =  "users/".$id."/". $fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('user_profile')->put( $filePath, file_get_contents($file));
            $publisher->profile_pic =  $filePath;
          
        }
        $publisher->save();   
        if($request->has('product_type'))
        {
            $business = Business::where('user_id',$id)->first();
            $business->user_id = $publisher->id;
            $business->product_type= $request->product_type;
            $business->update();
        }
       
        // dd($user);
        return back()->with('success', 'Publisher updated sucessfully');

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
            $user->delete();
        }
        else if(count($userBooks) > 0 && count($userBooks) < 2) {
            Book::where('id',$userBooks[0] )->update(['user_id'=> $admin->id]);
            $user->delete();
        }
        // else {
        //     $user->delete();
        // }

        if(count($userBookmarks) > 1 ) {
            Bookmark::whereIn('id',$userBookmarks )->update(['user_id'=> $admin->id]);
            $user->delete();
        }
        else if(count($userBookmarks) > 0 && count($userBookmarks) < 2) {
            Bookmark::where('id',$userBookmarks[0] )->update(['user_id'=> $admin->id]);
            $user->delete();
        }
        // else {
        //     $user->delete();
        // }
        
      
        return back()->with('success', 'User deleted successfully');
    
        
    }

    public function deactivatePublisher($id) {
        $error = false;
        try {
            $publisher = Publisher::findOrFail($id);
            $publisherr->status = false;
            $publisher->save();
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

    public function activatePublisher($id) {
        $error = false;
        try {
            $publisher = Publisher::findOrFail($id);
            $publisher->status = true;
            $publisherr->save();
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