@extends('layouts.app')
@section('content')
    
<h1 class="page-title">@lang('messages.ad_page.ad')</h1>
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
                        <th>Featured</th>
                        <th class="not">Image</th>
                        <th class="not">Action</th>
                        </tr>
                </thead>
                <tbody class="sortable">
                    @foreach($ad as $ad)
                    <tr class="row1" data-id="{{ $ad->id }}">

                        <td class = "{{$ad->featured == 1 ? 'text-primary' : 'text-danger'}}" >{{$ad->featured == 1 ? "Featured" : "Not Featured"}}</td>  
                        <td><img style=" width: 50px; height: 50px;" src=" {{ isset($ad->image) ?  url('storage/'.$ad->image) : url('storage/ads/default.png') }}" alt=""> </td>
                        <td>
                            <div class="row">
                                <div class="col-2">
                                    <a href="{{action('AdController@edit', [$ad->id])}}"><button class=" btn btn-success"><span class="fa fa-edit"></span></button></a>
                                </div>
                                <div class="col-2">
                                    <form action="{{ action('AdController@destroy', [$ad->id])}}" method="post">
                                    @csrf
                                    @method('Delete')
                                        <button class=" btn btn-danger" type="submit">
                                        <span class="fa fa-trash"></span>
                                        </button>
                                    </form>
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
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
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

    })
    
function disablebanner(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/banner/disable') }}" + "/" + id,
        type: 'post',
        success: function(result)
        {
            toastr.error('Banner Disabled');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}

function enablebanner(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/banner/enable') }}" + "/" + id,
        type: 'POST',
        success: function(result)
        {
            toastr.success('Banner Enabled');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}

    $( ".sortable" ).sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function() {
            sendOrderToServer();
        }
    });
    
    function sendOrderToServer() {
        var order = [];
        var token = $('meta[name="csrf-token"]').attr('content');
        $('tr.row1').each(function(index,element) {
        order.push({
            id: $(this).attr('data-id'),
            position: index+1
        });
        });

        $.ajax({
        type: "POST", 
        dataType: "json", 
        url: "{{ url('admin/banners-sortable') }}",
            data: {
            order: order,
            _token: token
        },
        success: function(response) {
            if (response == true) {
                toastr.success('Banners Order Updated');
                window.setTimeout(function(){location.reload()},2000);
            } else {
                console.log(response);
            }
        }
        });
    }

</script>
@stop
