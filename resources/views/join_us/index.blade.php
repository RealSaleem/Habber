@extends('layouts.app')
@section('content')
    
<h1 class="page-title">User Request </h1>
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
          @foreach($user as $u)
            <tr>
              <td>{{$u->id}}</td>
              <td>{{ucfirst($u->first_name .' '.$u->last_name)}}</td>
              <td>{{$u->email}}</td>
              <td>{{$u->phone}}</td>
              <td>{{$u->businesses['business_type']}}</td>
              <td>{{$u->businesses['product_type'] == "both" ? 'Books, Bookmarks' : $u->businesses['product_type']}}</td>
              <td>{{$u->businesses['details']}}</td>
              <td>{{$u->status == "0" ? "Pending" : "Seen"}}</td>  
              <td>{{$u->created_at}}</td>  
              <td>
                <div class="row">
                  <div class="col-5">
                      <form action="{{action('UserController@destroyRequest', [$u->id])}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                      </form>
                  </div>
                  <div class="col-2">
                    <a href="{{action('UserController@showJoinUsRequest', [$u->id])}}"><button class=" btn btn-success"><span class="fa fa-eye"></span></button></a>
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
