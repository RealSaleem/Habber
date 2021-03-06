@extends('layouts.app')
@section('content')
    
<h1 class="page-title">@lang('messages.banner_page.banners')</h1>
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
        <a href="{{ route('banners.create') }}" ><button style="color: grey;font-size:16px;border: 3px solid black" >  + Add New Banner</button> </a>
            <table id="zero_config" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th>Description</th>
                        <th>Product Type</th>
                        <th>Associated With</th>
                        <th>Banner Link </th>
                        <th>Status</th>
                        <th class="not">Image</th>
                        <th>Banner Order</th>
                        <th class="not">Action</th>
                        
                        </tr>
                </thead>
                <tbody class="sortable">
                    @foreach($banner as $banner)
                    <tr class="row1" data-id="{{ $banner->id }}">
                        <td>{{$banner->description}}</td> 
                        <td>{{$banner->product_type}}</td>
                        @if(isset($banner->books))
                        <td> 
                        {{$banner->books['title']}}
                         </td>
                         @elseif(isset($banner->bookclubs))
                         <td> 
                            {{$banner->bookclubs['name']}}
                         </td>
                         @elseif(isset($banner->bookmarks))
                         <td> 
                            {{$banner->bookmarks['title']}}
                         </td>
                         @else
                         <td>Not Selected</td>  

                         @endif
                        
                        <td>{{$banner->banner_url}}
                        <td class = "{{$banner->status == 1 ? 'text-primary' : 'text-danger'}}" >{{$banner->status == 1 ? "Enabled" : "Disabled"}}</td> 
                        <td><img style=" width: 50px; height: 50px;" src=" {{ isset($banner->image) ?  url('storage/'.$banner->image) : url('storage/banners/default.png') }}" alt=""> </td>
                        <td>{{$banner->sort_order}}</td>
                        <td>
                        <div class="dropdown">
                              <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
                             Actions
                         <span class="caret"></span>
                          </button>
                             <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                    @if($banner->status == 1)
                                    <li role="presentation"> <a><button class="btn btn-light" onclick="disablebanner('{{$banner->id}}')">@lang('messages.banner_page.disable')</button></a></li>
                                    @else
                                    <li role="presentation">  <a><button class="btn btn-light" onclick="enablebanner('{{$banner->id}}')">@lang('messages.banner_page.enable') </button></a></li>
                                    @endif
                                  
                                    <li role="presentation">  <form action="{{action('BannerController@destroy', [$banner->id])}}" method="post">
                                    @csrf
                                    @method('Delete')
                                        <button class=" btn btn-light" type="submit">
                                      Delete
                                        </button>
                                    </form></li>
                                    <li role="presentation">  <a href="{{action('BannerController@edit', [$banner->id])}}"><button class=" btn btn-light">Edit</button></a></li>
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
          
          if(result == 'false') {
              toastr.error('Banner Cannot be Enabled!. You can only enable 3 Banners at a time');
              window.setTimeout(function(){location.reload()},2000);
          }
          else {
                toastr.success('Banner Enabled');
                window.setTimeout(function(){location.reload()},2000);
            }
           
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
