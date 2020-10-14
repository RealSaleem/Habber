@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New User</h2>
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
            <form action="{{action('UserController@store') }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">Add User Info</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">First Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="first_name" id="first_name"  placeholder="First Name Here">
                            <span class="text-danger">{{$errors->first('first_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Last Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="last_name" id="second_name" placeholder="Last Name Here">
                            <span class="text-danger">{{$errors->first('last_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password Here">
                            <span class="text-danger">{{$errors->first('password')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="email" id="email" placeholder="Email Here">
                            <span class="text-danger">{{$errors->first('email')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Contact No</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Contact No Here">
                            <span class="text-danger">{{$errors->first('phone')}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Role</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="role" id="roles">
                                @foreach($roles as $r)
                                    <option value="{{$r}}">{{$r}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{$errors->first('role')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profile_pic" class="col-sm-3 text-right control-label col-form-label">Picture</label>
                         <div class="col-md-6">
                         <input id="profile_pic" type="file" class="form-control" name="profile_pic">
                            <span class="text-danger">{{$errors->first('profile_pic')}}</span>
                        </div>
                        
                    </div> 
                </div>
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('users.index')}}">
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
