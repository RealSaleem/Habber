<?php

namespace App\Http\Controllers;
use App\RequestForBook;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Http\Request;


class UserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userRequest = RequestForBook::with('users')->get();
        return view('user_requests.index', compact('userRequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $userrequest = RequestForBook::first();
       
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'user_id'=> 'required',
            'title' => 'required',
            'author_name' => 'required',
            'book_type' => 'required',
            'image'=> 'required|image|mimes:jpg,jpeg,png|max:2048', 
            ]);
            $userrequest = new RequestForBook();
            $userrequest->user_id = $request->user_id;
            $userrequest->title = $request->title;
            $userrequest->author_name = $request->author_name;
            $userrequest->book_type= $request->book_type;
            $userrequest->image = "null"; 
            $userrequest->save();
            $updateuserrequest =RequestForBook::find($userrequest->id);
            $file = $request->image;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "user_requests/".$userrequest->id."/".$fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $updateuserrequest->image = $filePath;
            $updateuserrequest->update();   
            return back()->with('success', 'User Request successfully saved');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userRequest = RequestForBook::with('users')->find($id);
        return view('user_requests.detail', compact('userRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $userrequest = RequestForBook::findOrFail($id);
        $user = User::where('id', '!=', 1)->get();
        return view('user_requests.edit', compact('user_request','user'));
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
        $error = false;
        try{
            $userRequest = RequestForBook::find($id);
            $userRequest->status = $request->status;
            $userRequest->update();
            return back()->with('success', 'Status Updated Successfully!');
        }
        catch(\Exception $e) {
           
            $error = true;
            $message = $e->getMessage(); 
        }
        if($error) {
            return back()->with('success', $message);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $error = false;
        try{
            Storage::disk('public')->deleteDirectory('user_requests/' .  $id);
            $userRequest = RequestForBook::find($id);
            $userRequest->delete();
            return back()->with('success', 'Request Deleted Successfully!');
        }
        catch(\Exception $e) {
           
            $error = true;
            $message = $e->getMessage(); 
        }
        if($error) {
            return back()->with('success', $message);
        }
    }
}
