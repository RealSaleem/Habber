<?php

namespace App\Http\Controllers;
use App\Book;
use App\Business;
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
        $book = Book::with('businesses')->get();
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
            'isbn' => 'required|numeric|unique:books',  
            'total_pages' => 'required|numeric',
            'quantity' => 'required|numeric',
            'business_id' => 'required',
            'stock_status' => 'required',
            'image_url'=> 'required|image|mimes:jpg,jpeg,png|max:2048', 
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
            $book->business_id = $request->business_id;
            $book->stock_status = $request->stock_status;
            $book->image_url = "null"; 
            $book->save();
            $updatebook = Book::find($book->id);
            $file = $request->image_url;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "books/".$book->id."/".$fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $updatebook->image_url = $filePath;
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
        $book = Book::findOrFail($id);
        $business = Business::all();
        return view('books.edit', compact('book','business'));
 
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
            'business_id' => 'required',  
            'stock_status' => 'required',
            'image_url' => 'sometimes|required|image|mimes:jpg,jpeg,png|max:2048' 
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
        $book->stock_status = $request->stock_status;
        if($request->has('image_url')) 
        {
            Storage::disk('public')->deleteDirectory('books/'. $id);
            $file = $request->image_url;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "books/".$id."/" . $fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $book->image_url =  $filePath;
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
        $book->delete();
        return back()->with('success', 'User deleted successfully');
    
    }
}
