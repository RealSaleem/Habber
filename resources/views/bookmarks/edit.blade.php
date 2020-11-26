@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.bookmark_page.edit_bookmark')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Bookmarks Edited! &nbsp;</strong>{{Session::get('success')}}
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
            <form action="{{ action('BookmarksController@update',[$bookmark->id])}}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.bookmark_page.edit_bookmark_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.title')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="title" value="{{ $bookmark->title }}">
                            <span class="text-danger">{{$errors->first('title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.arabic_title')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control"  name="arabic_title" dir="rtl" value="{{  $bookmark->arabic_title }}" >
                            <span class="text-danger">{{$errors->first('arabic_title')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label"> @lang('messages.bookmark_page.maker_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="maker_name" value="{{ $bookmark->maker_name }}">
                            <span class="text-danger">{{$errors->first('maker_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.arabic_maker_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="arabic_maker_name"  dir="rtl" value="{{ $bookmark->arabic_maker_name }}">
                            <span class="text-danger">{{$errors->first('arabic_maker_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.description')</label>
                        <div class="col-sm-9">
                            <textarea type="textarea"   class="form-control" name="description"value=""   maxlength = "160">{{ $bookmark->description }}</textarea>
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.arabic_description')</label>
                        <div class="col-sm-9">
                            <textarea type="textarea" class="form-control"  name="arabic_description" dir="rtl" value=""   maxlength = "160">{{ $bookmark->arabic_description }}</textarea>
                            <span class="text-danger">{{$errors->first('arabic_description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.price')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="price" value="{{ $bookmark->product_prices['price']}}">
                            <span class="text-danger">{{$errors->first('price')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.bookmark_id')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="bookmark_id" value="{{ltrim($bookmark->bookmark_id,'HB') }}" disable>
                            <span class="text-danger">{{$errors->first('bookmark_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.size')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="size" value="{{ $bookmark->size }}">
                            <span class="text-danger">{{$errors->first('size')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.quantity')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="quantity" value="{{ $bookmark->quantity }}">
                            <span class="text-danger">{{$errors->first('quantity')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.type_of_bookmark')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="type_of_bookmark" value="{{ $bookmark->type_of_bookmark }}">
                            <span class="text-danger">{{$errors->first('type_of_bookmark')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.stock_status')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="stock_status"  id="status">
                                <option value="0" {{ ($bookmark->stock_status == 0 ? "selected":"")}}>Not Available</option>
                                <option value="1" {{ ($bookmark->stock_status == 1 ? "selected":"")}}>Available</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('stock_status')}}</span>
                        </div>
                     </div> 
                     <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookmark_page.feature')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="featured"  id="status">
                                <option value="0" {{ ($bookmark->featured == 0 ? "selected":"")}}>Not Featured</option>
                                <option value="1" {{ ($bookmark->featured == 1 ? "selected":"")}}>Featured</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('featured')}}</span>
                        </div>
                     </div> 
                     <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Publisher</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="publisher" id="publisher">
                            @foreach($user as $u)
                            <option value="{{$u->id}}" {{$bookmark->user_id == $u->id ? "selected" : ""}} > {{$u->first_name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('publisher')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.status')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status"  id="status">
                                <option value="0" {{ ($bookmark->status == 0 ? "selected":"")}}>Deactivate</option>
                                <option value="1" {{ ($bookmark->status == 1 ? "selected":"")}}>Activate</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        </div>
                     </div> 
                    <div class="form-group row">
                        <label for="image" class="col-sm-3 text-right control-label col-form-label">Image</label>
                        <div class="col-sm-9">
                        <input id="image" type="file" class="form-control" name="image" >
                            <span class="text-danger">{{$errors->first('image')}}</span>
                            @if(isset($bookmark->image))
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <img class="form-control" style=" width: 100px; height: 100px;" src="{{ url('storage/'.$bookmark->image)}}" alt="no-image">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('bookmarks.index')}}">
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
