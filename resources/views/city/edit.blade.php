@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.city_page.edit_city')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>State Edited! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
        <form  action="{{ action('CityController@update',[$city->id])}}" method="POST" enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.city_page.edit_city_info')</h4>
                    <div class="card-body">
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.city_page.name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{$city->name}}" id="name"  placeholder="Name ">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.country')</label>
                        <div class="col-sm-9">
                            <select  class="form-control" name="country" id="country_id" required>
                            <option value="" disabled selected> select country</option>
                                @foreach($country as $c )
                                <option value="{{$c->id}}" {{ ($city->country_id == $c->id ? "selected" : "")}}> {{$c->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{$errors->first('country')}}</span>
                        </div>
                    </div>
                    <div class="border-top">
                      <div class="card-body">
                         <a href="{{route('countries.index')}}">
                           <button type="button" class=" btn btn-danger">
                           @lang('messages.button.back')
                          </button></a>
                          <button type="submit" class="btn btn-primary">  @lang('messages.button.update')</button>
                      </div>
                    </div>
                </div>   
            </form>
        </div>
    </div>
</div>
                  
@endsection