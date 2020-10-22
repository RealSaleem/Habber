@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.language_page.add_new_language')</h2>
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
            <form action="{{action('LanguageController@store') }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.language_page.add_language_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.language_page.name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="language" value="{{ old('language') }}" id="name"  placeholder="Name ">
                            <span class="text-danger">{{$errors->first('language')}}</span>
                        </div>
                    </div>
                    <div class="border-top">
                      <div class="card-body">
                         <a href="{{route('languages.index')}}">
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