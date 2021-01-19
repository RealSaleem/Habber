
@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.bookmark_page.bookmarks')</h1>
<div class="ml-auto text-right">
</div> 
@if(Session::has('success'))
    <div class="alert alert-success text-center" role="alert">
        <strong>{{Session::get('success')}}</strong>
    </div>
@endif 
<div class="card">
    <div class="card-body">
    <a href="{{ route('bookmarks.create') }}" ><button style="color: grey;font-size:16px;border: 3px solid black" >  + Add New Bookmark</button> </a>
       <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Product ID </th>
                        <th>Title</th>
                        <th>Arabic Title</th>
                        <th>Maker Name</th>
                        <th>Arabic Maker Name</th>
                        <th>Description</th>
                        <th>Arabic Description</th>
                        <th>Price</th>
                        <th>Size</th>         
                        <th>Quantity </th>
                        <th>Bookmark Type</th>
                        <th>Added by</th>
                        <th>Feature</th>
                        <th>Status</th>
                        <th>Addition Date</th>
                        <th class="not">Image</th>
                        <th class="not"> Action</th>  
                        <th class="not"> </th>  
                        <th class="not"> </th>  
                        <th class="not"> </th>  
                        <th class="not"> </th>  
                        

                                     
                    </tr>
               </thead>
               <tbody>
               @foreach($bookmark as $bookmark)
            <tr>
                <td>{{$bookmark->bookmark_id}}</td>
                <td>{{$bookmark->title}}</td>
                <td>{{$bookmark->arabic_title}}</td>
                <td>{{$bookmark->maker_name}}</td>
                <td>{{$bookmark->arabic_maker_name}}</td>
                <td>{{$bookmark->description}}</td>
                <td>{{$bookmark->arabic_description}}</td>
                <td>{{($bookmark->product_prices[0])->price}}</td>  
                <td>{{$bookmark->size }}</td>
                <td>{{$bookmark->quantity}}</td>
                <td>{{$bookmark->type_of_bookmark}}
                <td>{{$bookmark->users['first_name']}}</td>  
                <td class = "{{$bookmark->featured == 1 ? 'text-primary' : 'text-danger'}}" >{{$bookmark->featured == 1 ? "Featured" : "UnFeatured"}}</td>  
                 <td class = "{{$bookmark->status == 1 ? 'text-primary' : 'text-danger'}}" >{{$bookmark->status == 1 ? "Active" : "In Active"}}</td> 
                 <td>{{$bookmark->created_at}}</td>
                <td><img style=" width: 50px; height: 50px;" src=" {{ isset($bookmark->image) ?  url('storage/'.$bookmark->image) : url('storage/bookmarks/default.png') }}" alt=""> </td>
                <td>
                            @if($bookmark->status == 0)
                                <a><button class="btn btn-info" onclick="activateBookmark('{{$bookmark->id}}')">@lang('messages.user_page.activate')</button></a>
                            @else
                                <a><button class="btn btn-danger" onclick="deactivateBookmark('{{$bookmark->id}}')">@lang('messages.user_page.deactivate')</button></a>
                            @endif
                            </td>
                       <td>
                            @if($bookmark->featured == 0)
                                <a><button class="btn btn-primary" onclick="featureBookmark('{{$bookmark->id}}')">Featured</button></a>
                            @else
                                <a><button class="btn btn-danger" onclick="notfeatureBookmark('{{$bookmark->id}}')">Unfeatured</button></a>
                            @endif
                        </td>                        
                         <td>
                            <form action="{{ action('BookmarksController@show', [$bookmark->id])}}" method="post">
                                @csrf
                                @method('GET')
                                <button class="btn btn-success" type="submit"><span class="fa fa-eye"></span></button>
                            </form>
                         </td>
                        <td>
                            <form action="{{ action('BookmarksController@destroy', [$bookmark->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                            </form>
                       </td>
                        
                       <td>
                            <a href="{{ action('BookmarksController@edit', [$bookmark->id])}}"><button class=" btn btn-success"><span class="fa fa-edit"></span></button></a>
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
    function deactivateBookmark(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/bookmark/deactivate') }}" + "/" + id,
        type: 'post',
        success: function(result)
        {
            toastr.error('Bookmark Deactivated');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}

function activateBookmark(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/bookmark/activate') }}" + "/" + id,
        type: 'POST',
        success: function(result)
        {
            toastr.success('Bookmark Activated');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}   
function notfeatureBookmark(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/bookmark/notfeature') }}" + "/" + id,
        type: 'post',
        success: function(result)
        {
            toastr.error('Bookmark Un Featured');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}

function featureBookmark(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/bookmark/feature') }}" + "/" + id,
        type: 'POST',
        success: function(result)
        {
          
            if(result == 'false') {
                toastr.error('Bookmark Cannot be featured!. You can only feature 8 Bookmarks at a time');
                window.setTimeout(function(){location.reload()},2000);
            }
            else {
                toastr.success('Bookmark Featured');
                window.setTimeout(function(){location.reload()},2000);
            }
           
        }
    });
}
   
   
</script>
@stop