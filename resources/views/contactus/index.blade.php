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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th> Action</th>                  
                          </tr>
               </thead>
               <tbody>
               @foreach($contact as $contact)
           <tr>
          <td>{{$contact->name}}</td>
            <td>{{$contact->email}}</td>
            <td>{{$contact->phone}}</td>  
            <td>{{$contact->message}}</td>
            <td>
             <form action="{{ action('ContactController@show', [$contact->id])}}" method="post">
             @csrf
                  @method('GET')
                  <button class="btn btn-success" type="submit">View</button>
                  </form>
                  <form action="{{ action('ContactController@destroy', [$contact->id])}}" method="post">
                  @csrf
                  @method('Delete')
                  <button class=" btn btn-danger"type="submit">
                    Delete
                </button></form>
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
       
     });

    })
</script>
@stop