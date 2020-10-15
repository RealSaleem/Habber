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
                        <th>User</th>
                        <th>Title</th>
                        <th>Author Name</th>
                        <th>Book Type</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
               </thead>
               <tbody>
              @foreach($userrequest as $userrequest)
        <tr>
           <td>{{$userrequest->users['first_name'] ." ". $business->users['last_name']}}</td>
            <td>{{$userrequest->title}}</td>
            <td>{{$userrequest->author_name}}</td>
            <td>{{$userrequest->book_type}}</td>
            <td><img style=" width: 50px; height: 50px;" src=" {{ isset($userrequest->image) ?  url('storage/'.$userrequest->image) : url('storage/user_requests/default.png') }}" alt=""> </td> 
            <td>
                <form action="{{ action('UserRequestController@destroy',[$userrequest->id])}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                    <a href="{{action('UserRequestController@edit',[$userrequest->id])}}"><button class=" btn btn-success">
                    <span class="fa fa-edit"></span>
                    Edit
                </button></a>
                </td>
        </tr>
        @endforeach            
    </tbody>
  </table>
<div>
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
