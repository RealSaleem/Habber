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
              <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user as $u)
            <tr>
              <td>{{$u->id}}</td>
              <td>{{ucfirst($u->first_name .' '.$u->last_name)}}</td>
              <td>{{$u->email}}</td>
              <td>{{$u->phone}}</td>
              <td>{{$u->businesses->business_type}}</td>
              <td>{{$u->businesses->product_type == "both" ? 'Books, Bookmarks' : $u->businesses->product_type}}</td>
              <td>{{$u->notes}}</td>
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
        var table = $('#zero_config').DataTable({
    "lengthMenu": [[50, 100, 1000, -1], [50, 100, 1000, "All"]],
    "initComplete": function(){ 
      $("#zero_config").show(); 
    },
    buttons: ['copy', 'csv', 'pdf', 'print' ]
  });
  table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
});   
</script>
@stop
