@extends('layouts.app')
@section('content')


<div class="container">
    <article class="card">
        <header class="card-header"> My Orders </header>
        <form action="{{ route('orders.update',['order'=> $order->id])}}" method="post"  enctype="multipart/form-data" > 
                {{ csrf_field() }}
                @method('PUT')
        <div class="card-body">
            <h6>Order ID: {{$order->id}}</h6>
            <article class="card">
                <div class="card-body row">
                    <div class="col"> <strong>Order Date:</strong> <br>{{$order->created_at}} </div>
                    <div class="col"> <strong>Order By:</strong> <br>{{ucfirst($order->users->first_name ." ".$order->users->last_name )}}</div>
                    <div class="col"> <strong>Email:</strong> <br>  {{ucfirst($order->users->email)}} </div>
                    <div class="col"> <strong>Contact No :</strong> <br> {{ucfirst($order->users->phone)}}</div>
                    <div class="col"> <strong>Total Quantity :</strong> <br> {{ucfirst($order->total_quantity)}}</div>
                    <div class="col"> <strong>Total Price:</strong> <br> {{ucfirst($order->total_price)}} </div>
                </div>
                <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th>Product Name </th>
                        <th>Product ID </th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        
                       
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
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table> 
                    <div class="card-body row">
                
                    <div class="col"> <strong>Address:</strong> <br> {{ucfirst($order->addresses['address_name'])}} </div>
                    <div class="col"> <strong>Address Line 1:</strong> <br> {{ucfirst($order->addresses['address_line1'])}} </div>
                    <div class="col"> <strong>Address Line 2:</strong> <br> {{ucfirst($order->addresses['address_line2'])}} </div>
                    <div class="col"> <strong>Country:</strong> <br> {{ucfirst($order->addresses->countries['name'])}} </div>
                    <div class="col"> <strong>City:</strong> <br> {{ucfirst($order->addresses['city'])}} </div>
                    <div class="col"> <strong>State:</strong> <br> {{ucfirst($order->addresses['state'])}} </div>
                    <div class="col"> <strong>Postal Code:</strong> <br> {{ucfirst($order->addresses['post_code'])}} </div>
                </div> 


                <div class="card-body row">
                <div class="col"> <strong>Status:</strong> <br> </div>
                    <select class="form-control" name="status" id="">
                            <option value="0" {{($order->status == "0" ? 'selected' : '')}}>Confirmed</option>
                            <option value="1" {{($order->status == "1" ? 'selected' : '')}}>Shipped</option>
                            <option value="2" {{($order->status == "2" ? 'selected' : '')}}>Delivered</option>
                     </select>
</div>

                    <div class="card-body">
                    <a href="{{route('orders.index')}}">
                        <button type="button" class=" btn btn-success">
                         Back To Orders
                        </button></a>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </div>
                </form>
                </article>
              
              

                  
@endsection
