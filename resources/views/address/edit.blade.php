@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.address_page.edit_address')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Address Edited! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{ action('AddressController@update',[$address->id])}}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.address_page.edit_address_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.address_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address_name"  value="{{ $address->address_name }}" id="address_name"  placeholder="Address Name">
                            <span class="text-danger">{{$errors->first('address_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.address_line1')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address_line1"  value="{{ $address->address_line1 }}" id="address_line1"  placeholder="Address Line1">
                            <span class="text-danger">{{$errors->first('address_line1')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.address_line2')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address_line2" value="{{ $address->address_line2 }}" id="address_line1"  placeholder="Address Line2">
                            <span class="text-danger">{{$errors->first('address_line2')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.country')</label>
                        <div class="col-sm-9">
                            <select  class="form-control" name="country_id" id="country_id" disabled>
                            @foreach($country as $c)
                            <option value="{{$c->id}} {{ ($address->country_id == $c->id ? "selected" : "")}}"  > {{$c->name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('country_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.city')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="city"  value="{{ $address->city }}" id="city"  placeholder="City">
                            <span class="text-danger">{{$errors->first('city')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.state')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="state"  value="{{ $address->state }}" id="state"  placeholder="State">
                            <span class="text-danger">{{$errors->first('state')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.post_code')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="post_code"  value="{{ $address->post_code }}" id="post_code"  placeholder="Post Code">
                            <span class="text-danger">{{$errors->first('post_code')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.phone')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="phone" value="{{ $address->phone }}" id="phone"  placeholder="Phone">
                            <span class="text-danger">{{$errors->first('phone')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.user')r</label>
                        <div class="col-sm-9">
                            <select  class="form-control" name="user_id" id="user_id" disabled>
                            @foreach($user as $u)
                            <option value="{{$u->id}} {{ ($address->user_id == $u->id ? "selected" : "")}}"  > {{$u->first_name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('user_id')}}</span>
                        </div>
                    </div>
                    <div class="border-top">
                      <div class="card-body">
                         <a href="{{route('address.index')}}">
                          <button type="button" class=" btn btn-danger">
                          @lang('messages.button.cancel')
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
