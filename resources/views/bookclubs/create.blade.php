@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.bookclub_page.add_new_bookclub')</h2>
        </div>
    </div>
        <div class="container-fluid">
             @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>BookClub Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
              @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{action('BookClubController@store')}}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">Add BookClub Info</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name"  value="{{ old('name') }}" id="name"  placeholder="name">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="banner_image" class="col-sm-3 text-right control-label col-form-label">Banner Image</label>
                        <div class="col-sm-9">
                        <input id="banner_image" type="file" class="form-control" name="banner_image">
                            <span class="text-danger">{{$errors->first('banner_image')}}</span>
                        </div>
                    </div>
                     <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('bookclubs.index')}}">
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
