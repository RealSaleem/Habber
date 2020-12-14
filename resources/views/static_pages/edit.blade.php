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

        @if(Session::has('featured'))
            <div class="alert alert-danger text-center" role="alert">
                <strong>Limit Exceded! &nbsp;</strong>{{Session::get('featured')}}
            </div>
        @endif 
        <div class="col-md-12">
        <div class="card">
        <form  action="{{ action('StaticPagesController@update',[$static_page->url])}}" method="POST" enctype="multipart/form-data" >   
                {{ csrf_field() }}     
                @method('PUT')
                <input type="hidden" name="_method" value="PUT"> 
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.static_page.pageinfo')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.title')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" dir="{{ session()->get('locale') == 'ar' ? 'rtl' : ''}}" name="title" value="{{$static_page->title}}" id="title"  placeholder="Title">
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.description')</label>
                        <div class="col-sm-9">
                    <textarea id="w3review" class="form-control" name="w3review"   rows="10" cols="50">{{$static_page->description}} </textarea>
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
<script src="https://cdn.ckeditor.com/ckeditor5/23.1.0/classic/ckeditor.js"></script>
<script>

ClassicEditor
            .create( document.querySelector( '#w3review' ) )
            .catch( error => {
                console.error( error );
            } );

</script>
@stop





