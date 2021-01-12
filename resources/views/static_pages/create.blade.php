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
                <strong>Page Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 

        @if(Session::has('featured'))
            <div class="alert alert-danger text-center" role="alert">
                <strong>Limit Exceded! &nbsp;</strong>{{Session::get('featured')}}
            </div>
        @endif 
        <div class="col-md-12">
        <div class="card">
            <form action="{{ action('StaticPagesController@store') }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.static_page.addpageinfo')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.title')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" dir="{{ session()->get('locale') == 'ar' ? 'rtl' : ''}}" name="title" value="{{ old('title') }}" id="title"  placeholder="English Title">
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.static_page.arabictitle')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="arabic_title" dir="rtl" value="{{ old('arabic_title') }}" id="arabic_title"  placeholder="Arabic Title">
                            <span class="text-danger">{{$errors->first('arabic_title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.description')</label>
                        <div class="col-sm-9">
                    <textarea id="en-description" class="form-control" name="en-description" value="{{ old('description') }}" rows="10" cols="50"></textarea>
                    <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.description')</label>
                        <div class="col-sm-9">
                    <textarea id="ar-description" class="form-control" dir="rtl" name="ar-description" value="{{ old('description') }}" rows="10" cols="50"></textarea>
                    <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="border-top">
                      <div class="card-body">
                       <a href="{{route('static_pages.index')}}">
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
@section('scripts')

<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/translations/ar.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/translations/en.js"></script>
<script>

ClassicEditor
    .create( document.querySelector( '#ar-description' ), {
        language: 'ar'
    } )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

</script>

<script>

ClassicEditor
    .create( document.querySelector( '#en-description' ), {
        language: 'en'
    } )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

</script>

@stop






