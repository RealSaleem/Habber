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
    <a href="{{ route('books.create') }}" ><button style="color: gray;font-size:16px;border: 3px solid black" >  + Add New Book</button> </a>
       <div class="table-responsive">
            <table id="zero_config2" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Product Isbn</th>
                        <th>Title</th>
                        <th>Arabic Title</th>
                        <th>Author Name</th>
                        <th> Type Of Paper</th>
                        <th>Description</th>
                        <th>Book langauge</th>
                        <th>Price</th>
                        <th>Total Page</th>
                        <th>Quantity</th>
                        <th>Added by</th>
                        <th>Book Clubs</th>
                        <th>Genres</th>
                        <th>Feature</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="not">Image </th>
                        <th class="not">Action</th>
                    </tr>
               </thead>
                <tbody>
                    @foreach($book as $book)
                        <tr>
                             <td>{{$book->isbn}}</td>
                            <td>{{$book->title}}</td>
                            <td>{{$book->arabic_title}}</td>
                            <td>{{$book->author_name}}</td>
                            <td>{{$book->cover_type}}</td>
                            <td>{{$book->description}}</td>  
                            <td>{{$book->book_language}}</td>  
                            <td>{{($book->product_prices[0])->price}}</td>
                            <td>{{$book->total_pages}}</td>  
                            <td>{{( $book->quantity == 0 ) ? "out of stock" : $book->quantity}}</td>
                            <td>{{$book->users['first_name']}}</td>  
                            <td>{{$book->book_clubs['name']}}</td>
                            @if(count($book->genres) > 1)
                                <td>
                                @foreach($book->genres as $g)
                                    @if($g->title != "General")
                                        {{$g->title}},
                                    @endif
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
                            <td class = "{{$book->featured == 1 ? 'text-primary' : 'text-danger'}}" >{{$book->featured == 1 ? "Featured" : " UnFeatured"}}</td>  
                            <td class = "{{$book->status == 1 ? 'text-primary' : 'text-danger'}}" >{{$book->status == 1 ? "Active" : "In Active"}}</td> 
                            <td> {{$book->created_at}}</td>
                            <td><img style=" width: 50px; height: 50px;" src=" {{ isset($book->image) ?  url('storage/'.$book->image) : url('storage/books/default.png') }}" alt=""> </td>
                            
                            <td>
                            <div class="dropdown">
                        <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
                      Actions
                  <span class="caret"></span>
                    </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            @if($book->status == 0)
                            <li role="presentation"> <a><button class="btn btn-light" onclick="activateBook('{{$book->id}}')">@lang('messages.user_page.activate')</button></a></li>
                            @else
                            <li role="presentation"> <a><button class="btn btn-light" onclick="deactivateBook('{{$book->id}}')">@lang('messages.user_page.deactivate')</button></a></li>
                            @endif  
                            <li role="presentation">
                            <form action="{{ action('BooksController@show', [$book->id])}}" method="post">
                                @csrf
                                @method('GET')
                                <button class="btn btn-light" type="submit">Details</button>
                            </form></li>
                            <li role="presentation">
                            <form action="{{ action('BooksController@destroy', [$book->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-light" type="submit">Delete</button>
                            </form></li>
                            <li role="presentation">
                            <a href="{{ action('BooksController@edit', [$book->id])}}"><button class=" btn btn-light">Edit</button></a></li>
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
        $('#zero_config2').DataTable({
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
    function deactivateBook(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/book/deactivate') }}" + "/" + id,
        type: 'post',
        success: function(result)
        {
            toastr.error('Book Deactivated');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}

function activateBook(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "{{ url('admin/book/activate') }}" + "/" + id,
        type: 'POST',
        success: function(result)
        {
            toastr.success('Book Activated');
            window.setTimeout(function(){location.reload()},2000);
        }
    });
}   
</script>
@stop