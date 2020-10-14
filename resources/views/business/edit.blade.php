@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Edit Business</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Business Edited! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
        <div class="col-md-12">
        <div class="card">
        <form  action="{{ action('BusinessController@update',[$business->id])}}" method="POST" enctype="multipart/form-data" >   
                {{ csrf_field() }}     
                  @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">Edit Business Info</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">User </label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="user_id" id="user_id" >
                            @foreach($user as $u)
                            <option value="{{$u->id}} {{ ($business->user_id == $u->id ? "selected" : "")}}"  > {{$u->first_name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name"value="{{ $business->name }}"  placeholder="Author Name Here">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Business Type</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="business_type" value="{{ $business->business_type }}" placeholder="Business Here">
                            <span class="text-danger">{{$errors->first('business_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">Product Type</label>
                        <div class="col-sm-9">
                            <input type="textarea" class="form-control" name="product_type"  value="{{ $business->product_type }}" placeholder="Product Here">
                            <span class="text-danger">{{$errors->first('product_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Details</label>
                        <div class="col-sm-9">
                        <textarea class="form-control" id="details" name="details" rows="4" cols="54" style="resize:none," value=""  >{{ $business->details }}</textarea>
                            <span class="text-danger">{{$errors->first('details')}}</span>
                        </div>
                    </div>
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('business.index')}}">
                        <button type="button" class=" btn btn-danger">
                            Cancel
                        </button></a>
                        <button type="submit" class="btn btn-primary">Update </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                  
@endsection
