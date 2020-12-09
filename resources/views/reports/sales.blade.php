@extends('layouts.app')
@section('content')
    
<h1 class="page-title">Sales Report</h1>
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
                        <th>Registered</th>
                        <th>Publisher Name</th>
                        <th>Payment</th>
                        <th class="not">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $order)
                    <tr>    

                        <td>{{$order->id}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{($order->users->first_name ." ".$order->users->last_name )}}</td>
                        <td>{{$order->total_price}}  {{($order->currencies['iso'])}} </td>
                        <td>
                        <div class="row">
                               <div>
                            <a href="{{action('ReportController@show',[$order->id])}}"><button class=" btn btn-success">Publisher Reports</button></a>
                             </div></td>
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
