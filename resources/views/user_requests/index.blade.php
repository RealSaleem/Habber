@extends('layouts.app')
@section('content')
    
<h1 class="page-title">@lang('messages.userrequest_page.userrequest') </h1>
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
              <th>User</th>
              <th>Title</th>
              <th>Author Name</th>
              <th>Book Type</th>
              <th class="not">Image</th>
              <th>Status</th>
              <th>Submission Date</th>
              <th class="not">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($userRequest as $userrequest)
            <tr>
              <td>{{$userrequest->id}}</td>
              <td>{{($userrequest->users['first_name'] ." ". $userrequest->users['last_name'])}}</td>
              <td>{{$userrequest->title}}</td>
              <td>{{$userrequest->author_name}}</td>
              <td>{{$userrequest->book_type}}</td>
              <td><img style=" width: 50px; height: 50px;" src=" {{ isset($userrequest->image) ?  url('storage/'.$userrequest->image) : url('storage/users/default.png') }}" alt=""> </td>
              <td>{{$userrequest->status == "0" ? "Pending" : "Seen"}}</td>  
              <td>{{$userrequest->created_at}}</td>  
              <td>
                <div class="row">
                  <div class="col-3">
                      <form action="{{action('UserRequestController@destroy', [$userrequest->id])}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                      </form>
                  </div>
                  <div class="col-3">
                    <a href="{{route('user_requests.show',[$userrequest->id])}}"><button class=" btn btn-success"><span class="fa fa-eye"></span></button></a>
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
