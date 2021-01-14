@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.size_page.edit_size')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Size Edited! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
     <div class="col-md-12">
        <div class="card">
            <form action="{{ action('SizeController@update',[$size->id])}}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.size_page.edit_size_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.size')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="bookmark_size"  value="{{ $size->bookmark_size }}">
                            <span class="text-danger">{{$errors->first('bookmark_size')}}</span>
                        </div>
                    </div>
                    <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('sizes.index')}}">
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