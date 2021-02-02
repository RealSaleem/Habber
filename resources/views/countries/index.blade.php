@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.country_page.countries')</h1>
<div class="ml-auto text-right">
</div> 
@if(Session::has('success'))
    <div class="alert alert-success text-center" role="alert">
        <strong>{{Session::get('success')}}</strong>
    </div>
@endif 
<div class="card">
    <div class="card-body">
    <a href="{{ route('countries.create') }}" ><button style="color: grey;font-size:16px;border: 3px solid black" >  + Add New Country</button> </a>
      <div class="table-responsive">
          <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Iso</th>
                        <th>Name</th>
                        <th>Nice Name</th>
                        <th>Iso3</th>
                        <th>Numcode</th>
                        <th>Phonecode</th>
                        <th>Shipping Charges</th>
                        <th>Status</th>
                        <th> Action</th>      
                               
                    </tr>
               </thead>
               <tbody>
               @foreach($country as $country)
           <tr>
            
            <td>{{$country->iso}}</td>
            <td>{{$country->name}}</td>
            <td>{{$country->nicename}}</td>
            <td>{{$country->iso3}}</td>  
            <td>{{$country->numcode}}</td>
            <td>{{$country->phonecode}}</td>
            <td>{{$country->shipping_charges}}</td>
            <td>{{$country->status == 1 ? 'Active' : 'Disabled'}}</td>  
            <td>
            <div class="dropdown">
        <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
         Actions
              <span class="caret"></span>
            </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        @if($country->status == 1)
                                      <li role="presentation">   <a><button class="btn btn-light" onclick="deactivateCountry('{{$country->id}}')">@lang('messages.bookmark_page.deactivate')</button></a></li>
                                    @else
                                    <li role="presentation"> <a><button class="btn btn-light" onclick="activateCountry('{{$country->id}}')">@lang('messages.bookmark_page.activate') </button></a></li>
                                    @endif
                    
                                    <li role="presentation">  <a href="{{action('CountryController@edit', [$country->id])}}"><button class=" btn btn-light">Edit</button></a></li>
                               
                                    <li role="presentation"> <form action="{{action('CountryController@destroy', [$country->id])}}" method="post">
                                    @csrf
                                    @method('Delete')
                                        <button class=" btn btn-light" type="submit">
                                     Delete
                                        </button>
                                    </form></li>
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
    function deactivateCountry($id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/country/deactivate') }}" + "/" +$id,
        type: 'post',
        success: function(result)
        {
            toastr.error('Country Deactivated');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}


function activateCountry($id) {
  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/country/activate') }}" + "/" + $id,
        type: 'POST',
        success: function(result)
        {
            toastr.success('Country Activated');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}
    

</script>
@stop