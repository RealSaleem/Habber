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
                        <td class = "{{$publisher->status == 1 ? 'text-primary' : 'text-danger'}}" >{{$publisher->status == 1 ? "active" : "not active"}}</td>  
    
                        <td><img style=" width: 50px; height: 50px;" src=" {{ isset($publisher->profile_pic) ?  url('storage/'.$publisher->profile_pic) : url('storage/users/default.png') }}" alt=""> </td>
                        <td>
                        <div class="row">
                               <div>
                                    <a href="{{action('PublisherController@show',[$publisher->id])}}"><button class=" btn btn-success"><span class="fa fa-eye"></span></button></a>
                                     </div>
                                <div class="col-2">
                                    <form action="{{ action('PublisherController@destroy', [$publisher->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                                    </form>
                                </div>
                                <div class="col-2">
                                    <form action="{{action('PublisherController@edit', [$publisher->id])}}" method="post">
                                    @csrf
                                    @method('get')
                                        <button class=" btn btn-success" type="submit">
                                        <span class="fa fa-edit"></span>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-3">
                                    @if($publisher->status == 1)
                                        <a><button class="btn btn-danger" onclick="deactivatePublisher('{{$publisher->id}}')">@lang('messages.user_page.deactivate')</button></a>
                                    @else
                                        <a>
                                            <button class="btn btn-info" onclick="activatePublisher('{{$publisher->id}}')">
                                            @lang('messages.user_page.activate')
                                            </button>
                                        </a>
                                    @endif
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
function deactivatePublisher(id) {
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

function activatePublisher(id) {
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
