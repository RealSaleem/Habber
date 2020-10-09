@extends('layouts.app')
@section('content')
<h1 class="page-title">Genre</h1>
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
                        <th>Title</th>
                        <th> Action</th>                  
                          </tr>
               </thead>
               <tbody>
               @foreach($genre as $genre)
        <tr>
            
            <td>{{$genre->title}}</td>
             <td>
             <form action="{{ action('GenreController@destroy', [$genre->id])}}" method="post">
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