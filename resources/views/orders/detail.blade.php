@extends('layouts.app')
@section('content')
<div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>{{Session::get('success')}} &nbsp;</strong>
            </div>
        @endif 
    </div> 

<div class="container">
    <article class="card">
        <form action="{{ route('orders.update',['order'=> $order->id])}}" method="post"  enctype="multipart/form-data" > 
                {{ csrf_field() }}
                @method('PUT')
        <div class="card-body">
            <h6>@lang('messages.order_page.order_id'): {{$order->id}}</h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>@lang('messages.order_page.order_date'):</strong> <br>{{$order->created_at}} </div>
                    <div class="col"> <strong>@lang('messages.order_page.first_name'):</strong> <br>{{($order->users['first_name'] )}}</div>
                    <div class="col"> <strong>@lang('messages.order_page.last_name'):</strong> <br>{{($order->users['last_name'] )}}</div>
                    <div class="col"> <strong>@lang('messages.user_page.email'):</strong> <br>  {{ucfirst($order->users['email'])}} </div>
                    <div class="col"> <strong>@lang('messages.user_page.contact_no'):</strong> <br> {{ucfirst($order->users['phone'])}}</div>
                    <div class="col"> <strong>@lang('messages.order_page.total_quantity') :</strong> <br> {{ucfirst($order->total_quantity)}}</div>
                    <div class="col"> <strong>@lang('messages.order_page.total_price'):</strong> <br> {{($order->total_price)+($order->addresses->countries['shipping_charges'])}} {{$order->currencies['iso']}} </div>
                </div>
                <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th>Product Name </th>
                        <th>Product ID </th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Product Status</th>
                        
                       
                    </tr>
                </thead>
                <tbody>
                @if(count($order->books) > 0)
                    @foreach($order->books as $o)
                        <tr>
                        <td>{{$o->title}}</td>
                            <td>{{$o->isbn}}</td>
                            <td>{{$o['pivot']->price}}</td>
                            <td>{{$o['pivot']->quantity}}</td>
                            <td><img style=" width: 50px; height: 50px;" src=" {{  url('storage/'.$o->image)  }}" alt=""> </td>
                            <td>
                          <div class="card-body row">
                          <input  type="hidden" name="id" value="{{$o->id}}">
                          
                    <select class="form-control" name="product_status" id="product_status">
                            <option value="Not Ready" {{($o->product_status == "Not Ready" ? 'selected' : '')}}>Not Ready</option>
                            <option value="Ready" {{($o->product_status == "Ready" ? 'selected' : '')}}>Ready</option>
                     </select>
                    </div>
                    </td>
                        </tr>
                    @endforeach
                @endif   
                @if(count($order->bookmarks) > 0)
                    @foreach($order->bookmarks as $b)
                        <tr>
                        <td>{{$b->title}}</td>
                            <td>{{$b->bookmark_id}}</td>
                            <td>{{$b['pivot']->price}}</td>
                            <td>{{$b['pivot']->quantity}}</td>
                            <td><img style=" width: 50px; height: 50px;" src=" {{  url('storage/'.$b->image)  }}" alt=""> </td>
                          <td>
                         <input  type="hidden" name="id1" value="{{$b->id}}">
                          <div class="card-body row">
                    <select class="form-control" name="product_status1" id="product_status">
                            <option value="Not Ready" {{($b->product_status == "Not Ready" ? 'selected' : '')}}>Not Ready</option>
                            <option value="Ready" {{($b->product_status == "Ready" ? 'selected' : '')}}>Ready</option>
                     </select>
                    </div>
                    </td>
                            </tr>

                    @endforeach
                @endif
                </tbody>
            </table> 
                 
                <div class="card-body row">
                <div class="col"> <strong>@lang('messages.order_page.currency'):</strong> <br> {{ucfirst($order->currencies['name'])}} </div>
                <div class="col"> <strong>@lang('messages.order_page.iso'):</strong> <br> {{ucfirst($order->currencies['iso'])}} </div>
                <div class="col"> <strong>@lang('messages.order_page.symbol'):</strong> <br> {{ucfirst($order->currencies['symbol'])}} </div>
                </div>

                <div class="card-body row">
                <div class="col"> <strong> Status:</strong> <br> </div>
                    <select class="form-control" name="status" id="status">
                             <option value="Pending" {{($order->status == "Pending" ? 'selected' : '')}}>Pending</option>
                            <option value="Confirmed" {{($order->status == "Confirmed" ? 'selected' : '')}}>Confirmed</option>
                            <option value="Shipped" {{($order->status == "Shipped" ? 'selected' : '')}}>Shipped</option>
                            <option value="Delivered" {{($order->status == "Delivered" ? 'selected' : '')}}>Delivered</option>
                            <option value="Cancelled" {{($order->status == "Cancelled" ? 'selected' : '')}}>Cancelled</option>
                            <option value="Payment Failed" {{($order->status == "Payment Failed" ? 'selected' : '')}}>Payment Failed</option>
                     </select>
                    </div>
                    <div class="card-body">
                    <a href="{{route('orders.index')}}">
                        <button type="button" class=" btn btn-success">
                        @lang('messages.button.back')
                        </button></a>
                        <button type="submit" class="btn btn-primary">@lang('messages.button.update_status')</button>
                    </div>
                </div>
                </form>
                </article>
              
              

                  
@endsection
