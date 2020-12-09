@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.country_page.edit_country')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Country Edited! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
        <form  action="{{ action('CountryController@update',[$country->id])}}" method="POST" enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.country_page.edit_country_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.country_page.iso')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="iso"id="iso" value="{{ $country->iso }}">
                            <span class="text-danger">{{$errors->first('iso')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.country_page.name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" value="{{ $country->name }}">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.country_page.nicename')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nicename" id="nicename" value="{{ $country->nicename }}">
                            <span class="text-danger">{{$errors->first('nicename')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.country_page.iso3')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="iso3" id="iso3" value="{{ $country->iso3 }}">
                            <span class="text-danger">{{$errors->first('iso3')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.country_page.numcode')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="numcode"id="numcode" value="{{ $country->numcode}}">
                            <span class="text-danger">{{$errors->first('numcode')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.country_page.phonecode')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="phonecode"id="phonecode" value="{{ $country->phonecode }}">
                            <span class="text-danger">{{$errors->first('phonecode')}}</span>
                        </div>
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