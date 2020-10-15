@extends('layouts.app')
@section('content')
<div class="row">
            <div class="col-lg-12 margin-tb">
              <div class="pull-left">
               <h2>Edit BookClub</h2>
               </div>
            </div>
            <div class="container-fluid">
              @if(Session::has('success'))
               <div class="alert alert-success text-center" role="alert">
                <strong>BookClub Edited! &nbsp;</strong>{{Session::get('success')}}
               </div>
                @endif   
            </div> 
    <div class="col-md-12">
        <div class="card">
                <form action="{{ action('BookClubController@update',[$bookclub->id])}}" method="POST"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">Edit BookClub Info</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ $bookclub->name }}">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="banner_image" class="col-sm-3 text-right control-label col-form-label">Banner Image</label>
                        <div class="col-sm-9">
                        <input id="banner_image" type="file" class="form-control" name="banner_image" >
                            <span class="text-danger">{{$errors->first('banner_image')}}</span>
                            @if(isset($bookclub->banner_image))
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <img class="form-control" style=" width: 100px; height: 100px;" src="{{ url('storage/'.$bookclub->banner_image)}}" alt="no-image">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('bookclubs.index')}}">
                        <button type="button" class=" btn btn-danger">
                            Cancel
                        </button></a>
                        <button type="submit" class="btn btn-primary">Update</button>
                         </div>
                     </div>    
                </div>
            </form>
        </div>
    </div>
</div>
                  
@endsection
