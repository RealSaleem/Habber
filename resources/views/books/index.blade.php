@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.book_page.books')</h1>
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
                        <th>Author Name</th>
                        <th>Cover Type</th>
                        <th>Description</th>
                        <th>Book langauge</th>
                        <th>Price</th>
                        <th>Isbn</th>
                        <th>Total Page</th>
                        <th>Quantity</th>
                        <th>Publisher Name</th>
                        <th>Book Clubs</th>
                        <th>Genres</th>
                        <th>Feature</th>
                        <th class="not">Image </th>
                        <th class="not">Action</th>
                    </tr>

               </thead>
               <tbody>
               @foreach($book as $key => $book)
         <tr>
            <td>{{$book->title}}</td>
            <td>{{$book->author_name}}</td>
            <td>{{$book->cover_type}}</td>
            <td>{{$book->description}}</td>  
            <td>{{$book->book_language}}</td>  
            <td>{{$book->price}}</td>
            <td>{{$book->isbn}}</td>
            <td>{{$book->total_pages}}</td>  
            <td>{{$book->quantity}}</td>
            <td>{{$book->users['first_name']}}</td>  
            <td>{{$book->book_clubs['name']}}</td>
            {{count($book->genres)}}
            @if(count($book->genres) > 1)
                <td>
                @foreach($book->genres as $g)
                    {{$g->title}},
                @endforeach
                </td>
            @elseif( count($book->genres) < 2 && count($book->genres) > 0)
                <td>
                    {{$book->genres[0]->title}}
                </td>
            @else
                <td>
                    No Genres
                </td>
            @endif
            <td class = "{{$book->featured == 1 ? 'text-primary' : 'text-sucees'}}" >{{$book->featured == 1 ? "featured" : "not featured"}}</td>  
            <td><img style=" width: 50px; height: 50px;" src=" {{ isset($book->image) ?  url('storage/'.$book->image) : url('storage/books/default.png') }}" alt=""> </td>
            <td>
                <div class="row">
                    <div class="col-2">
                        <form action="{{ action('BooksController@destroy', [$book->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                        </form>
                    </div>
                    <div class="col-2">
                        <a href="{{ action('BooksController@edit', [$book->id])}}"><button class=" btn btn-success"><span class="fa fa-edit"></span></button></a>
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