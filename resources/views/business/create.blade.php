@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.business_page.add_new_business')</h2>
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
                    <h4 class="card-title">@lang('messages.business_page.add_business_info')</h4>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.business_page.user')</label>
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
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.business_page.name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name"value="{{ old('name') }}" id="name" placeholder=" Name ">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.business_page.business_type')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="business_type" value="{{ old('business_type') }}" id="business_type" placeholder="Business Type">
                            <span class="text-danger">{{$errors->first('business_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.business_page.product_type')</label>
                        <div class="col-sm-9">
                            <input type="textarea" class="form-control" name="product_type"value="{{ old('product_type') }}" id="product_type" placeholder="Product Type">
                            <span class="text-danger">{{$errors->first('product_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.business_page.details')</label>
                        <div  class="col-sm-9">
                         <textarea class="form-control" id="details" name="details" value="{{ old('details') }}" rows="4" cols="54" style="resize:none, " placeholder= "Details"  ></textarea>
                            <span class="text-danger">{{$errors->first('details')}}</span>
                        </div>
                    </div>
                    <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('business.index')}}">
                        <button type="button" class=" btn btn-danger">
                        @lang('messages.button.cancel')
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
