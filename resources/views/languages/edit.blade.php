@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.language_page.edit_language')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Language Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{action('LanguageController@update',[$language->id]) }}" method="POST"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.language_page.edit_language_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.language_page.name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="language" value="{{  $language->name }}" id="name"  placeholder="Name ">
                            <span class="text-danger">{{$errors->first('language')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.language_page.status')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status"  id="status">
                                <option selected disabled value>Select status</option>
                                <option value="0" {{ ($language->status == 0 ? "selected":"")}}>Not Active</option>
                                <option value="1" {{ ($language->status == 1 ? "selected":"")}}>Active</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        </div>
                     </div> 
                    <div class="border-top">
                      <div class="card-body">
                         <a href="{{route('languages.index')}}">
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