@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Business</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Business Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
        <div class="col-md-12">
        <div class="card">
            <form action="{{action('BusinessController@store') }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">Add Business Info</h4>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">User ID</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="user_id" id="user_id">
                            @foreach($user as $u)
                            <option value={{$u->id}} > {{$u->name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('user_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" placeholder=" Name ">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Business Type</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="business_type" id="business_type" placeholder="Business Type">
                            <span class="text-danger">{{$errors->first('business_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">Product Type</label>
                        <div class="col-sm-9">
                            <input type="textarea" class="form-control" name="product_type" id="product_type" placeholder="Product Type">
                            <span class="text-danger">{{$errors->first('product_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Details</label>
                        <div  class="col-sm-9">
                         <textarea class="form-control" id="details" name="details" rows="4" cols="54" style="resize:none, " placeholder= "Details"  ></textarea>
                            <span class="text-danger">{{$errors->first('details')}}</span>
                        </div>
                    </div>
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('business.index')}}">
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