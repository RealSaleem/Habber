@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.site_setting_page.edit_site_setting')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Setting Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{action('SiteSettingController@update',[$sitesetting->id]) }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.site_setting_page.edit_site_setting_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.site_setting_page.email')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="email"  value="{{ $sitesetting->email }}" >
                            <span class="text-danger">{{$errors->first('email')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.site_setting_page.currency')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="currency" value="{{ $sitesetting->currency }}">
                            <span class="text-danger">{{$errors->first('currency')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.site_setting_page.language')</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="language" id="language" >
                        @foreach($language as $l)
                            <option value="{{$l->id}}" {{ ($sitesetting->language == $l->id ? "selected" : "")}} > {{$l->name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('language')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.site_setting_page.phone_no')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="phone_no" value="{{$sitesetting->phone_no }}">
                            <span class="text-danger">{{$errors->first('phone_no')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.site_setting_page.whatsaap_no')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="whatsaap_number" value="{{ $sitesetting->whatsaap_number }}">
                            <span class="text-danger">{{$errors->first('whatsaap_number')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.site_setting_page.twitter_url')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="twitter_url" value="{{ $sitesetting->twitter_url }}" >
                            <span class="text-danger">{{$errors->first('twitter_url')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.site_setting_page.facebook_url')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="facebook_url" value="{{$sitesetting->facebook_url}}">
                            <span class="text-danger">{{$errors->first('facebook_url')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.site_setting_page.instagram_url')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="instagram_url" value="{{ $sitesetting->instagram_url }}">
                            <span class="text-danger">{{$errors->first('instagram_url')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.site_setting_page.snapchat_url')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="snapchat_url" value="{{ $sitesetting->snapchat_url}}">
                            <span class="text-danger">{{$errors->first('snapchat_url')}}</span>
                        </div>
                    </div>
                    <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('sitesetting.index')}}">
                        <button type="button" class=" btn btn-danger">
                        @lang('messages.button.back')
                        </button></a>
                        <button type="submit" class="btn btn-primary">@lang('messages.button.update')</button>
                       </div>
                    </div>
                </div>   
            </form>
        </div>
    </div>
</div>
                  
@endsection