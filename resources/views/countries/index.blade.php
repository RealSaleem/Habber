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
                        <th>Status</th>
                        <th> Action</th>      
                        <th> </th>      
                        <th> </th>                  
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
            <td>{{$country->status == 1 ? 'Active' : 'Disabled'}}</td>  
            <td>
                        @if($country->status == 1)
                                        <a><button class="btn btn-danger" onclick="deactivateCountry('{{$country->id}}')">@lang('messages.bookmark_page.deactivate')</button></a>
                                    @else
                                        <a><button class="btn btn-info" onclick="activateCountry('{{$country->id}}')">@lang('messages.bookmark_page.activate') </button></a>
                                    @endif
                        </td>
            <td>
                                    <a href="{{action('CountryController@edit', [$country->id])}}"><button class=" btn btn-success"><span class="fa fa-edit"></span></button></a>
                                </td>
                                <td>
                                    <form action="{{action('CountryController@destroy', [$country->id])}}" method="post">
                                    @csrf
                                    @method('Delete')
                                        <button class=" btn btn-danger" type="submit">
                                        <span class="fa fa-trash"></span>
                                        </button>
                                    </form>
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