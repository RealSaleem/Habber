@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.banner_page.add_new_banner')</h2>
        </div>
    </div>
        <div class="container-fluid">
             @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Banner Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
              @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{action('BannerController@store')}}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.banner_page.add_banner_info')</h4>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.description')</label>
                        <div  class="col-sm-9">
                         <textarea class="form-control" id="description" name="description" value="{{ old('description') }}" rows="4" cols="54" style="resize:none, " placeholder= "Details"  ></textarea>
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.status')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status"  id="status">
                                <option value="0" {{ (old('status') == "0" ? "selected":"")}}>Disable</option>
                                <option value="1" {{ (old('status') == "1" ? "selected":"")}}>Enable</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        </div>
                     </div> 
                     <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.language')</label>
                        <div class="col-sm-9">
                       <select  class="form-control" name="language_id" id="language_id" >
                            @foreach($language as $l)
                                <option value="{{$l->id}}" > {{$l->name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('language_id')}}</span>
                        </div>
                    </div>
                     <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.url')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="url"  value="{{old('url')}}" id="url"  placeholder="Url">
                            <span class="text-danger">{{$errors->first('url')}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.image')</label>
                        <div class="col-sm-9">
                        <input id="image" type="file" class="form-control" name="image">
                            <span class="text-danger">{{$errors->first('image')}}</span>
                        </div>
                    </div>
                     <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('banners.index')}}">
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