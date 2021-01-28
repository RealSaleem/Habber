@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.genre_page.genres')</h1>
<div class="ml-auto text-right">
</div> 
@if(Session::has('success'))
    <div class="alert alert-success text-center" role="alert">
        <strong>{{Session::get('success')}}</strong>
    </div>
@endif 
<div class="card">
  <div class="card-body">
  <a href="{{ route('genres.create') }}" ><button style="color: grey;font-size:16px;border: 3px solid black" >  + Add New Genre</button> </a>
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped table-bordered">
          <thead>
              <tr>
                <th>Title</th>
                <th>Arabic Title</th>
                <th class="not"> Action</th>                  
              </tr>
          </thead>
          <tbody>
            @foreach($genre as $genre)
              <tr>
                <td>{{$genre->title}}</td>
                <td>{{$genre->arabic_title}}</td>
                <td>
                <div class="dropdown">
<button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
  Actions
    <span class="caret"></span>
</button>
<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
  <li role="presentation"> <form action="{{ action('GenreController@destroy', [$genre->id])}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-light" type="submit">Delete</button>
                          </form></li>
  <li role="presentation"> <a href="{{ action('GenreController@edit', [$genre->id])}}"><button class=" btn btn-light">Edit</button></a></li>
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
});   
</script>
@stop