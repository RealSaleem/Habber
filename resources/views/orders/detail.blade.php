@extends('layouts.app')
@section('content')


<div class="container">
    <article class="card">
        <header class="card-header"> My Orders </header>
        <div class="card-body">
            <h6>Order ID: {{$order->id}}</h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Order Date:</strong> <br>{{$order->created_at}} </div>
                    <div class="col"> <strong>Order By:</strong> <br>{{ucfirst($order->users->first_name ." ".$order->users->last_name )}}</div>
                    <div class="col"> <strong>Email:</strong> <br>  {{ucfirst($order->users->email)}} </div>
                    <div class="col"> <strong>Contact No :</strong> <br> {{ucfirst($order->users->phone)}}</div>
                </div>
                <div class="card-body row">
                    <div class="col"> <strong>Currency:</strong> <br> </div>
                    <div class="col"> <strong>Total Price</strong> <br>  {{ucfirst($order->total_price)}} </div>
                    <div class="col"> <strong>Total Quantity :</strong> <br> {{ucfirst($order->total_quantity)}}</div>
                    <div class="col"><strong>Status:</strong><br>
                        <select class="form-control" name="status" id="">
                            <option value="0" {{($order->status == "0" ? 'selected' : '')}}>Pending</option>
                            <option value="1" {{($order->status == "1" ? 'selected' : '')}}>Seen</option>
                        </select>
                    </div>
                </div>
            </article>
            <div class="track">
                <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Picked by courier</span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
            </div>

                  
@endsection
