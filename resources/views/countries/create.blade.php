@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.country_page.add_country')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Country Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{action('CountryController@store') }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.country_page.add_country_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.country_page.iso')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="iso" value="{{ old('iso') }}" id="iso"  placeholder="Iso ">
                            <span class="text-danger">{{$errors->first('iso')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.country_page.name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name"  placeholder="Name ">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.country_page.nicename')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nicename" value="{{ old('nicename') }}" id="nicename"  placeholder="Nice Name ">
                            <span class="text-danger">{{$errors->first('nicename')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.country_page.iso3')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="iso3" value="{{ old('iso3') }}" id="iso3"  placeholder="Iso3 ">
                            <span class="text-danger">{{$errors->first('iso3')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.country_page.numcode')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="numcode" value="{{ old('numcode') }}" id="numcode"  placeholder="Numcode">
                            <span class="text-danger">{{$errors->first('numcode')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.country_page.phonecode')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="phonecode" value="{{ old('phonecode') }}" id="phonecode"  placeholder="Phonecode ">
                            <span class="text-danger">{{$errors->first('phonecode')}}</span>
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
                    <div class="border-top">
                      <div class="card-body">
                         <a href="{{route('countries.index')}}">
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