<?php

namespace App\Http\Controllers;
use App\RequestForBook;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
        $userrequest =RequestForBook::with('users')->get();
        return view('user_requests.index', compact('userrequest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = User::where('id', '!=', 1)->get();
        return view('user_requests.create',compact('user'));
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
        //
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
        //
        $validatedData = $request->validate([
            'user_id'=> 'required',
            'title' => 'required',
            'author_name' => 'required',
            'book_type' => 'required',
            'image_url'=> 'required|image|mimes:jpg,jpeg,png|max:2048', 
            ]);
            $userrequest=  RequestForBook::find($id);
            $userrequest->user_id = $request->user_id;
            $userrequest->title = $request->title;
            $userrequest->author_name = $request->author_name;
            $userrequest->book_type= $request->book_type;
            if($request->has('image')) 
            {   
              Storage::disk('public')->deleteDirectory('user_requests/'. $id);
               $file = $request->image;
               $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
               $filePath = "user_requests/".$id."/".$fileName . time() . "." . $file->getClientOriginalExtension();
               $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
               $userrequest->image =  $filePath;
            }
        
              $userrequest->save();   
               return back()->with('success', 'User Request updated sucessfully');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Storage::disk('public')->deleteDirectory('user_requests/'. $id);
        $userrequest = RequestForBook::findOrFail($id);
        $userrequest->delete();
        return back()->with('success', 'User Request deleted successfully');
    }
}
