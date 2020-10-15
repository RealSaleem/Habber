@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New User Request</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>User Request Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
        <div class="col-md-12">
        <div class="card">
            <form action="{{ action('UserRequestController@store') }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">Add User Request Info</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">User</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="user_id" id="user_id">
                                @foreach($user as $u )
                                <option value="{{$u->id}}" > {{$u->first_name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{$errors->first('user_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title"value="{{ old('title') }}" id="title" placeholder="Title">
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Author Name </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="author_name" value="{{ old('author_name') }}" id="author_name" placeholder="Author Name">
                            <span class="text-danger">{{$errors->first('author_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">Book Type</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="book_type" value="{{ old('book_type') }}" id="book_type" placeholder="Book Type">
                            <span class="text-danger">{{$errors->first('book_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-3 text-right control-label col-form-label">Image</label>
                         <div class="col-md-6">
                         <input id="image" type="file" class="form-control" name="image">
                            <span class="text-danger">{{$errors->first('image')}}</span>
                        </div>
                    </div> 
                </div>
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('user_requests.index')}}">
                        <button type="button" class=" btn btn-danger">
                            Cancel
                        </button></a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                  
@endsection
