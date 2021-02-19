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
                        <th>Currency</th>
                        <th>Amount</th>
                        <th>Order Date</th>
                        <th class="not">Action</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $order)
                    <tr>    
                        <td>{{$order->order_id}}</td>   
                        <td>{{$order->currency_iso}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                        <div class="dropdown">
                    <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
                     Actions
                      <span class="caret"></span>
                     </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                             
                                             <li role="presentation">  <form action="{{ action('OrderController@show', [$order->order_id])}}" method="post">
                                       @csrf
                                       @method('GET')
                                       <button class="btn btn-light" type="submit">@lang('messages.button.order_details')</button>
                                         </form></li>
                                        
                                        
                                        
                                         </ul>
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
            toastr.success('Order  Ready');
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
            toastr.error('Order Not Ready');
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
