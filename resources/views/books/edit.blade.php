@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Book</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Book Edited! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
        <div class="col-md-12">
        <div class="card">
        <form  action="{{ action('BooksController@update',[$book->id])}}" method="POST" enctype="multipart/form-data" >   
                {{ csrf_field() }}     
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">Edit Book Info</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title" id="title"  placeholder="Title">
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Author-Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="author_name" id="author_name" placeholder="Author Name Here">
                            <span class="text-danger">{{$errors->first('author_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Cover-type</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="cover_type" id="cover_type" placeholder="Cover Here">
                            <span class="text-danger">{{$errors->first('cover_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">Description</label>
                        <div class="col-sm-9">
                            <input type="textarea" class="form-control" name="description" id="description" placeholder="Description Here">
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Book-Language</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="book_langauge" id="book_langauge" placeholder="Book-language Here">
                            <span class="text-danger">{{$errors->first('book_langauge')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="price" id="price" placeholder="Price Here">
                            <span class="text-danger">{{$errors->first('price')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Isbn</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="isbn" id="isbn" placeholder="Isbn Here">
                            <span class="text-danger">{{$errors->first('isbn')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Total-Pages</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="total_pages" id="total_pages" placeholder="Page Here">
                            <span class="text-danger">{{$errors->first('total_pages')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantity</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity  Here">
                            <span class="text-danger">{{$errors->first('quantity')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Business Id</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="business_id" id="business_id" placeholder="Business Id Here">
                            <span class="text-danger">{{$errors->first('business_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Image url</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="image_url" id="image_url" placeholder="Image Url Here">
                            <span class="text-danger">{{$errors->first('image_url')}}</span>
                        </div>
                    </div>
                    
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('users.index')}}">
                        <button type="button" class=" btn btn-danger">
                            Cancel
                        </button></a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                  
@endsection
