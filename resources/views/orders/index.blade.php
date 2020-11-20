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
                        <th>User ID</th>
                        <th>Address</th>
                        <th>Total Price</th>
                        <th>Total Quantity</th>
                        <th>Status</th>
                        <th class="not">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $order)
                    <tr>    

                        <td>{{$order->user_id}}</td>
                        <td>{{$order->address_id}}</td>
                        <td>{{$order->total_price}}</td>
                        <td>{{$order->total_quantity}}</td>
                        <td>{{$order->status == "0" ? "Pending" : "Seen"}}</td> 
                        <td>
                            <div class="row">
                                <div class="col-2">
                                    <form action="{{ action('OrderController@destroy', [$order->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"> @lang('messages.button.cancel_order') </button>
                                    </form>
                                </div>
                                    <form action="{{ action('OrderController@show', [$order->id])}}" method="post">
                                       @csrf
                                       @method('GET')
                                       <button class="btn btn-success" type="submit">@lang('messages.button.order_details') </span></button>
                                         </form>
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
function deactivateOrder(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/orders/deactivate') }}" + "/" + id,
        type: 'post',
        success: function(result)
        {
            toastr.error('Order Deactivated');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}

function activateOrder(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/orders/activate') }}" + "/" + id,
        type: 'POST',
        success: function(result)
        {
            toastr.success('Order Activated');
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
