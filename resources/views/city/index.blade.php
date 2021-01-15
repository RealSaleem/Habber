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
    <a href="{{ route('city.create') }}" ><button style="color: orange;font-size:16px;border: 3px solid orange" >  + Add New City</button> </a>
      <div class="table-responsive">
          <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Shipping Charges</th>
                        <th>Status</th>
                        <th> Action</th>   
                        <th> </th>   
                        <th></th>                  
                    </tr>
               </thead>
               <tbody>
               @foreach($city as $city)
           <tr>
            
            <td>{{$city->name}}</td>
            <td>{{$city->countries['name']}}</td>
            <td>{{$city->shipping_charges}}</td>  
            <td>{{$city->status == 1 ? 'Active' : 'Disabled'}}</td>  
            <td>
                    @if($city->status == 1)
                        <a><button class="btn btn-danger" onclick="deactivateCity('{{$city->id}}')">@lang('messages.user_page.deactivate')</button></a>
                    @else
                        <a>
                            <button class="btn btn-info" onclick="activateCity('{{$city->id}}')">
                            @lang('messages.user_page.activate')
                            </button>
                        </a>
                    @endif
            </td>
            <td>
                        <form action="{{ action('CityController@destroy', [$city->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                        </form>
                    </td>
                  <td>
                        <a href="{{ action('CityController@edit', [$city->id])}}"><button class=" btn btn-success"><span class="fa fa-edit"></span></button></a>
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