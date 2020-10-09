@extends('layouts.app')
@section('content')
<h1 class="page-title">Business</h1>
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
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Business Type</th>
                        <th>Product Type</th>
                        <th>Details</th>
                        <th> Action</th>                  
                          </tr>
               </thead>
               <tbody>
               @foreach($business as $business)
        <tr>
            
            <td>{{$business->user_id}}</td>
            <td>{{$business->name}}</td>
            <td>{{$business->business_type}}</td>
            <td>{{$business->product_type}}</td>  
            <td>{{$business->details}}</td>  
             <td>
             <form action="{{ action('BusinessController@destroy', [$business->id])}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </td>
        </tr>
        @endforeach            
    </tbody>
  </table>
<div>
@endsection