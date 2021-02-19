@extends('layouts.app')
@section('content')
    
<h1 class="page-title">@lang('messages.role_page.role')

</h1>
<div class="ml-auto text-right">
</div> 
@if(Session::has('success'))
    <div class="alert alert-success text-center" role="alert">
        <strong>{{Session::get('success')}}</strong>
    </div>
@endif 
<a href="{{ route('roles.create') }}" ><button style="color: grey;font-size:16px;border: 3px solid black" >  + Add New Role</button> </a>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>

                        <th class="not">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $roles)
                    <tr>    
                        <td>{{$roles->name}}</td>
                        <td>
                          <div class="dropdown">
                     <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
                     Actions
                     <span class="caret"></span>
                 </button>
             <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
             <li role="presentation">  <form action="{{ action('RoleController@destroy', [$roles->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class=" btn btn-light">Delete</button>
                                    </form></li>
                               
    
                                    <li role="presentation"> <form action="{{action('RoleController@edit', [$roles->id])}}" method="post">
                                    @csrf
                                    @method('get')
                                    <button class=" btn btn-light">Edit</button>
                                    </form></li>
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
            autoWidth: true,
            lengthChange: true,
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
