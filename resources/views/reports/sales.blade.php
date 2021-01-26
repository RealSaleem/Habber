@extends('layouts.app')
@section('content')
    
<h1 class="page-title">@lang('messages.reports_page.sale_reports')</h1> 
{{ $dt->format('Y-m-d H:i:s')}}
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
          
        @foreach($publishers as $publisher)
        @if(count($publisher->books ) > 0)
        @foreach($publisher->books as $b)
        @foreach($b->orders as $k)
                    <tr>    

                        <td>{{$k['id']}}</td>
                        <td>{{$k['created_at']}} to {{ $dt->format('Y-m-d H:i:s')}}</td>
                        <td>{{($publisher['first_name'] ." ".$publisher['last_name'] )}}</td>
                        <td>{{$k['total_price']}}  {{($k->currencies['iso'])}} </td>
                        <td>
                        <div class="row">
                               <div>
                            <a href="{{action('ReportController@show',[$publisher['id']])}}"><button class=" btn btn-success"><span class="fa fa-eye"></span></button></a>
                             </div></td>
                    </tr>
                    @endforeach
                    @endforeach
                    @endif

            @if(count($publisher->bookmarks ) > 0)
        @foreach($publisher->bookmarks as $bm)
        @foreach($bm->orders as $k)
                    <tr>    

                        <td>{{$k['id']}}</td>
                        <td>{{$k['created_at']}} to {{ $dt->format('Y-m-d H:i:s')}}  </td>
                        <td>{{($publisher['first_name'] ." ".$publisher['last_name'] )}}</td>
                        <td>{{$k['total_price']}}  {{($k->currencies['iso'])}} </td>
                        <td>
                        <div class="row">
                               <div>
                            <a href="{{action('ReportController@show',[$publisher['id']])}}"><button class=" btn btn-success"><span class="fa fa-eye"></span></button></a>
                             </div></td>
                    </tr>
                   
                    @endforeach
                    @endforeach
                    @endif
                    @endforeach
                    
                </tbody>
                <tfoot>
                    <tr>
                    <td colspan="3" rowspan="1">Grand Total</td>
                    <td rowspan="1" colspan="1">{{$total_price}}{{($k->currencies['iso'])}}<td>
                    </tr>
                <tfoot>
                
            </table>
            <tr>
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
            footer: true,
            buttons: [
                
                // 'csv', 'excel', 'pdf', 'print',
             
                {
                    extend: 'pdf',    
                    footer: true,       
                    exportOptions: {
                        column: ':visible:not(.not)' // indexes of the columns that should be printed,
                    }                      // Exclude indexes that you don't want to print.
                },
                {
                    extend: 'csv',
                    footer: true,
                    exportOptions: {
                        column: ':visible:not(.not)'
                    }

                },
                {
                    extend: 'excel',
                    footer: true,
                    exportOptions: {
                        column: ':visible:not(.not)'
                    }

                },
                {
                    extend: 'print',
                    footer: true,
                    exportOptions: {
                        column: ':visible:not(.not)'
                    }
                }         
            ],
            
        });

    })
</script>
@stop
