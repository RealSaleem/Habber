@extends('layouts.app')
@section('content')
    
<h1 class="page-title">@lang('messages.publisher_page.publisher')
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
    <a href="{{ route('publisher.create') }}" ><button style="color: grey;font-size:16px;border: 3px solid black" >  + Add New Publisher</button> </a>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Product Type</th>
                        <th>Operating Country</th>
                        <th>Status</th>
                        <th>Addition Date</th>
                        <th class="not">Image</th>
                        <th class="not">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publisher as $publisher)
                    <tr>    

                        <td>{{$publisher->first_name}}</td>
                        <td>{{$publisher->last_name}}</td>
                        <td>{{$publisher->email}}</td>
                        <td>{{$publisher->businesses['product_type']}}</td> 
                        <td>{{$publisher->countries['name']}}</td> 
                        <td class = "{{$publisher->status == 1 ? 'text-primary' : 'text-danger'}}" >{{$publisher->status == 1 ? "Active" : " In Active"}}</td>  
                        <td>{{$publisher->created_at}}</td> 
                        <td><img style=" width: 50px; height: 50px;" src=" {{ isset($publisher->profile_pic) ?  url('storage/'.$publisher->profile_pic) : url('storage/users/default.png') }}" alt=""> </td>
                        <td>
                        <div class="dropdown">
<button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
  Actions
    <span class="caret"></span>
</button>
<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
@if($publisher->status == 1)
<a><button class="btn btn-light" onclick="deactivateUser('{{$publisher->id}}')">@lang('messages.user_page.deactivate')</button></a></li>
   @else
  <li role="presentation">   <a>
                                            <button class="btn btn-light" onclick="activateUser('{{$publisher->id}}')">
                                            @lang('messages.user_page.activate')
                                            </button>
                                        </a></li>
   @endif
  <li role="presentation"> <a href="{{action('PublisherController@show',[$publisher->id])}}"><button class=" btn btn-light">Details</button></a</li>
  <li role="presentation">  <form action="{{ action('PublisherController@destroy', [$publisher->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-light" type="submit">Delete</button>
                                    </form></li>
 <li role="presentation">   <form action="{{action('PublisherController@edit', [$publisher->id])}}" method="post">
                                    @csrf
                                    @method('get')
                                        <button class=" btn btn-light" type="submit">
                                        Edit
                                        </button>
                                    </form>
                                    </li>
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
            toastr.error('Publisher Deactivated');
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
            toastr.success('Publisher Activated');
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
