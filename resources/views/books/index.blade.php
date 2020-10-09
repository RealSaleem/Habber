@extends('layouts.app')
@section('content')
<h1 class="page-title">Books</h1>
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
                        <th>Author-Name</th>
                        <th>Cover-Type</th>
                        <th>Description</th>
                        <th>Book-langauge</th>
                        <th>Price</th>
                        <th>Isbn</th>
                        <th>Total-Page</th>
                        <th>Quantity</th>
                        <th>Bunisess Id</th>
                        <th>Image Url</th>
                    </tr>
               </thead>
               <tbody>
               @foreach($book as $book)
        <tr>
            
            <td>{{$book->title}}</td>
            <td>{{$book->author_name}}</td>
            <td>{{$book->cover_type}}</td>
            <td>{{$book->description}}</td>  
            <td>{{$book->book_language}}</td>  
            <td>{{$book->price}}</td>
            <td>{{$book->isbn}}</td>
            <td>{{$book->total_pages}}</td>  
            <td>{{$book->quantiy}}</td>
            <td>{{$book->business_id}}</td>
            <td>{{$book->image_url}}</td>   
            <td>
                
        </tr>
        @endforeach            
    </tbody>
  </table>
<div>
@endsection