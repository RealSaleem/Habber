@extends('layouts.app')
@section('content')
<div class="row">
            <div class="col-lg-12 margin-tb">
              <div class="pull-left">
               <h2>@lang('messages.bookclub_page.edit_bookclub')</h2>
               </div>
            </div>
            <div class="container-fluid">
              @if(Session::has('success'))
               <div class="alert alert-success text-center" role="alert">
                <strong>BookClub Edited! &nbsp;</strong>{{Session::get('success')}}
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
                <form action="{{ action('BookClubController@update',[$bookclub->id])}}" method="POST"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.bookclub_page.edit_bookclub_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookclub_page.name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ $bookclub->name }}">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookclub_page.arabic_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="arabic_name" dir="rtl" value="{{$bookclub->arabic_name}}" >
                            <span class="text-danger">{{$errors->first('arabic_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.books')</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="book" id="book_id">
                            @foreach($book as $b)
                            <option value="{{$b->id}}" {{$bookclub->id == $b->id ? "selected" : ""}} > {{$b->title}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('book')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookclub_page.feature')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="featured"  id="status">
                                <option value="0" {{ ($bookclub->featured == 0? "selected":"")}}>Not Featured</option>
                                <option value="1" {{ ($bookclub->featured == 1 ? "selected":"")}}>Featured</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('featured')}}</span>
                        </div>
                     </div> 
                     <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.status')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status"  id="status">
                            
                                <option value="0" {{ ($bookclub->status == 0 ? "selected":"")}}>Deactivate</option>
                                <option value="1" {{ ($bookclub->status == 1 ? "selected":"")}}>Activate</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        </div>
                     </div> 
                    <div class="form-group row">
                        <label for="banner_image" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookclub_page.banner_image')</label>
                        <div class="col-sm-9">
                        <input id="banner_image" type="file" class="form-control" name="banner_image" >
                            <span class="text-danger">{{$errors->first('banner_image')}}</span>
                            @if(isset($bookclub->banner_image))
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <img class="form-control" style=" width: 50px; height: 50px;" src="{{ url('storage/'.$bookclub->banner_image)}}" alt="no-image">
                                </div>
                            </div>
                            @endif
                        </div>
                        </div>
                        <div class="form-group row">
                        <label for="square_banner" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookclub_page.square_banner')</label>
                        <div class="col-sm-9">
                        <input id="square_banner" type="file" class="form-control " name="square_banner" >
                          <div>
                            <span class="text-danger">{{$errors->first('square_banner')}}</span>
                            </div>
                            @if(isset($bookclub->square_banner))
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <img class="form-control" style=" width: 50px; height: 50px;" src="{{ url('storage/'.$bookclub->square_banner)}}" alt="no-image">
                                </div>
                            </div>
                            @endif
                        </div>
                            </div>
                        <div class="form-group row">
                        <label for="bookclub_logo" class="col-sm-3 text-right control-label col-form-label">@lang('messages.bookclub_page.bookclub_logo')</label>
                        <div class="col-sm-9">
                        <input id="bookclub_logo" type="file" class="form-control " name="bookclub_logo" >
                          <div>
                            <span class="text-danger">{{$errors->first('bookclub_logo')}}</span>
                            </div>
                            @if(isset($bookclub->bookclub_logo))
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <img class="form-control" style=" width: 50px; height: 50px;" src="{{ url('storage/'.$bookclub->bookclub_logo)}}" alt="no-image">
                                </div>
                            </div>
                            @endif
                        </div>
                            </div>
                    
                         <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('bookclubs.index')}}">
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
