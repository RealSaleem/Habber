@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.book_page.add_new_book')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Book Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 

        @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div>{{$error}}</div>
     @endforeach
     @endif
        </div> 
     <div class="col-md-12">
        <div class="card">
            <form action="{{ action('BooksController@store') }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.book_page.add_book_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.title')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" dir="{{ session()->get('locale') == 'ar' ? 'rtl' : ''}}" name="title" value="{{ old('title') }}" id="title"  placeholder="Title">
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.author_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="author_name" value="{{ old('author_name') }}" id="author_name" placeholder="Author Name ">
                            <span class="text-danger">{{$errors->first('author_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.cover_type')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="cover_type" value="{{ old('cover_type') }}" id="cover_type" placeholder="Cover Type">
                            <span class="text-danger">{{$errors->first('cover_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.description')</label>
                        <div class="col-sm-9">
                            <textarea type="textarea" dir="{{ session()->get('locale') == 'ar' ? 'rtl' : ''}}" class="form-control" name="description" value="{{ old('description') }}" id="description" placeholder="Description"></textarea>
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.book_language') </label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="book_language" id="book
                        _language" >
                            @foreach($language as $l)
                            <option value="{{$l->name}}" > {{$l->name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('book_language')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.price')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}"  placeholder="Price ">
                            <span class="text-danger">{{$errors->first('price')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.isbn')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="isbn" value="{{ old('isbn') }}" id="isbn" placeholder="Isbn">
                            <span class="text-danger">{{$errors->first('isbn')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.total_pages')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" min="0" name="total_pages" value="{{ old('total_pages') }}" id="total
                            _pages" placeholder="Pages">
                            <span class="text-danger">{{$errors->first('total_pages')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.quantity')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control"  min="0" name="quantity" value="{{ old('quantity') }}" id="quantity" placeholder="Quantity">
                            <span class="text-danger">{{$errors->first('quantity')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Publisher </label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="publisher" id="publisher" >
                            @foreach($user as $u)
                            <option value="{{$u->id}}" > {{$u->first_name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('publisher')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.bookclub')</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="bookclub" id="bookclub_id" >
                            @foreach($bookClubs as $b)
                            <option value="{{$b->id}}" > {{$b->name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('bookclub')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.genre')</label>
                            <div class="col-md-9">
                                <select class="select2 form-control m-t-15" name="genre[]" multiple="multiple" >
                                    @foreach($genres as $value)
                                    <optgroup label="">
                                        <option value="{{$value->id}}">{{$value->title}}</option>
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        <span class="text-danger">{{$errors->first('genre')}}</span>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.stock_status')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="stock_status"  id="status">
                                <option value="0" {{ (old('stock_status') == "0" ? "selected":"")}}>Not Available</option>
                                <option value="1" {{ (old('stock_status') == "1" ? "selected":"")}}>Available</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('stock_status')}}</span>
                        </div>
                     </div> 
                     <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.feature')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="featured"  id="status">
                                <option value="0" {{ (old('featured') == "0" ? "selected":"")}}>Featured</option>
                                <option value="1" {{ (old('featured') == "1" ? "selected":"")}}>Not Featured</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('featured')}}</span>
                        </div>
                     </div> 
                    <div class="form-group row">
                        <label for="image_url" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.image') </label>
                        <div class="col-sm-9">
                        <input id="image_url" type="file" class="form-control" name="image">
                            <span class="text-danger">{{$errors->first('image')}}</span>
                        </div>
                    </div>                    
                    <div class="border-top">
                      <div class="card-body">
                       <a href="{{route('books.index')}}">
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
<script>
$(".select2").select2();
</script>
@stop