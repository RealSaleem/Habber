@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Addresses</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Address Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
        <div class="col-md-12">
        <div class="card">
            <form action="{{url('adressess.create')}}" method="post"  enctype="multipart/form-data">   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">Add Address Info</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Address Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address_name"  value="{{ old('address_name') }}" id="address_name"  placeholder="Address Name">
                            <span class="text-danger">{{$errors->first('address_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Address Line1</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address_line1"  value="{{ old('address_line1') }}" id="address_line1"  placeholder="Address Line1">
                            <span class="text-danger">{{$errors->first('address_line1')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Address Line2</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address_line2"  value="{{ old('address_line2') }}" id="address_line1"  placeholder="Address Line2">
                            <span class="text-danger">{{$errors->first('address_line2')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Country</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="country_id"  value="{{ old('country_id') }}" id="country_id"  placeholder="country_id">
                            <span class="text-danger">{{$errors->first('country_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">City</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="city"  value="{{ old('city') }}" id="city"  placeholder="City">
                            <span class="text-danger">{{$errors->first('city')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">State</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="state"  value="{{ old('state') }}" id="state"  placeholder="State">
                            <span class="text-danger">{{$errors->first('state')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Post Code</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="post_code"  value="{{ old('post_code') }}" id="post_code"  placeholder="Post Code">
                            <span class="text-danger">{{$errors->first('post_code')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Phone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone"  value="{{ old('phone') }}" id="phone"  placeholder="Phone">
                            <span class="text-danger">{{$errors->first('phone')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">User</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="user_id"  value="{{ old('user_id') }}" id="user_id"  placeholder="User">
                            <span class="text-danger">{{$errors->first('user')}}</span>
                        </div>
                    </div>
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('addressess.index')}}">
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
