<?php

namespace App\Http\Controllers;
use App\Book;
use App\Currency;
use App\BookClub;
use App\Genre;
use App\Business;
use App\Language;
use App\User;
use Session;
use App\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:book-list|book-create|book-edit|book-delete', ['only' => ['index','show']]);
        $this->middleware('permission:book-create', ['only' => ['create','store']]);
        $this->middleware('permission:book-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:book-delete', ['only' => ['destroy']]);
    }
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
        $genres = Genre::where('title','!=','General')->get();
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
        
        $genId = Genre::where('title','General')->first();      
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
            'status'=>'required',
            "genre" => 'required|array|min:1|max:3',
            'image'=> 'required|image|mimes:jpg,jpeg,png|dimensions:max_width=280,max_height=470'
            ]);
            $book = new Book();
            $book->title = $request->title;
            $book->author_name = $request->author_name;
            $book->cover_type= $request->cover_type;
            $book->description= $request->description;
            $book->book_language= $request->book_language;
            $book->isbn = $request->isbn;
            $book->total_pages= $request->total_pages;
            $book->quantity = $request->quantity;
            $book->user_id = $request->publisher;
            $book->added_by =auth()->user()->id;
            $book->stock_status = $request->stock_status;
            if($request->has('featured') && $request->featured == "1") {
                $featuredBooks = Book::where('featured',1)->count();
                if($featuredBooks == 8) {
                    $book->featured = 0; 
                    Session::flash('featured', 'Book Cannot Be Featured You can only feature 8 books at a time!'); 
                }
                else {
                    $book->featured = $request->featured;
                }
            }
            else {
                $book->featured = $request->featured;
            }
            $book->book_club_id = $request->bookclub;
            $book->status =  $request->status;
            $book->image = "null"; 
            $book->save();
            $updatebook = Book::find($book->id);
            if($request->has('genre')) {
                $genres = $request->genre;
                array_push($genres, (string) $genId->id);
                $book->genres()->sync($genres);
            }
            $file = $request->image;
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = "books/".$book->id."/".$fileName . time() . "." . $file->getClientOriginalExtension();
            $store = Storage::disk('public')->put( $filePath, file_get_contents($file));
            $updatebook->image = $filePath;
            $updatebook->update();
            for($i=1;$i<=Count(Currency::all());$i++){   
            $productPrice= new ProductPrice();
            $productPrice->product_id= $book->id;
            $productPrice->product_type= 'book';
            $productPrice->price =$request->price;
            $productPrice->currency_id= $i;
            $productPrice->save();}

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
        $book = Book::with('bookAddedBy')->findOrFail($id);
        return view('books.detail',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::with(['book_clubs','genres','product_prices'])->where('id',$id)->first();
        $selectedGenres = $book->genres->pluck('id')->toArray();
        $user = User::role('publisher')->get();
        $bookClubs = BookClub::all();
        $genres = Genre::where('title','!=','General')->get();
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
        $genId = Genre::where('title','General')->first();     
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
            'status'=> 'required',
            'genre' => 'required|array|min:1|max:3',
            'image' => 'sometimes|required|image|mimes:jpg,jpeg,png|dimensions:max_width=280,max_height=470'
        ]);
       
        $book = Book::find($id);
        $book->title = $request->title;
        $book->author_name = $request->author_name;
        $book->cover_type= $request->cover_type;
        $book->description= $request->description;
        $book->book_language = $request->book_language;
        $book->isbn = $request->isbn;
        $book->total_pages= $request->total_pages;
        $book->quantity= $request->quantity;
        $book->user_id = $request->publisher;
        $book->book_club_id = $request->bookclub;
        $book->stock_status = $request->stock_status;
        if($request->has('featured') && $request->featured == "1") {
            $featuredBooks = Book::where('featured',1)->count();
            if($featuredBooks == 8) {
                $book->featured = 0; 
                Session::flash('featured', 'Book Cannot Be Featured You can only feature 8 books at a time!'); 
            }
            else {
                $book->featured = $request->featured;
            }
        }
        else {
            $book->featured = $request->featured;
        }
        $book->status = $request->status;
        if($request->has('genre')) {
            if(count($book->genres) + count($request->genre) > 4 ) {
                $genre_id = $book->genres()->pluck('genre_id');
                $book->genres()->detach($genre_id);
                $genres = $request->genre;
                array_push($genres, (string) $genId->id);
                $book->genres()->sync($genres);
            }
            else {
               
                $book->genres()->sync($request->genre);
            }
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
        if($request->has('price'))
        {
            $productPrice= ProductPrice::where('product_id',$id)->where('product_type','book')->first();
            //$productPrice->product_type= 'book';
            $productPrice->price =$request->price;
            $productPrice->currency_id= 1;
            $productPrice->update();
        }
       
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
        return back()->with('success', 'Book deleted successfully');
    
    } 
    public function deactivateBook($id) {
        $error = false;
        try {
            $bookmark = Book::findOrFail($id);
            $bookmark->status = false;
            $bookmark->save();
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

    public function activateBook($id) {
        $error = false;
        try {
            $bookmark = Book::findOrFail($id);
            $bookmark->status = true;
            $bookmark->save();
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
