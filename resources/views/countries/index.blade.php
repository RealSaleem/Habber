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
            <td class = "{{$country->status == 1? 'text-primary' : 'text-danger'}}" >{{$country->status == 1 ? "Enable" : "Disable"}}</td> 
            <td>
            <div class="row">
                                <div class="col-2">
                                    <a href="{{action('CountryController@edit', [$country->id])}}"><button class=" btn btn-success"><span class="fa fa-edit"></span></button></a>
                                </div>
                                <div class="col-2">
                                    <form action="{{action('CountryController@destroy', [$country->id])}}" method="post">
                                    @csrf
                                    @method('Delete')
                                        <button class=" btn btn-danger" type="submit">
                                        <span class="fa fa-trash"></span>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-2">
                                    @if($country->status == 1)
                                        <a><button class="btn btn-danger" onclick="disableCountry('{{$country->id}}')">@lang('messages.banner_page.disable')</button></a>
                                    @else
                                        <a><button class="btn btn-info" onclick="enableCountry('{{$country->id}}')">@lang('messages.banner_page.enable') </button></a>
                                    @endif
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
    function disableCountry($id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/country/disable') }}" + "/" +$id,
        type: 'post',
        success: function(result)
        {
            toastr.error('Country Disable');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}


function enableCountry($id) {
  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/country/enable') }}" + "/" + $id,
        type: 'POST',
        success: function(result)
        {
            toastr.success('Country Enabled');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}
    

</script>
@stop