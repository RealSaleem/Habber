<?php

namespace App\Http\Controllers;
use App\BookClub;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookClubController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:book-club-list|book-club-create|book-club-edit|book-club-delete', ['only' => ['index','show']]);
        $this->middleware('permission:book-club-create', ['only' => ['create','store']]);
        $this->middleware('permission:book-club-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:book-club-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bookclub = BookClub::with('books')->get();
        return view('bookclubs.index', compact('bookclub'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $book = Book::all();
        return view('bookclubs.create',compact('book'));

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
            'name' => 'required', 
            'arabic_name' => 'required', 
            'book'=>'required',
            'status'=>'required',
            'featured'=>'required',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png|dimensions:max_width=200,max_height=200',
        ]);
        $bookclub = new BookClub();
        $bookclub->name = $request->name;
        $bookclub->arabic_name = $request->arabic_name;
        $bookclub->book_id = $request->book;
        $bookclub->featured =$request->featured;
        $bookclub->status =$request->status;
        $bookclub->banner_image = "null"; 
        $bookclub->save();
        $updatebookclub = BookClub::find($bookclub->id);
        $file = $request->banner_image;
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filePath = "bookclubs/".$bookclub->id."/". $fileName . time() . "." . $file->getClientOriginalExtension();
        $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
        $updatebookclub->banner_image = $filePath;
        $updatebookclub->update();   
        return back()->with('success', 'Bookclub successfully saved');
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
        $bookclub = BookClub::findOrFail($id);
        $book = Book::all();
        return view('bookclubs.edit', compact('bookclub','book'));
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
            'name' => 'required', 
            'arabic_name' => 'required', 
            'book'=>'required',
            'featured'=>'required',
            'status'=>'required',
            'banner_image' => 'sometimes|required|image|mimes:jpg,jpeg,png|dimensions:max_width=200,max_height=200',
        ]);
        $bookclub = BookClub::find($id);
        $bookclub->name = $request->name;
        $bookclub->arabic_name = $request->arabic_name;
        $bookclub->book_id = $request->book;
        $bookclub->featured=$request->featured;
        $bookclub->status =$request->status;
        if($request->has('banner_image')) 
        {   
            Storage::disk('public')->deleteDirectory('bookclubs/'. $id);
            $file = $request->banner_image;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "bookclubs/".$id."/".$fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $bookclub->banner_image =  $filePath;
        }
        
        $bookclub->save();   
        return back()->with('success', 'Bookclub updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Storage::disk('public')->deleteDirectory('bookclubs/'. $id);
        $bookclub = BookClub::findOrFail($id);
        $bookclub->delete();
        return back()->with('success', 'Bookclub deleted successfully');
    }
    public function deactivateBookclub($id) {
        $error = false;
        try {
            $bookclub = BookClub::findOrFail($id);
            $bookclub->status = false;
            $bookclub->save();
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

    public function activateBookclub($id) {
        $error = false;
        try {
            $bookclub = BookClub::findOrFail($id);
            $bookclub->status = true;
            $bookclub->save();
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

        public function notfeatureBookclub($id) {
            $error = false;
            try {
                $bookclub = BookClub::findOrFail($id);
                $bookclub->featured = false;
                $bookclub->save();
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
    
        public function featureBookclub($id) {
            $error = false;
            try {
                $bookclub = BookClub::findOrFail($id);
                $bookclub->featured = true;
                $bookclub->save();
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

