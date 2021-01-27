@extends('layouts.app')
@section('content')
<div class="row"> 
          <div class="col-lg-12 margin-tb">
             <div class="pull-left">
            <h2>@lang('messages.book_page.edit_book_info')</h2>
              </div>
           </div>
           <div class="container-fluid">
              @if(Session::has('success'))
               <div class="alert alert-success text-center" role="alert">
                <strong>Book Edited! &nbsp;</strong>{{Session::get('success')}}
               </div>
                @endif 
                @if(Session::has('featured'))
                    <div class="alert alert-danger text-center" role="alert">
                        <strong>Limit Exceded! &nbsp;</strong>{{Session::get('featured')}}
                    </div>
                @endif 
           </div> 
           
        <div class="col-md-12">
           <div class="card">
              <form  action="{{ action('BooksController@update',[$book->id])}}" method="POST" enctype="multipart/form-data" >   
                {{ csrf_field() }}     
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.book_page.edit_book_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.title')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="title" id="title" value="{{$book->title}}" placeholder= "Title" >
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        </div>
                       </div> 
                        <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.arabic_title')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" dir="rtl" name="arabic_title" id="arabic_title" value="{{$book->arabic_title}}" placeholder= "Arabic Title" >
                            <span class="text-danger">{{$errors->first('arabic_title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.author_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="author_name" id="author_name" value="{{$book->author_name}}" placeholder="Author Name ">
                            <span class="text-danger">{{$errors->first('author_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.cover_type')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="cover_type" id="cover_type"value="{{$book->cover_type}}" placeholder="Cover Type">
                            <span class="text-danger">{{$errors->first('cover_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.description') </label>
                        <div class="col-sm-9">
                            <textarea  class="form-control"  dir="{{ session()->get('locale') == 'ar' ? 'rtl' : ''}}" name="description" id="description" value="" placeholder="Description"  maxlength = "160">{{$book->description}}</textarea>
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.book_language') </label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="book_language" id="book_language" >
                            @foreach($language as $l)
                            <option value="{{$l->name}}" {{ ($book->book_language == $l->name ? "selected" : "")}} > {{$l->name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('book_language')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.price')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="price" id="price" value="{{$book->product_prices['0']['price']}}" placeholder="Price ">
                            <span class="text-danger">{{$errors->first('price')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Isbn</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="isbn" id="isbn"value="{{$book->isbn}}" placeholder="Isbn">
                            <span class="text-danger">{{$errors->first('isbn')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.total_pages')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control"  min="0" name="total_pages" id="total_pages"value="{{$book->total_pages}}" placeholder="Total Pages"> 
                            <span class="text-danger">{{$errors->first('total_pages')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.quantity')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control"  min="0" name="quantity" id="quantity"value="{{$book->quantity}}" placeholder="Quantity">
                            <span class="text-danger">{{$errors->first('quantity')}}
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.stock_status')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="stock_status"  id="status">
                                <option value="0" {{ ($book->stock_status == 0 ? "selected" : "")}} >Not Available</option>
                                <option value="1" {{ ($book->stock_status == 1 ? "selected" : "")}}>Available</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('stock_status')}}</span>
                        </div>
                     </div> 
                     <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.feature')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="featured"  id="status">
                                <option value="0" {{ ($book->featured == 0 ? "selected":"")}}>Not Featured</option>
                                <option value="1" {{ ($book->featured == 1 ? "selected":"")}}>Featured</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('featured')}}</span>
                        </div>
                     </div> 
                     <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.status')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status"  id="status">
                                <option value="0" {{ ($book->status == 0 ? "selected":"")}}>Deactivate</option>
                                <option value="1" {{ ($book->status == 1 ? "selected":"")}}>Activate</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        </div>
                     </div> 
                     <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.publisher')</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="publisher" id="publisher">
                            @foreach($user as $u)
                            <option value="{{$u->id}}" {{$book->user_id == $u->id ? "selected" : ""}} > {{$u->first_name}}</option>
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
                            <option value="{{$b->id}}" {{ ($book->book_club_id == $b->id ? "selected" : "")}}> {{$b->name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('bookclub')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.genre')</label>
                            <div class="col-md-9">
                                <select class="select2 form-control m-t-15" name="genre[]" multiple="multiple" >
                                    @foreach($genres as $key => $g)
                                    <optgroup label="">
                                        <option value="{{$g->id}}" {{ (in_array($g->id, $selectedGenres)) ? 'selected' : '' }}> {{$g->title}}</option>
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        <span class="text-danger">{{$errors->first('genre')}}</span>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.image')</label>
                        <div class="col-sm-9">
                          <input id="image_url" type="file" class="form-control" name="image" >
                            <span class="text-danger">{{$errors->first('image')}}</span>
                            @if(isset($book->image))
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <img class="form-control" style=" width: 100px; height: 100px;" src="{{ url('storage/'.$book->image)}}" alt="no-image">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('books.index')}}">
                        <button type="button" class=" btn btn-danger">
                        @lang('messages.button.back')
                        </button></a>
                        <button type="submit" class="btn btn-primary"> @lang('messages.button.update')</button>
                    </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
                  
@endsection
@section('scripts')
<script>
$(".select2").select2();
</script>
@stop