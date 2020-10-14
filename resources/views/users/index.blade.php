@extends('layouts.app')
@section('content')
    
<h1 class="page-title">Users</h1>
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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
               </thead>
               <tbody>
              @foreach($user as $user)
        <tr>
            
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>  
            <td class = "{{$user->status == 1 ? 'text-primary' : 'text-danger'}}" >{{$user->status == 1 ? "active" : "not active"}}</td>  
            <td><img style=" width: 50px; height: 50px;" src=" {{ isset($user->profile_pic) ?  url('storage/'.$user->profile_pic) : url('storage/users/default.png') }}" alt=""> </td>
            <td>
                <form action="{{ action('UserController@destroy', [$user->id])}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                </button></a>
                    <a href="{{action('UserController@edit', [$user->id])}}"><button class=" btn btn-success">
                    <span class="fa fa-edit"></span>
                    Edit
                </button></a>
                @if($user->status == 1)
                    <a><button class="btn btn-danger" onclick="deactivateUser('{{$user->id}}')">Deactivate</button></a>
                @else
                    <a>
                        <button class="btn btn-info" onclick="activateUser('{{$user->id}}')">
                            Activate
                        </button>
                    </a>
                @endif
                
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection
@section('scripts')

<script>
function deactivateUser(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/user/deactivate') }}" + "/" + id,
        type: 'post',
        success: function(result)
        {
            toastr.error('User Deactivated');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}

function activateUser(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/user/activate') }}" + "/" + id,
        type: 'POST',
        success: function(result)
        {
            toastr.success('User Activated');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}
    $(document).ready(function() {
        $('#zero_config').DataTable({
        paging: true,
       
     });

    })
</script>
@stop
