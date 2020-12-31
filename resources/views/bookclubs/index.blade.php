@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.bookclub_page.bookclubs')</h1>
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
                        <th>Name</th>
                        <th>Arabic Name</th>
                        <th>Book</th>
                        <th>Feature</th>
                        <th>Status</th>
                        <th>Addition Date</th>
                        <th class="not">Banner Image </th>
                        <th class="not">Square Banner</th>
                        <th class="not">BookClub Logo</th>
                        <th class="not"> Action</th>                  
                          </tr>
               </thead>
               <tbody>
                    @foreach($bookclub as $bookclub)
                <tr>
                    <td>{{$bookclub->name}}</td>
                    <td>{{$bookclub->arabic_name}}</td>
                    <td>{{$bookclub->books['title']}}</td> 
                    <td class = "{{$bookclub->featured == 0 ? 'text-primary' : 'text-sucees'}}" >{{$bookclub->featured == 0 ? "featured" : "not featured"}}</td> 
                    <td class = "{{$bookclub->status == 0 ? 'text-primary' : 'text-sucees'}}" >{{$bookclub->status == 0 ? "active" : "not active"}}</td>   
                    <th>{{$bookclub->created_at}}</th>
                    <td><img style=" width: 50px; height: 50px;" src=" {{ isset($bookclub->banner_image) ?  url('storage/'.$bookclub->banner_image) : url('storage/bookclub/default.png') }}" alt=""> </td>
                    <td><img style=" width: 50px; height: 50px;" src=" {{ isset($bookclub->square_banner) ?  url('storage/'.$bookclub->square_banner) : url('storage/bookclub/default.png') }}" alt=""> </td>
                    <td><img style=" width: 50px; height: 50px;" src=" {{ isset($bookclub->bookclub_logo) ?  url('storage/'.$bookclub->bookclub_logo) : url('storage/bookclub/default.png') }}" alt=""> </td>
                  
                    <td>
                        <div class="row">
                            <div class="col-1">
                                <form action="{{ action('BookClubController@destroy', [$bookclub->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                            </form>
                            </div>
                            <div class="col-1">
                                <a href="{{ action('BookClubController@edit', [$bookclub->id])}}"><button class=" btn btn-success"><span class="fa fa-edit"></span></button></a>
                        </div>
                        <div class="col-2">
                            @if($bookclub->status == 0)
                                <a><button class="btn btn-info" onclick="activateBookClub('{{$bookclub->id}}')">@lang('messages.user_page.activate')</button></a>
                            @else
                                <a><button class="btn btn-danger" onclick="deactivateBookClub('{{$bookclub->id}}')">@lang('messages.user_page.deactivate')</button></a>
                            @endif
                        </div>
                        <div class="col-2">
                            @if($bookclub->featured == 0)
                                <a><button class="btn btn-primary" onclick="featureBookClub('{{$bookclub->id}}')">@lang('messages.book_page.feature')</button></a>
                            @else
                                <a><button class="btn btn-danger" onclick="notfeatureBookClub('{{$bookclub->id}}')">@lang('messages.bookmark_page.not_feature')</button></a>
                            @endif
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
    })
    function deactivateBookClub(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/bookclub/deactivate') }}" + "/" + id,
        type: 'post',
        success: function(result)
        {
            toastr.error('BookClub Deactivate');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}

function activateBookClub(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/bookclub/activate') }}" + "/" + id,
        type: 'POST',
        success: function(result)
        {
            toastr.success('BookClub Activate');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}
function notfeatureBookClub(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/bookclub/notfeature') }}" + "/" + id,
        type: 'post',
        success: function(result)
        {
            toastr.error('BookClub Un Featured');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}

function featureBookClub(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/bookclub/feature') }}" + "/" + id,
        type: 'POST',
        success: function(result)
        {
            toastr.success('BookClub Un Featured');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}
  
   
</script>
@stop