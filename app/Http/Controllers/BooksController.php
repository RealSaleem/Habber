<?php

namespace App\Http\Controllers;
use App\Book;
use App\Business;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::all();
        return view('books.index', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $business = Business::all();
        return view('books.create',compact('business'));
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
            'isbn' => 'required',
            'total_pages' => 'required|numeric',
            'quantity' => 'required|numeric',
            'business_id' => 'required',   
        ]);
        $book = new Book();
        $book->title = $request->title;
        $book->author_name = $request->author_name;
        $book->cover_type= $request->cover_type;
        $book->description= $request->description;
        $book->book_language = $request->book_language;
        $book->price = $request->price;
        $book->isbn = $request->isbn;
        $book->total_pages= $request->total_pages;
        $book->quantity= $request->quantity;
        $book->business_id = $request->business_id;
        $book->save();   
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
        //
        $user = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    
      
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
            'isbn' => 'required',
            'total_pages' => 'required|numeric',
            'quantity' => 'required|numeric',
            'business_id' => 'required',   
        ]);
        $book = Book::find($id);
        $book->title = $request->title;
        $book->author_name = $request->author_name;
        $book->cover_type= $request->cover_type;
        $book->description= $request->description;
        $book->book_language = $request->book_language;
        $book->price = $request->price;
        $book->isbn = $request->isbn;
        $book->total_pages= $request->total_pages;
        $book->quantity= $request->quantity;
        $book->business_id = $request->business_id;
        $book->save();   
        return back()->with('success', 'Book update successfully ');
   
   
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
        $book = Book::findOrFail($id);
        $book->delete();
        return back()->with('success', 'User deleted successfully');
    
    }
}
