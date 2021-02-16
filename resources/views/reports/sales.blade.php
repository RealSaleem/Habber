@extends('layouts.app')
@section('content')    
<h1 class="page-title">@lang('messages.reports_page.sale_reports')</h1> 
<div id="sa" class="sa">
<label for="from">From</label>
<input type="date" id="from" name="from" />
<label for="to">to</label>
<input type="date" id="to" name="to" />
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        @if($fromUser->hasRole('admin'))
                        <th>Publisher Name</th>
                        @endif
                        <th>Payment</th>
                        @if($fromUser->hasRole('admin'))
                        <th class="not">Action</th>
                        @endif
                        
                    </tr>
                </thead>

                <tbody>
          
                @if($fromUser->hasRole('admin'))
                @foreach($publishers as $publisher)
        @if(count($publisher->books ) > 0)
        @foreach($publisher->books as $b)
        @foreach($b->orders as $k)
                    <tr>    

                        <td>{{$k['id']}}</td>
                        <td>{{$k['created_at']}}</td>
                        @if($fromUser->hasRole('admin'))
                        <td>{{($publisher['first_name'] ." ".$publisher['last_name'] )}}</td>
                        @endif
                        <td>{{$k['total_price']}}  {{($k->currencies['iso'])}} </td>
                        @if($fromUser->hasRole('admin'))
                        <td>
                        <div class="row">
                               <div>
                            <a href="{{action('ReportController@show',[$publisher['id']])}}"><button class=" btn btn-success"><span class="fa fa-eye"></span></button></a>
                             </div></td>
                             @endif
                    </tr>
                    @endforeach
                    @endforeach
                    @endif
                    @endforeach
                    
                </tbody>
                <tfoot>
                    <tr>
                    <td colspan="2" rowspan="1">Grand Total</td>
                    <td rowspan="1" colspan="1">{{$total_price }} {{$k->currencies->iso}} </td>
                    </tr>
                <tfoot>
                <tbody>
                @endif
                @if($fromUser->hasRole('publisher'))
        @if(count($orders) != 0)
        @foreach($orders as $k)
                    <tr>    

                        <td>{{$k['id']}}</td>
                        <td>{{$k['created_at']}} </td>
                        @if($fromUser->hasRole('admin'))
                        <td>{{($publisher['first_name'] ." ".$publisher['last_name'] )}}</td>
                        @endif
                        <td>{{$k['total_price']}}  {{($k->currencies['iso'])}} </td>
                        @if($fromUser->hasRole('admin'))
                        <td>
                        <div class="row">
                               <div>
                            <a href="{{action('ReportController@show',[$publisher['id']])}}"><button class=" btn btn-success"><span class="fa fa-eye"></span></button></a>
                             </div></td>
                             @endif
                    </tr>
             
                  
                    @endforeach
                    @endif
                    
                </tbody>
                <tfoot>
                    <tr>
                    <td colspan="2" rowspan="1">Grand Total</td>
                    <td rowspan="1" colspan="1">{{$total_price }} {{$currency}} </td>
                    </tr>
                </tfoot>
                @endif
                
            </table>
            <tr>
        </div>   
    </div>    
</div>
@endsection
@section('scripts')

<script>
$(document).ready(function() {
    
    fill_datatable();

    function fill_datatable(to='',from=''){
        $('#zero_config').DataTable({
            paging: true,
            autoWidth: true,
            lengthChange: true,
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            ajax:{
                url: "{{ route('report1') }}",
                data:{to:to, from:from}
            },
            columns: [
                {
                    data:'id',
                    name:'OrderID'
                },
                {
                    data:'created_at',
                    name:'OrderDate'
                },
                {
                    data:'first_name',
                    name:'PublisherName'
                },
                {
                    data:'total_price',
                    name:'Payment'
                },
            ],
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

    }  });

    $('#to').onchange(function(){
        var from = $('#from').val();
        var to = $('#to').val();

        if(from != '' &&  to != '')
        {
            $('##zero_config').DataTable().destroy();
            fill_datatable(from, to);
        }
        else
        {
            alert('Select Both filter option');
        }
    });

</script>


@stop
