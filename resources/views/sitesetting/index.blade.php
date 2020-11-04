@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.site_setting_page.site_setting')</h1>
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
                <th>Email</th>
                <th>Currency</th>
                <th>Language</th>
                <th>Phone No</th>
                <th>WhatsApp No  </th>
                <th>Twitter</th>   
                <th>Facebook</th> 
                <th>Instagram</th>
                <th>Snapchat</th>    
                <th>Action</th>        
              </tr>
          </thead>
          <tbody>
            @foreach($sitesetting as $sitesetting)
              <tr>
                <td>{{$sitesetting->email}}</td>
                <td>{{$sitesetting->currencies['name']}}</td>
                <td>{{$sitesetting->languages['name']}}</td>
                <td>{{$sitesetting->phone_no}}</td>
                <td>{{$sitesetting->whatsaap_number}}</td>
                <td>{{$sitesetting->twitter_url}}</td>
                <td>{{$sitesetting->facebook_url}}</td>
                <td>{{$sitesetting->instagram_url}}</td>
                <td>{{$sitesetting->snapchat_url}}</td>
                <td>
                  <div class="row">
                 <!-- <div class="col-1">
                         <form action="{{ action('SiteSettingController@destroy', [$sitesetting->id])}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                          </form>
                      </div>-->
                      <div class="col-1">
                          <a href="{{ action('SiteSettingController@edit', [$sitesetting->id])}}"><button class=" btn btn-success"><span class="fa fa-edit"></span></button></a>
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
        // dom: 'Bfrtip',
        // buttons: [
            
        //     // 'csv', 'excel', 'pdf', 'print',
          
        //     {
        //         extend: 'pdf',           
        //         exportOptions: {
        //             columns: ':visible:not(.not)' // indexes of the columns that should be printed,
        //         }                      // Exclude indexes that you don't want to print.
        //     },
        //     {
        //         extend: 'csv',
        //         exportOptions: {
        //             columns: ':visible:not(.not)'
        //         }

        //     },
        //     {
        //         extend: 'excel',
        //         exportOptions: {
        //             columns: ':visible:not(.not)'
        //         }

        //     },
        //     {
        //         extend: 'print',
        //         exportOptions: {
        //             columns: ':visible:not(.not)'
        //         }
        //     }         
        // ],
        
    });
});   
</script>
@stop