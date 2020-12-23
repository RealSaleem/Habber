@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.user_page.add_new_user')</h2>
        </div>
    </div>
        <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>User Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
         </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{ action('UserController@store') }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.user_page.add_user_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.first_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="first_name" id="first_name"  placeholder="First Name ">
                            <span class="text-danger">{{$errors->first('first_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.last_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="last_name" id="second_name" placeholder="Last Name ">
                            <span class="text-danger">{{$errors->first('last_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.password')</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password ">
                            <span class="text-danger">{{$errors->first('password')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.email')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email ">
                            <span class="text-danger">{{$errors->first('email')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.contact_no')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="phone" id="phone" placeholder="Contact No ">
                            <span class="text-danger">{{$errors->first('phone')}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.role')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="role" id="roles">
                            <option  disabled selected>Select Role</option>
                                @foreach($roles as $r)
                                    <option value="{{$r}}">{{$r}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{$errors->first('role')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profile_pic" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.picture') <br>
                         </label>
                         <div class="col-md-6" >
                         <input  id="profile_pic" type="file" class="form-control" name="profile_pic" >
                            <span class="text-danger">{{$errors->first('profile_pic')}}</span>
                        </div>
                        
                    </div> 
                  </div>
                    <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('users.index')}}">
                        <button type="button" class=" btn btn-danger">
                        @lang('messages.button.back')
                        </button></a>
                        <button type="submit" class="btn btn-primary"> @lang('messages.button.submit')</button>
                        </div>
                     </div>
                </div>     
            </form>
        </div>
    </div>
</div>
                  
@endsection
