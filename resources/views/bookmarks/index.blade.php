
@extends('layouts.app')
@section('content')
<h1 class="page-title">Bookmarks</h1>
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
                        <th>Maker Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Bookmark ID</th>
                        <th>Size</th>         
                        <th>Quantity </th>
                        <th>Business ID</th>
                        <th>Image</th>
                        <th> Action</th>  
                                     
                    </tr>
               </thead>
               <tbody>
               @foreach($bookmark as $bookmark)
        <tr>
            
            <td>{{$bookmark->title}}</td>
            <td>{{$bookmark->maker_name}}</td>
            <td>{{$bookmark->description}}</td>
            <td>{{$bookmark->price}}</td>  
            <td>{{$bookmark->bookmark_id}}</td>
            <td>{{$bookmark->size}}</td>
            <td>{{$bookmark->quantity}}</td>
            <td>{{$bookmark->business_id}}</td>  
            <td><img style=" width: 50px; height: 50px;" src=" {{ isset($bookmark->image_url) ?  url('storage/'.$bookmark->image_url) : url('storage/bookmarks/default.png') }}" alt=""> </td>
             <td>
             <form action="{{ action('BookmarksController@destroy', [$bookmark->id])}}" method="post">
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