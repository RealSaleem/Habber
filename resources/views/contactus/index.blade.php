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
                        <th>Whatsapp Number</th>
                        <th>Phone</th>
                        <th>Message</th>
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
            <td>{{$contact->phone}}</td>  
            <td>{{$contact->message}}</td>
            <td>
                <div class="row">
                    <div class="col-2">
                        <form action="{{ action('ContactController@show', [$contact->id])}}" method="post">
                        @csrf
                            @method('GET')
                            <button class="btn btn-success" type="submit"><span class="fa fa-eye"></span></button>
                        </form>
                    </div>
                    <div class="col-2">
                        <form action="{{ action('ContactController@destroy', [$contact->id])}}" method="post">
                        @csrf
                        @method('Delete')
                            <button class=" btn btn-danger" type="submit">
                            <span class="fa fa-trash"></span>
                            </button>
                        </form>
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

    })
</script>
@stop