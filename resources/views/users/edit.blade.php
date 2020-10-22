@extends('layouts.app')
@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.user_page.edit_user')</h2>
        </div>
        </div>
        <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>User Edited! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
                <form  action="{{ action('UserController@update',[$user->id])}}" method="POST" enctype="multipart/form-data" >   
                {{ csrf_field() }}     
                @method('PUT')
                <input type="hidden" name="_method" value="PUT">     
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.user_page.edit_user_info')</h2>
        </div></h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.first_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"name="first_name"  value="{{ $user->first_name }}" placeholder="First Name Here">
                            <span class="text-danger">{{$errors->first('first_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.last_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" placeholder="Last Name Here">
                            <span class="text-danger">{{$errors->first('last_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.password')</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password"  value="{{ $user->password }}"  placeholder="Password Here">
                            <span class="text-danger">{{$errors->first('password')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.contact_no')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="phone"  value="{{$user->phone }}"  placeholder="Contact No Here">
                            <span class="text-danger">{{$errors->first('phone')}}</span>
                        </div>
                    </div>
                     <div class="form-group row">
                  
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.role')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="role" id="roles">
                                @foreach($roles as $r)
                                    <option value="{{$r}}" {{!isset($user->roles[0]) ? "" : ($user->roles[0]->name ? "selected" : "")}} >{{$r}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{$errors->first('role')}}</span>
                        </div>
                      </div>
                       <div class="form-group row">
                          <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.picture')</label>
                          <div class="controls">
                            <input type="file" name="profile_pic" id="profile_pic">
                            <span class="text-danger">{{$errors->first('profile_pic')}}</span>
                            @if(isset($user->profile_pic))
                              <div class="form-group row">
                                  <div class="col-sm-9">
                                    <img class="form-control" style=" width: 100px; height: 100px;" src="{{ url('storage/'.$user->profile_pic)}}" alt="image">
                                  </div>
                               </div>
                            @endif
                          </div>  
                      
                         </div>
                   
                    </div>
                     <div class="border-top">
                        <div class="card-body">
                        <a href="{{route('users.index')}}">
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