@extends('layouts.app')
@section('content')
    
<h1 class="page-title">@lang('messages.user_page.users')

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
    <a href="{{ route('users.create') }}" ><button style="color: grey;font-size:16px;border: 3px solid black" >  + Add New User</button> </a>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Language</th>
                        <th>Currency</th>
                        <th class="not">Image</th>
                        <th class="not"  >Action</th>
                        <th class="not"  ></th>
                        <th class="not"  ></th>
                        <th class="not" ></th>
                        <th class="not"  ></th>
                        <th class="not"  ></th>
                        <th class="not" ></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>   
                        <td>{{$user->id}}</td>
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>  
                        <td>{{ count($user->roles) > 0 ? $user->roles[0]->name : ""  }}</td>
                        <td class = "{{$user->status == 1 ? 'text-primary' : 'text-danger'}}" >{{$user->status == 1 ? "Active" : " In Active"}}</td>  
                        <td>{{$user->languages['name']}}</td>
                        <td>{{$user->currencies['name']}}</td>
                        <td><img style=" width: 50px; height: 50px;" src=" {{ isset($user->profile_pic) ?  url('storage/'.$user->profile_pic) : url('storage/users/default.png') }}" alt=""> </td>
                        <td> 
                                  
                              
                                    @if($user->status == 1)
                                        <a><button class="btn btn-danger" onclick="deactivateUser('{{$user->id}}')">@lang('messages.user_page.deactivate')</button></a>
                                    @else
                                        <a>
                                            <button class="btn btn-info" onclick="activateUser('{{$user->id}}')">
                                            @lang('messages.user_page.activate')
                                            </button>
                                        </a>
                                    @endif
                                   
                                </td>
                                 <td>
                               
                                    <a href="{{route('user.favourites',[$user->id])}}"><button class=" btn btn-light"> @lang('messages.user_page.favourites') </button></a>
                               
                                </td>
                               <td>
                                    <a href="{{route('user_address',[$user->id])}}"><button class=" btn btn-info">  @lang('messages.address_page.address')</button></a>
                                    </td> 
                                
                                <td>
                                    <a href="{{route('user_order',[$user->id])}}"><button class=" btn btn-dark">  @lang('messages.order_page.order')</button></a>
                                    </td>  
                                    <td>
                                    <a href=""><button class=" btn btn-warning">  @lang('messages.user_page.reset_password')</button></a>
                                    </td>  
                             <td>
                                    <form action="{{action('UserController@edit', [$user->id])}}" method="post">
                                    @csrf
                                    @method('get')
                                        <button class=" btn btn-success" type="submit">
                                        <span class="fa fa-edit"></span>
                                        </button>
                                    </form>
                                    </td>
                                    <td>
                                    <form action="{{ action('UserController@destroy', [$user->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                                    </form>                               
                              
                           
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

    })
</script>
@stop
