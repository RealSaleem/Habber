@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.contactus_page.contactus')</h1>
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
                        <th>Submission ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th class="not">Action</th>                  
                    </tr>
               </thead>
               <tbody>
               @foreach($contact as $contact)
        <tr>
            <td>{{$contact->id}}</td>
          <td>{{$contact->name}}</td>
            <td>{{$contact->email}}</td>
            <td>{{$contact->phone}}</td>  
            <td>{{$contact->message}}</td>
            <td>{{$contact->status == 1 ? "Seen" : "Pending"}}</td>  
            <td>
            <div class="dropdown">
            <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
             Actions
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
        <li role="presentation"> <form action="{{ action('ContactController@show', [$contact->id])}}" method="post">
                        @csrf
                            @method('GET')
                            <button class="btn btn-light" type="submit">Details</span></button>
                        </form></li>
                        <li role="presentation">  <form action="{{ action('ContactController@destroy', [$contact->id])}}" method="post">
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
    $(document).ready(function() {
        $('#zero_config').DataTable({
        paging: true,
        dom: 'Bfrtip',
        buttons: [
            
            // 'csv', 'excel', 'pdf', 'print',
          
            {
                extend: 'pdf',      
                orientation: 'landscape',   
                pageSize: 'LEGAL',       
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

    })
</script>
@stop