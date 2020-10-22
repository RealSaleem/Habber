@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> @lang('messages.business_page.edit_business')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Business Edited! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
          <form  action="{{ action('BusinessController@update',[$business->id])}}" method="POST" enctype="multipart/form-data" >   
                {{ csrf_field() }}     
                  @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.business_page.edit_business_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.business_page.user') </label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="user_id" id="user_id" >
                            @foreach($user as $u)
                            <option value="{{$u->id}} {{ ($business->user_id == $u->id ? "selected" : "")}}"  > {{$u->first_name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.business_page.name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name"value="{{ $business->name }}"  placeholder="Author Name Here">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.business_page.business_type')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="business_type" value="{{ $business->business_type }}" placeholder="Business Here">
                            <span class="text-danger">{{$errors->first('business_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.business_page.product_type')</label>
                        <div class="col-sm-9">
                        <select class="form-control" name="product_typr"  id="status">
                                 <option value="both" {{ (old('product_type') == "boths" ? "selected":"")}}> Both</option>
                                <option value="books" {{ (old('product_type') == "books" ? "selected":"")}}>Books</option>
                                <option value="bookmarks" {{ (old('product_type') == "bookmarks" ? "selected":"")}}> Bookmarks</option>
                        </select>   
                            <span class="text-danger">{{$errors->first('product_type')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.business_page.details')</label>
                        <div class="col-sm-9">
                        <textarea class="form-control" id="details" name="details" rows="4" cols="54" style="resize:none," value=""  >{{ $business->details }}</textarea>
                            <span class="text-danger">{{$errors->first('details')}}</span>
                        </div>
                    </div>
                    <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('business.index')}}">
                        <button type="button" class=" btn btn-danger">
                        @lang('messages.button.back')
                        </button></a>
                        <button type="submit" class="btn btn-primary"> @lang('messages.button.update') </button>
                       </div>
                     </div>
                </div>   
            </form>
        </div>
    </div>
</div>
                  
@endsection
