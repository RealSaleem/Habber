@extends('layouts.app')
@section('content')
<h1 class="page-title">Addresses</h1>
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
                        <th>Address Name</th>
                        <th>Address Line1</th>
                        <th>Address Line2</th>
                        <th>City</th>
                        <th>State </th>
                        <th>Country</th>
                        <th>Post Code </th>         
                        <th>Phone </th>
                        <th>User</th>
                        <th> Action</th>  
                                     
                    </tr>
               </thead>
               <tbody>
               @foreach($address as $address)
        <tr>
            
            <td>{{$address->address_name}}</td>
            <td>{{$address->address_line1}}</td>
            <td>{{$address->address_line2}}</td>
            <td>{{$address->city}}</td>  
            <td>{{$address->state}}</td>
            <td>{{$address->country_id}}</td>
            <td>{{$address->post_code}}</td>
            <td>{{$address->phone}}</td>
            <td>{{$address->user_id}}</td>
            <td>
                <form action="{{ action('AddressessController@destroy', [$address->id])}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                    <a href="{{ action('AddressessController@edit', [$address->id])}}"><button class=" btn btn-success">
                    <span class="fa fa-edit"></span>
                    Edit
                </button></a>                      
            </td>           
        </tr>
        @endforeach      
    </tbody>
  </table>
<div>
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