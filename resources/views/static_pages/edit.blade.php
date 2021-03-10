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
        <form  action="{{ action('StaticPagesController@update',[$static_page->url])}}" method="post" enctype="multipart/form-data" >   
                {{ csrf_field() }}     
                @method('PUT') 
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.static_page.pageinfo')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.title')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" dir="{{ session()->get('locale') == 'ar' ? 'rtl' : ''}}" name="title" value="{!! $static_page->title !!}" id="title"  placeholder="English Title">
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.static_page.arabictitle')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="arabic_title" dir="rtl" value="{!! $static_page->arabic_title !!}" id="arabic_title"  placeholder="Arabic Title">
                            <span class="text-danger">{{$errors->first('arabic_title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.description')</label>
                        <div class="col-sm-9">
                        
                    <textarea class="form-control editor1" id="en-description" name="en-description" value="{{ old('description') }}" rows="10" cols="50">{!! $static_page->description !!}</textarea>
                    <span class="text-danger">{{$errors->first('description')}}</span>
                    </div>
                        
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.description')</label>
                        <div class="col-sm-9">
                        
                    <textarea id="ar-description" class="form-control editor" dir="rtl" name="ar-description" value="{{ old('description') }}" rows="10" cols="50">{!! $static_page->arabic_description !!}</textarea>
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

<script src="{{ asset('ckeditor5/build/ckeditor.js') }}"></script>
<script>ClassicEditor
			.create( document.querySelector( '.editor1' ), {
				
				toolbar: {
					items: [
						'heading',
						'|',
						'fontFamily',
						'fontSize',
						'fontColor',
						'bold',
						'italic',
						'highlight',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'outdent',
						'indent',
						'|',
						'imageUpload',
						'blockQuote',
						'insertTable',
						'mediaEmbed',
						'undo',
						'redo',
						'htmlEmbed'
					]
				},
				language: 'en',
				image: {
					toolbar: [
						'imageTextAlternative',
						'imageStyle:full',
						'imageStyle:side'
					]
                },
                fontSize: {
            options: [
                9,
                11,
                13,
                'default',
                17,
                19,
                21,
                23,
                25,
                27
            ]
        },
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
				licenseKey: '',
				
				
			} )
			.then( editor => {
				window.editor = editor;
		
				
				
				
		
				
				
				
			} )
			.catch( error => {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: 74l6wn495io0-em6ekhfgffpz' );
				console.error( error );
			} );
	</script>
<script>ClassicEditor
			.create( document.querySelector( '.editor' ), {
				
				toolbar: {
					items: [
						'heading',
						'|',
						'fontFamily',
						'fontSize',
						'fontColor',
						'bold',
						'italic',
						'highlight',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'outdent',
						'indent',
						'|',
						'imageUpload',
						'blockQuote',
						'insertTable',
						'mediaEmbed',
						'undo',
						'redo',
						'htmlEmbed'
					]
				},
				language: 'ar',
				image: {
					toolbar: [
						'imageTextAlternative',
						'imageStyle:full',
						'imageStyle:side'
					]
                },
                fontSize: {
            options: [
                9,
                11,
                13,
                'default',
                17,
                19,
                21,
                23,
                25,
                27
            ]
        },
				table: {
					contentToolbar: [
						'tableColumn',
						'tableRow',
						'mergeTableCells'
					]
				},
				licenseKey: '',
				
				
			} )
			.then( editor => {
				window.editor = editor;
		
				
				
				
		
				
				
				
			} )
			.catch( error => {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: 74l6wn495io0-em6ekhfgffpz' );
				console.error( error );
			} );
	</script>


@stop





