@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.business_page.business')</h1>
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
                        <th>User</th>
                        <th>Name</th>
                        <th>Business Type</th>
                        <th>Product Type</th>
                        <th>Details</th>
                        <th class="not"> Action</th>                  
                    </tr>
               </thead>
               <tbody>
               @foreach($business as $business)
           <tr>
            
            <td>{{$business->users['first_name'] ." ". $business->users['last_name']}}</td>
            <td>{{$business->name}}</td>
            <td>{{$business->business_type}}</td>
            <td>{{$business->product_type}}</td>  
            <td>{{$business->details}}</td>
            <td>
                <div class="row">
                    <div class="col-2">
                        <form action="{{ action('BusinessController@destroy', [$business->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                        </form>
                    </div>
                    <div class="col-2">
                        <a href="{{ action('BusinessController@edit', [$business->id])}}"><button class=" btn btn-success"><span class="fa fa-edit"></span></button></a>
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