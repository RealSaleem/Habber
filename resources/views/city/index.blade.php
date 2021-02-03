@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.city_page.city')</h1>
<div class="ml-auto text-right">
</div> 
@if(Session::has('success'))
    <div class="alert alert-success text-center" role="alert">
        <strong>{{Session::get('success')}}</strong>
    </div>
@endif 
<div class="card">
    <div class="card-body">
    <a href="{{ route('city.create') }}" ><button style="color: grey;font-size:16px;border: 3px solid black" >  + Add New State</button> </a>
      <div class="table-responsive">
          <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th> Action</th>                
                    </tr>
               </thead>
               <tbody>
               @foreach($city as $city)
           <tr>
            
            <td>{{$city->name}}</td>
            <td>{{$city->countries['name']}}</td>
            <td>{{$city->status == 1 ? 'Active' : 'Disabled'}}</td>  
            <td>
            <div class="dropdown">
            <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
         Actions
             <span class="caret"></span>
            </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                    @if($city->status == 1)
                    <li role="presentation">    <a><button class="btn btn-light" onclick="deactivateCity('{{$city->id}}')">@lang('messages.user_page.deactivate')</button></a></li>
                    @else
                    <li role="presentation">   <a>
                            <button class="btn btn-light" onclick="activateCity('{{$city->id}}')">
                            @lang('messages.user_page.activate')
                            </button>
                        </a></li>
                    @endif
                    <li role="presentation"><form action="{{ action('CityController@destroy', [$city->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-light" type="submit">Delete</button>
                        </form></li>
                
                  <li role="presentation"> <a href="{{ action('CityController@edit', [$city->id])}}"><button class=" btn btn-light">Edit</button></a></li>
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

    function deactivateCity(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/city/deactivate') }}" + "/" + id,
        type: 'post',
        success: function(result)
        {
            toastr.error('City Deactivated');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}

function activateCity(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/city/activate') }}" + "/" + id,
        type: 'POST',
        success: function(result)
        {
            toastr.success('City Activated');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}
</script>
@stop