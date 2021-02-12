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
            
            <input  type="hidden" id='v' name="remember_token" value="{{$order->id}}">
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
                          <input  type="hidden" id="id1" value="{{$o->id}}">
                          
                    <select class="form-control" name="product_status" id="product_status" onchange="func(this);">
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
                         <input  type="hidden" id="id2" value="{{$b->id}}">
                          <div class="card-body row">
                    <select class="form-control" name="product_status1" id="product_status1" onchange="func1(this);">
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
                <div class="col"> <strong>@lang('messages.book_page.status'):</strong> <br> {{ucfirst($order->status)}} </div>
                </div>

                <div class="card-body row">
                <div class="col"> <strong> Status:</strong> <br> </div>
                    <select class="form-control" name="status" id="status">
                            <option> Select the option </option>
                            <option value="Confirmed" {{($order->status == "Confirmed" ? 'selected' : '')}}>Confirmed</option>
                            <option value="Shipped" {{($order->status == "Shipped" ? 'selected' : '')}}>Shipped</option>
                            <option value="Delivered" {{($order->status == "Delivered" ? 'selected' : '')}}>Delivered</option>
                         
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
              
    
<script>
   function func(obj){
       var s=obj.options[obj.selectedIndex].value;
       var ss=document.getElementById("id1").value;
       var sss=document.getElementById("v").value;
       var token=$('meta[name="csrf-token"]').attr('content');
       $.ajax({
        type: "POST", 
        dataType: "json", 
        url: "{{ url('admin/update1') }}",
            data: {
            o: s,
            oo: ss,
            id: sss,
            _token: token
        }
       });
    }
      </script>
      <script>
        function func1(obj){
       var s=obj.options[obj.selectedIndex].value;
       console.log(s);
       var ss=document.getElementById("id2").value;
       console.log(ss);
       var sss=document.getElementById("v").value;
       var token=$('meta[name="csrf-token"]').attr('content');
       $.ajax({
        type: "POST", 
        dataType: "json", 
        url: "{{ url('admin/update2') }}",
            data: {
            o: s,
            oo: ss,
            id: sss,
            _token: token
        }
       });
    }
      </script>


                  
@endsection
