@extends('layouts.app')
@section('content')
    
<h1 class="page-title"> Join Us Request </h1>
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
              <th>Submission Id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Business Type</th>
              <th>Product Type</th>
              <th>Details</th>
              <th>Status</th>
              <th>Submission Date</th>
              <th class="not">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($business as $b)
            <tr>
              <td>{{$b->id}}</td>
              <td>{{$b->name}}</td>
              <td>{{$b->email}}</td>
              <td>{{$b->phone}}</td>
              <td>{{$b->business_type}}</td>
              <td>{{$b->product_type == "both" ? 'Books, Bookmarks' : $b->product_type}}</td>
              <td>{{$b->details}}</td>
              <td>{{$b->status == "0" ? "Pending" : "Seen"}}  </td>  
              <td>{{$b->created_at}}</td>  
              <td>
              <div class="dropdown">
        <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
         Actions
      <span class="caret"></span>
      </button>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                
                  <li role="presentation">  <form action="{{action('BusinessController@destroyRequest', [$b->id])}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-light" type="submit">Delete</button>
                      </form></li>
                  <li role="presentation">  <a href="{{action('BusinessController@showJoinUsRequest', [$b->id])}}"><button class=" btn btn-light">Details</button></a></li>
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
    $(document).ready(function() {
      $('#zero_config').DataTable({
        "order": [[ 0, "desc" ]],
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
