@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.language_page.languages')</h1>
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
                <th>iso</th>
                <th>Status</th>
                <th class="not"> Action</th>                  
              </tr>
          </thead>
          <tbody>
            @foreach($language as $language)
              <tr>
                <td>{{$language->name}}</td>
                <td>{{$language->iso}}</td>
                <td>{{($language->status == 1) ? true : false}}</td>
                <td>
                <div class="dropdown">
                <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
                  Actions
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation">  <form action="{{ action('LanguageController@destroy', [$language->id])}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-light" type="submit">Delete</button>
                          </form></li>
                     
                          <li role="presentation">  <a href="{{ action('LanguageController@edit', [$language->id])}}"><button class=" btn btn-light">Edit</button></a></li>
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