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
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped table-bordered">
          <thead>
              <tr>
                <th>Title</th>
                <th> Action</th>                  
              </tr>
          </thead>
          <tbody>
            @foreach($genre as $genre)
              <tr>
                <td>{{$genre->title}}</td>
                <td>
                  <div class="row">
                      <div class="col-1">
                          <form action="{{ action('GenreController@destroy', [$genre->id])}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                          </form>
                      </div>
                      <div class="col-1">
                          <a href="{{ action('GenreController@edit', [$genre->id])}}"><button class=" btn btn-success"><span class="fa fa-edit"></span></button></a>
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
        var table = $('#zero_config').DataTable({
    "lengthMenu": [[50, 100, 1000, -1], [50, 100, 1000, "All"]],
    "initComplete": function(){ 
      $("#zero_config").show(); 
    },
    buttons: ['copy', 'csv', 'pdf', 'print' ]
  });
  table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
});   
</script>
@stop