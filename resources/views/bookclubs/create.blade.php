@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.bookclub_page.add_new_bookclub')</h2>
        </div>
    </div>
        <div class="container-fluid">
             @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>BookClub Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
              @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{action('BookClubController@store')}}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.bookclub_page.add_bookclub_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookclub_page.name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name"  value="{{ old('name') }}" id="name"  placeholder="name">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookclub_page.arabic_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="arabic_name" dir="rtl" value="{{ old('arabic_name') }}" id="arabic_name"  placeholder="Arabic Name">
                            <span class="text-danger">{{$errors->first('arabic_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.books') </label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="book" id="book_id" >
                            @foreach($book as $b)
                            <option value="{{$b->id}}" > {{$b->title}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('book')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookclub_page.feature')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="featured"  id="status">
                                <option value="0" {{ (old('featured') == "0" ? "selected":"")}}>Featured</option>
                                <option value="1" {{ (old('featured') == "1" ? "selected":"")}}>Not Featured</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('featured')}}</span>
                        </div>
                     </div> 
                     <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.status')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status"  id="status">
                                <option value="0" {{ (old('status') == "0" ? "selected":"")}}>Activate</option>
                                <option value="1" {{ (old('status') == "1" ? "selected":"")}}>Deactivate</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        </div>
                     </div> 
                    <div class="form-group row">
                        <label for="banner_image" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookclub_page.banner_image')<br>(333*1000) </label>
                        <div class="col-sm-9">
                        <input id="banner_image" type="file" class="form-control" name="banner_image" >
                            <span class="text-danger">{{$errors->first('banner_image')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="square_banner" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookclub_page.square_banner')<br>(400*400)</label>
                        <div class="col-sm-9">
                        <input id="square_banner" type="file" class="form-control" name="square_banner" >
                            <span class="text-danger">{{$errors->first("square_banner")}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bookclub_logo" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookclub_page.bookclub_logo')<br> (200*200)</label>
                        <div class="col-sm-9">
                        <input id="bookclub_logo" type="file" class="form-control" name="bookclub_logo" >
                            <span class="text-danger">{{$errors->first("bookclub_logo")}}</span>
                        </div>
                    </div>
                     <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('bookclubs.index')}}">
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
