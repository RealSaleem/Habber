@extends('layouts.app')
@section('content')
    
<h1 class="page-title">@lang('messages.order_page.order')</h1>
<div class="ml-auto text-right">
</div> 
@if(Session::has('success'))
    <div class="alert alert-success text-center" role="alert">
        <strong>{{Session::get('success')}}</strong>
    </div>
@endif 
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Email</th>
                        <th>Order BY </th>
                        <th>Country</th>
                        <th>Currency</th>
                        <th>Order Total Amount</th>
                        <th>Total Quantity</th>
                        <th>Status</th>
                        <th>Payment Type</th>
                        <th class="not">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $order)
                    <tr>    
                        <td>{{$order->id}}</td>   
                        <td>{{$order->users['email']}}</td>
                        <td>{{($order->users['first_name'] ." ". $order->users['last_name'])}}</td>
                        <td>{{$order->addresses->countries['name']}}</td>
                        <td>{{$order->currencies['iso']}}</td>
                        <td>{{$order->total_price}}{{$order->currencies['symbol']}}</td>
                        <td>{{$order->total_quantity}}</td>
                        <td>{{$order->status == "0" ? "Not Ready " : "Ready"}}</td> 
                        <td>{{$order->type == "1" ?  "COD" : "Online"}}</td> 

                        <td>
                            <div class="row">
                                <div class="col-2">
                                    <form action="{{ action('OrderController@destroy', [$order->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span> </button>
                                         </form>
                                    <form action="{{ action('OrderController@show', [$order->id])}}" method="post">
                                       @csrf
                                       @method('GET')
                                       <button class="btn btn-success" type="submit">@lang('messages.button.order_details') </span></button>
                                         </form>
                                         </div>
                                         <div class="col-2">
                                         @if($order->status == 1)
                                         <a><button class="btn btn-danger" onclick="notreadyOrder('{{$order->id}}')">@lang('messages.order_page.not_ready') </button></a>
                                         @else
                                             <a>
                                        <button class="btn btn-info" onclick="readyOrder('{{$order->id}}')">
                                        @lang('messages.order_page.ready') 
                                         </button>
                                             </a>
                                             @endif
                                             </div>  
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>   
    </div>    
</div>
@endsection
@section('scripts')

<script>
function readyOrder($id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/orders/notready') }}" + "/" + $id,
        type: 'post',
        success: function(result)
        {
            toastr.error('Order Not Ready');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}

function notreadyOrder($id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/orders/ready') }}" + "/" + $id,
        type: 'POST',
        success: function(result)
        {
            toastr.success('Order Ready');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}
    $(document).ready(function() {
        $('#zero_config').DataTable({
            paging: true,
            dom: 'Bfrtip',
            buttons: [
                
                // 'csv', 'excel', 'pdf', 'print',
             
                {
                    extend: 'pdf',           
                    exportOptions: {
                        columns: ':visible:not(.not)' // indexes of the columns that should be printed,
                    }                      // Exclude indexes that you don't want to print.
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible:not(.not)'
                    }

                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible:not(.not)'
                    }

                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible:not(.not)'
                    }
                }         
            ],
            
        });

    })
</script>
@stop
