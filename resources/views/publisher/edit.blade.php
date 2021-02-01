@extends('layouts.app')
@section('content')
<div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>User Updated! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
         </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{action('PublisherController@update',[$publisher->id]) }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.publisher_page.edit_publisher_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.first_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $publisher->first_name}}">
                            <span class="text-danger">{{$errors->first('first_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.last_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="last_name" id="second_name" value="{{ $publisher->last_name}}">
                            <span class="text-danger">{{$errors->first('last_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.password')</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password" >
                            <span class="text-danger">{{$errors->first('password')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.email')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="email" id="email" value="{{ $publisher->email}}">
                            <span class="text-danger">{{$errors->first('email')}}</span>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.publisher_page.product_type')</label>
                        <div class="col-sm-9">
                        <select class="form-control" name="product_type"  id="status">
                                 <option value="both" {{ (($publisher->businesses['product_type'] == "both") ? "selected":"")}}> Both</option>
                                <option value="books" {{ (($publisher->businesses['product_type'] == "books") ? "selected":"")}}>Books</option>
                                <option value="bookmarks" {{ (($publisher->businesses['product_type'] == "bookmarks") ? "selected":"")}}> Bookmarks</option>
                        </select>   
                            <span class="text-danger">{{$errors->first('product_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.publisher_page.operating_country')</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="country" id="country" >
                            @foreach($country as $c)
                            <option value="{{$c->id}} {{ ($publisher->country == $c->id ? "selected" : "")}}"  > {{$c->name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('country')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.publisher_page.status')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status"  id="status">
                                <option value="0" {{ ($publisher->status == 0 ? "selected":"")}}>Deactivate</option>
                                <option value="1" {{ ($publisher->status == 1 ? "selected":"")}}>Activate</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        </div>
                     </div>  
                     <div class="form-group row">
                          <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.picture')</label>
                          <div class="controls">
                            <input type="file" name="profile_pic" id="profile_pic">
                            <span class="text-danger">{{$errors->first('profile_pic')}}</span>
                            @if(isset($publisher->profile_pic))
                              <div class="form-group row">
                                  <div class="col-sm-9">
                                    <img class="form-control" style=" width: 100px; height: 100px;" src="{{ url('storage/'.$publisher->profile_pic)}}" alt="image">
                                  </div>
                               </div>
                            @endif
                    </div>  
                      
                         </div>
                        
                    </div> 
                  </div>
                    <div class="border-top">
                       <div class="card-body">
                        <a href="/">
                        <button type="button" class=" btn btn-danger">
                        @lang('messages.button.back')
                        </button></a>
                        <button type="submit" class="btn btn-primary"> @lang('messages.button.update')</button>
                        </div>
                     </div>
                </div>     
            </form>
        </div>
    </div>
</div>                 
@endsection
