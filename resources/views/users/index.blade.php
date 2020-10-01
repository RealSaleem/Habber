@extends('layouts.app')
@section('content')
    
<h1 class="page-title">Users</h1>
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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
               </thead>
               <tbody>
              @foreach($user as $user)
        <tr>
            
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>  
             <td><img style=" width: 50px; height: 50px;" src="{{ url('storage/'.$user->profile_pic)}}" alt="no-image"> </td>
            
            <td>
                <form action="{{ action('UserController@destroy', [$user->id])}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection
