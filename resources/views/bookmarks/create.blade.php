@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Bookmarks</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Bookmarks Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
     
            
        </div> 
        <div class="col-md-12">
        <div class="card">
            <form action="{{action('BookmarksController@store') }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">Add Bookmarks Info</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}" id="title"  placeholder="Title">
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label"> Maker Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="maker_name" value="{{ old('maker_name') }}" id="maker_name" placeholder=" Maker Name">
                            <span class="text-danger">{{$errors->first('maker_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Description</label>
                        <div class="col-sm-9">
                            <input type="textarea" class="form-control" name="description" value="{{ old('description') }}" id="description" placeholder="Description">
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="price" value="{{ old('price') }}" id="price" placeholder="Price">
                            <span class="text-danger">{{$errors->first('price')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Bookmark ID </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="bookmark_id" value="{{ old('bookmark_id') }}" id="bookmark_id" placeholder="Bookmark Id ">
                            <span class="text-danger">{{$errors->first('bookmark_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Size</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="size"value="{{ old('size') }}" id="size" placeholder="Size">
                            <span class="text-danger">{{$errors->first('size')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantity</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="quantity" value="{{ old('quantity') }}" id="quantity" placeholder="Quantity ">
                            <span class="text-danger">{{$errors->first('quantity')}}</span>
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
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Business</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="business_id" id="business_id">
                            @foreach($business as $b)
                            <option value={{$b->id}} > {{$b->name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('business_id')}}</span>
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
                         <a href="{{route('bookmarks.index')}}">
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
