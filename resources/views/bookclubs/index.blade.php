@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.bookclub_page.bookclubs')</h1>
<div class="ml-auto text-right">
</div> 
@if(Session::has('sucess'))
    <div class="alert alert-success text-center" role="alert">
        <strong>{{Session::get('success')}}</strong>
    </div>
@endif 
<div class="card">
    <div class="card-body">
    <a href="{{ route('bookclubs.create') }}" ><button style="color: grey;font-size:16px;border: 3px solid black" >  + Add New BookClub</button> </a>
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
                    <td class = "{{$bookclub->featured == 1 ? 'text-primary' : 'text-danger'}}" >{{$bookclub->featured == 1 ? "Featured" : "UnFeatured"}}</td> 
                    <td class = "{{$bookclub->status == 1? 'text-primary' : 'text-danger'}}" >{{$bookclub->status == 1 ? "Active" : "In Active"}}</td>   
                    <th>{{$bookclub->created_at}}</th>
                    <td><img style=" width: 50px; height: 50px;" src=" {{ isset($bookclub->bookclub_logo) ?  url('storage/'.$bookclub->bookclub_logo) : url('storage/bookclub/default.png') }}" alt=""> </td>
                    <td>

                    <div class="dropdown">
                <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
              Actions
             <span class="caret"></span>
                </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            @if($bookclub->status == 0)
                                 <li role="presentation"> <a><button class="btn btn-light" onclick="activateBookClub('{{$bookclub->id}}')">@lang('messages.user_page.activate')</button></a></li>
                            @else
                            <li role="presentation">  <a><button class="btn btn-light" onclick="deactivateBookClub('{{$bookclub->id}}')">@lang('messages.user_page.deactivate')</button></a></li>
                            @endif
                            @if($bookclub->featured == 0)
                            <li role="presentation">   <a><button class="btn btn-light" onclick="featureBookClub('{{$bookclub->id}}')">@lang('messages.book_page.feature')</button></a></li>
                            @else
                            <li role="presentation">    <a><button class="btn btn-light" onclick="notfeatureBookClub('{{$bookclub->id}}')">@lang('messages.bookmark_page.not_feature')</button></a></li>
                            @endif
                                <li role="presentation">  <form action="{{ action('BookClubController@destroy', [$bookclub->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-light" type="submit">Delete</button></li>
                            </form>
                                 <li role="presentation">   <a href="{{ action('BookClubController@edit', [$bookclub->id])}}"><button class=" btn btn-light">Edit</button></a></li>
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