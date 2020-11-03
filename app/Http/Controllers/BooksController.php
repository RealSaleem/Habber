<?php

namespace App\Http\Controllers;
use App\Book;
use App\BookClub;
use App\Genre;
use App\Business;
use App\Language;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::with(['book_clubs','users'])->get();
        return view('books.index', compact('book'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$business = Business::all();
        $bookClubs = BookClub::all();
        $genres = Genre::all();
        $language = Language::all();
        $user = User::role('publisher')->get();
        return view('books.create',compact('user','bookClubs','genres','language'));
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
        
            'title' => 'required',
            'author_name' => 'required',
            'cover_type' => 'required',
            'description' => 'required',
            'book_language' => 'required',
            'price' => 'required|numeric',
            'isbn' => 'required|numeric|unique:books',  
            'total_pages' => 'required|numeric',
            'quantity' => 'required|numeric',
            'publisher' => 'required',
            'stock_status' => 'required',
            'featured'=>'required',
            "genre" => 'required|array|min:1|max:3',
            'image'=> 'required|image|mimes:jpg,jpeg,png|dimensions:width=280,height=470|dimensions:ratio=1:1.33'
            ]);
            $book = new Book();
            $book->title = $request->title;
            $book->author_name = $request->author_name;
            $book->cover_type= $request->cover_type;
            $book->description= $request->description;
            $book->book_language= $request->book_language;
            $book->price =$request->price;
            $book->isbn = $request->isbn;
            $book->total_pages= $request->total_pages;
            $book->quantity =$request->quantity;
            $book->user_id = $request->publisher;
            $book->stock_status = $request->stock_status;
            $book->featured = $request->featured;
            $book->book_club_id = $request->bookclub;
            $book->status = true;
            $book->image = "null"; 
            $book->save();
            $updatebook = Book::find($book->id);
            $book->genres()->sync($request->genre);
            $file = $request->image;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "books/".$book->id."/".$fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $updatebook->image = $filePath;
            $updatebook->update();   
            return back()->with('success', 'Book successfully saved');
       
   
   
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
        $book = Book::with(['book_clubs','genres'])->where('id',$id)->first();
        $selectedGenres = $book->genres->pluck('id')->toArray();
        $user = User::role('publisher')->get();
        $bookClubs = BookClub::all();
        $genres = Genre::all();
        $language = Language::all();
        return view('books.edit', compact('book','bookClubs','user','genres','selectedGenres','language'));
 
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
            'title' => 'required',
            'author_name' => 'required',
            'cover_type' => 'required',
            'description' => 'required',
            'book_language' => 'required',  
            'price' => 'required|numeric',
            'isbn' => 'required|numeric|unique:books,isbn,'.$id,
            'total_pages' => 'required|numeric',
            'quantity' => 'required|numeric',
            'publisher' => 'required',
            'stock_status' => 'required',
            'featured'=>'required',
            'genre' => 'required|array|min:1|max:3',
             'image' => 'sometimes|required|image|mimes:jpg,jpeg,png|dimensions:width=280,height=470|dimensions:ratio=1:1.33'
        ]);
       
        $book = Book::find($id);
        // dd(count($book->genres) + count($request->genre) > 3);
        $book->title = $request->title;
        $book->author_name = $request->author_name;
        $book->cover_type= $request->cover_type;
        $book->description= $request->description;
        $book->book_language = $request->book_language;
        $book->price = $request->price;
        $book->isbn = $request->isbn;
        $book->total_pages= $request->total_pages;
        $book->quantity= $request->quantity;
        $book->user_id = $request->publisher;
        $book->book_club_id = $request->bookclub;
        $book->stock_status = $request->stock_status;
        $book->featured = $request->featured;
        $book->status = true;
        if(count($book->genres) + count($request->genre) > 3 ) {
            // dd($request->genre);
            $genre_id = $book->genres()->pluck('genre_id');
            $book->genres()->detach($genre_id);
            $book->genres()->sync($request->genre);
        }
        else {
           
            $book->genres()->sync($request->genre);
        }
        
        if($request->has('image')) 
        {
            Storage::disk('public')->deleteDirectory('books/'. $id);
            $file = $request->image;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "books/".$id."/" . $fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $book->image =  $filePath;
        }
        $book->save();   
        return back()->with('success', 'Book updated sucessfully');

   
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Storage::disk('public')->deleteDirectory('books/'. $id);
        $book = Book::findOrFail($id);
         $book->genres()->detach($id);
        $book->delete();
        return back()->with('success', 'User deleted successfully');
    
    } 
}
