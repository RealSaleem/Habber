@extends('layouts.app')
@section('content')
<div class="container">
    <article class="card">
        <div class="card-body">
            <h6>Shipping Address</h6>
            <article class="card">
            <div class="card-body row">
                    <div class="col"> <strong>@lang('messages.address_page.address'):</strong> <br> {{ucfirst($order->addresses['address_name'])}} </div>
                    <div class="col"> <strong>@lang('messages.address_page.address_line1'):</strong> <br> {{ucfirst($order->addresses['address_line1'])}} </div>
                    <div class="col"> <strong>@lang('messages.address_page.address_line2'):</strong> <br> {{ucfirst($order->addresses['address_line2'])}} </div>
                    <div class="col"> <strong>@lang('messages.address_page.country'):</strong> <br> {{ucfirst($order->addresses->countries['name'])}} </div>
                    <div class="col"> <strong>@lang('messages.address_page.city'):</strong> <br> {{ucfirst($order->addresses->cities['name'])}} </div>
                    <div class="col"> <strong>@lang('messages.address_page.state'):</strong> <br> {{ucfirst($order->addresses['state'])}} </div>
                    <div class="col"> <strong>@lang('messages.address_page.post_code'):</strong> <br> {{ucfirst($order->addresses['post_code'])}} </div>
                </div> 
                <div class="card-body">
                    <a href="{{route('orders.index')}}">
                        <button type="button" class=" btn btn-success">
                        @lang('messages.button.back')
                        </button></a>
                        </div>
                </form>
                </article>
                @endsection