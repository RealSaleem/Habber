@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.static_page.pageinfo')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Page Updated! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
        <div class="col-md-12">
        <div class="card">
        <form  action="{{ action('StaticPagesController@update',[$static_page->url])}}" method="post" enctype="multipart/form-data" >   
                {{ csrf_field() }}     
                @method('PUT') 
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.static_page.pageinfo')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.title')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" dir="{{ session()->get('locale') == 'ar' ? 'rtl' : ''}}" name="title" value="{{ $static_page->title}}" id="title"  placeholder="English Title">
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.static_page.arabictitle')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="arabic_title" dir="rtl" value="{{$static_page->arabic_title}}" id="arabic_title"  placeholder="Arabic Title">
                            <span class="text-danger">{{$errors->first('arabic_title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.description')</label>
                        <div class="col-sm-9">
                    <textarea id="en-description" class="form-control" name="en-description" value="{{ old('description') }}" rows="10" cols="50">{{$static_page->description}}</textarea>
                    <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.arabic_description')</label>
                        <div class="col-sm-9">
                    <textarea id="ar-description" class="form-control" dir="rtl" name="ar-description" value="{{ old('arabic_description') }}" rows="10" cols="50">{{$static_page->arabic_description}}</textarea>
                    <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="border-top">
                      <div class="card-body">
                       <a href="{{route('static_pages.index')}}">
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
@section('scripts')

<link href='https://cdn.jsdelivr.net/npm/froala-editor@3.2.0/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />


<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@3.2.0/js/froala_editor.pkgd.min.js'></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@3.2.0/js/languages/ar.js'></script>
<script>

    new FroalaEditor('#ar-description', {toolbarInline: false,language: 'ar'})
</script>

<script>
new FroalaEditor('#en-description', {toolbarInline: false})

</script>
@stop





