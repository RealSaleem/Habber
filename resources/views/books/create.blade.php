@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Book</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Book Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 

        @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div>{{$error}}</div>
     @endforeach
     @endif
        </div> 
     <div class="col-md-12">
        <div class="card">
            <form action="{{ action('BooksController@store') }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">Add Book Info</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" id="title"  placeholder="Title">
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Author Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="author_name" value="{{ old('author_name') }}" id="author_name" placeholder="Author Name ">
                            <span class="text-danger">{{$errors->first('author_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Cover Type</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="cover_type" value="{{ old('cover_type') }}" id="cover_type" placeholder="Cover Type">
                            <span class="text-danger">{{$errors->first('cover_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">Description</label>
                        <div class="col-sm-9">
                            <input type="textarea" class="form-control" name="description" value="{{ old('description') }}" id="description" placeholder="Description">
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Book Language</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="book_language"  value="{{ old('book_language') }}" id="book_langauge" placeholder="Book language">
                            <span class="text-danger">{{$errors->first('book_language')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="price" id="price" value="{{ old('price') }}"  placeholder="Price ">
                            <span class="text-danger">{{$errors->first('price')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Isbn</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="isbn" value="{{ old('isbn') }}" id="isbn" placeholder="Isbn">
                            <span class="text-danger">{{$errors->first('isbn')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Total Pages</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="total_pages" value="{{ old('total_pages') }}" id="total
                            _pages" placeholder="Pages">
                            <span class="text-danger">{{$errors->first('total_pages')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantity</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="quantity" value="{{ old('quantity') }}" id="quantity" placeholder="Quantity">
                            <span class="text-danger">{{$errors->first('quantity')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Business </label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="business" id="business_id" >
                            @foreach($business as $b)
                            <option value="{{$b->id}}" > {{$b->name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('business')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Book Clubs</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="bookclub" id="bookclub_id" >
                            @foreach($bookClubs as $b)
                            <option value="{{$b->id}}" > {{$b->name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('bookclub')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Genres</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="genre[]" id="genre_id" multiple>
                            @foreach($genres as $g)
                            <option value="{{$g->id}}" > {{$g->title}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('genre')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Stock Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="stock_status"  id="status">
                                <option value="0" {{ (old('stock_status') == "0" ? "selected":"")}}>Not Available</option>
                                <option value="1" {{ (old('stock_status') == "1" ? "selected":"")}}>Available</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('stock_status')}}</span>
                        </div>
                     </div> 
                    <div class="form-group row">
                        <label for="image_url" class="col-sm-3 text-right control-label col-form-label">Image Url</label>
                        <div class="col-sm-9">
                        <input id="image_url" type="file" class="form-control" name="image_url">
                            <span class="text-danger">{{$errors->first('image_url')}}</span>
                        </div>
                    </div>                    
                    <div class="border-top">
                      <div class="card-body">
                       <a href="{{route('books.index')}}">
                        <button type="button" class=" btn btn-danger">
                            Cancel
                        </button></a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </div>
                </div>   
            </form>
        </div>
    </div>
</div>
                  
@endsection
