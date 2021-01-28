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
    <a href="{{ route('ads.create') }}" ><button style="color: grey;font-size:16px;border: 3px solid black" >  + Add New Ad</button> </a>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th>Featured</th>
                        <th>status</th>
                        <th class="not">Image</th>
                        <th class="not">Action</th>
                       
                        </tr>
                </thead>
                <tbody class="sortable">
                    @foreach($ad as $ad)
                    <tr class="row1" data-id="{{ $ad->id }}">

                        <td class = "{{$ad->featured == 1 ? 'text-primary' : 'text-danger'}}" >{{$ad->featured == 1 ? "Featured" : "UnFeatured"}}</td>  
                        <td class = "{{$ad->status == 1 ? 'text-primary' : 'text-danger'}}" >{{$ad->status == 1 ? "Enable" : "Disable"}}</td>  
                        <td><img style=" width: 50px; height: 50px;" src=" {{ isset($ad->image) ?  url('storage/'.$ad->image) : url('storage/ads/default.png') }}" alt=""> </td>
                        <td>
                        <div class="dropdown">
                    <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
                     Actions
                  <span class="caret"></span>
                    </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                    @if($ad->status == 1)
                                    <li role="presentation"> <a><button class="btn btn-light" onclick="disableAd('{{$ad->id}}')">@lang('messages.banner_page.disable')</button></a></li>
                                    @else
                                    <li role="presentation">  <a><button class="btn btn-light" onclick="enableAd('{{$ad->id}}')">@lang('messages.banner_page.enable') </button></a></li>
                                    @endif
                            
                                    <li role="presentation"> <a href="{{action('AdController@edit', [$ad->id])}}"><button class=" btn btn-light">Edit</button></a></li>
                             
                                    <li role="presentation"> <form action="{{ action('AdController@destroy', [$ad->id])}}" method="post">
                                    @csrf
                                    @method('Delete')
                                        <button class=" btn btn-light" type="submit">
                                        Delete
                                        </button>
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
    
function disableAd(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/ad/disable') }}" + "/" + id,
        type: 'post',
        success: function(result)
        {
            toastr.error('Ad Disabled');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}

function enableAd(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/ad/enable') }}" + "/" + id,
        type: 'POST',
        success: function(result)
        {
            toastr.success('Ad Enabled');
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
