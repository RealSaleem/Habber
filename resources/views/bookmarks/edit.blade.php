@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Edit Bookmarks</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Bookmarks Edited! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
        <div class="col-md-12">
        <div class="card">
            <form action="{{ action('BookmarksController@update',[$bookmark->id])}}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">Edit Bookmarks Info</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title" value="{{ $bookmark->title }}">
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label"> Maker Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="maker_name" value="{{ $bookmark->maker_name }}">
                            <span class="text-danger">{{$errors->first('maker_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                        <div class="col-sm-9">
                            <input type="textarea" class="form-control" name="description" value="{{ $bookmark->description }}">
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="price" value="{{ $bookmark->price}}">
                            <span class="text-danger">{{$errors->first('price')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Bookmark ID</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="bookmark_id" value="{{ $bookmark->bookmark_id }}">
                            <span class="text-danger">{{$errors->first('bookmark_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Size</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="size" value="{{ $bookmark->size }}">
                            <span class="text-danger">{{$errors->first('size')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantity</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="quantity" value="{{ $bookmark->quantity }}">
                            <span class="text-danger">{{$errors->first('quantity')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Business ID </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="business_id" value="{{ $bookmark->business_id }}">
                            <span class="text-danger">{{$errors->first('business_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image_url" class="col-sm-3 text-right control-label col-form-label">Image Url</label>
                        <div class="col-sm-9">
                        <input id="image_url" type="file" class="form-control" name="image_url" >
                            <span class="text-danger">{{$errors->first('image_url')}}</span>
                            @if(isset($bookmark->image_url))
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <img class="form-control" style=" width: 100px; height: 100px;" src="{{ url('storage/'.$bookmark->image_url)}}" alt="no-image">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('bookmarks.index')}}">
                        <button type="button" class=" btn btn-danger">
                            Cancel
                        </button></a>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                  
@endsection