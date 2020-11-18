@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.publisher_page.publisher')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>{{Session::get('success')}} &nbsp;</strong>
            </div>
        @endif 
    </div> 
    <div class="col-md-12">
        <div class="card">
            <form >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body row" style="font-size: 18px;">
                    <h4 class="card-title col-12">@lang('messages.publisher_page.publisher')</h4>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.publisher_page.publisher_id'):  {{$publisher->id}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.publisher_page.name'):  {{ucfirst($publisher->first_name ." ".$publisher->last_name )}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.user_page.email'):   {{ucfirst($publisher->email)}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.publisher_page.product_type'):  {{ucfirst($publisher->businesses['product_type'])}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.publisher_page.no_of_product'):  </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.publisher_page.no_of_order'): </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.publisher_page.operating_country'):  {{ucfirst($publisher->countries['name'])}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.publisher_page.status'):  {{ucfirst($publisher->status == 1 ? "active" : "not active")}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.publisher_page.date'):   {{$publisher->created_at}}</label>
                    </div>
                     @if(isset($publisher->image))
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.publisher_page.image'):  </label>
                        <img style=" width: 50px; height: 50px;" src="{{ url('storage/'.$publisher->image)}}" alt="">
                    </div>
                    @endif 
                </div>
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('publisher.index')}}">
                        <button type="button" class=" btn btn-success">
                        @lang('messages.button.back')
                        </button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                  
@endsection
