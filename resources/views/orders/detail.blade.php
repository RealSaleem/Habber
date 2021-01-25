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
                    <div class="col"> <strong>@lang('messages.order_page.total_price'):</strong> <br> {{$order->total_price}}{{$order->currencies['iso']}} </div>
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
                    <div class="col"> <strong>@lang('messages.address_page.address'):</strong> <br> {{ucfirst($order->addresses['address_name'])}} </div>
                    <div class="col"> <strong>@lang('messages.address_page.address_line1'):</strong> <br> {{ucfirst($order->addresses['address_line1'])}} </div>
                    <div class="col"> <strong>@lang('messages.address_page.address_line2'):</strong> <br> {{ucfirst($order->addresses['address_line2'])}} </div>
                    <div class="col"> <strong>@lang('messages.address_page.country'):</strong> <br> {{ucfirst($order->addresses->countries['name'])}} </div>
                    <div class="col"> <strong>@lang('messages.address_page.city'):</strong> <br> {{ucfirst($order->addresses->cities['name'])}} </div>
                    <div class="col"> <strong>@lang('messages.address_page.state'):</strong> <br> {{ucfirst($order->addresses['state'])}} </div>
                    <div class="col"> <strong>@lang('messages.address_page.post_code'):</strong> <br> {{ucfirst($order->addresses['post_code'])}} </div>
                </div> 
                <div class="card-body row">
                <div class="col"> <strong>@lang('messages.order_page.currency'):</strong> <br> {{ucfirst($order->currencies['name'])}} </div>
                <div class="col"> <strong>@lang('messages.order_page.iso'):</strong> <br> {{ucfirst($order->currencies['iso'])}} </div>
                <div class="col"> <strong>@lang('messages.order_page.symbol'):</strong> <br> {{ucfirst($order->currencies['symbol'])}} </div>
                </div>

                <div class="card-body row">
                <div class="col"> <strong>@lang('messages.book_page.status'):</strong> <br> </div>
                    <select class="form-control" name="status" id="">
                            <option value="0" {{($order->status == "0" ? 'selected' : '')}}>Confirmed</option>
                            <option value="1" {{($order->status == "1" ? 'selected' : '')}}>Shipped</option>
                            <option value="2" {{($order->status == "2" ? 'selected' : '')}}>Delivered</option>
                     </select>
                    </div>
                    <div class="card-body row">
                <div class="col"> <strong>@lang('messages.order_page.order_status'):</strong> <br> </div>
                    <select class="form-control" name="status" id="">
                            <option value="0" {{($order->order_status == "0" ? 'selected' : '')}}>Not Ready</option>
                            <option value="1" {{($order->order_status == "1" ? 'selected' : '')}}>Ready</option>
                     </select>
                    </div>
                    <div class="card-body row">
                <div class="col"> <strong>@lang('messages.book_page.status'):</strong> <br> </div>
                    <select class="form-control" name="status" id="">
                            <option value="0" {{($order->status == "0" ? 'selected' : '')}}>Pending</option>
                            <option value="1" {{($order->status == "1" ? 'selected' : '')}}>Seen</option>
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
