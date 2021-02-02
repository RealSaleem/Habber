@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.ad_page.edit_ad')</h2>
        </div>
    </div>
        <div class="container-fluid">
             @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Ad Edited! &nbsp;</strong>{{Session::get('success')}}
            </div>
              @endif 
              @if(Session::has('status'))
            <div class="alert alert-danger text-center" role="alert">
                <strong>Limit Exceded! &nbsp;</strong>{{Session::get('status')}}
            </div>
        @endif 
        </div> 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{action('AdController@update',[$ad->id])}}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.ad_page.edit_ad_info')</h4>
                    <div class="form-group row">
                        <label for="image" class="col-sm-3 text-right control-label col-form-label">@lang('messages.ad_page.image')</label>
                        <div class="col-sm-9">
                        <input id="image" type="file" class="form-control" name="image">
                            <span class="text-danger">{{$errors->first('image')}}</span>
                            @if(isset($ad->image))
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <img class="form-control" style=" width: 100px; height: 100px;" src="{{ url('storage/'.$ad->image)}}" alt="no-image">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.ad_page.featured')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="featured"  id="status">
                                <option value="0" {{ ($ad->featured == "0" ? "selected":"")}}> Not Featured</option>
                                <option value="1" {{ ($ad->featured == "1" ? "selected":"")}}> Featured</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('featured')}}</span>
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.book_page.status')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status"  id="status">
                                <option value="0" {{ ($ad->featured == "0" ? "selected":"")}}>Disable</option>
                                <option value="1" {{ ($ad->featured == "1" ? "selected":"")}}>Enable</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        </div>
                    </div> 
                     <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('ads.index')}}">
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