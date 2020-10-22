@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.favourite_page.favourites')</h1>

<div class="ml-auto text-right mb-4">
    <a href="{{ action('UserController@index')}}"><button class=" btn btn-success">  Back</button></a>
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
                <th>User</th>
                <th>Books</th>
                <th>Bookmarks</th>
                <th class="not"> Action</th>                  
              </tr>
          </thead>
          <tbody>
            @foreach($favourites as $favourites)
              <tr>
                <td>{{$favourites->users['first_name']}}</td>
                <td>{{count($favourites->books) ? $favourites->books[0]->title : "No Book"}}</td>
                <td>{{count($favourites->bookmarks) ? $favourites->bookmarks[0]->title : "No Bookmark"}}</td>
                <td>
                  <div class="row">
                      <div class="col-2">
                          <form action="{{ action('FavouriteController@destroy', [$favourites->id])}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                          </form>
                      </div>
                      <div class="col-2">
                          <a href="{{ action('FavouriteController@show', [$favourites->id])}}"><button class=" btn btn-success"><span class="fa fa-eye"></span></button></a>
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
});   
</script>
@stop