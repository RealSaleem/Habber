@extends('layouts.app')
@section('content')
    
<h1 class="page-title">@lang('messages.push_notifications_page.history')
</h1>
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
                        <th>Title</th>
                        <th>Description</th>
                        <th>To</th>
                    </tr>
                </thead>
                <tbody>
                @if($value!=null)
                    @foreach($value as $v)
                    <tr>    

                        <td>{{$v['title']}}</td>
                        <td>{{$v['body']}}</td>
                        <td>{{$v['to']}}</td>
                        
                            
                                
                    </tr>
                    @endforeach
                    @endif
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
                    orientation: 'landscape',   
                     pageSize: 'LEGAL',                 
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
});   
</script>
@stop