
@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.bookmark_page.bookmarks')</h1>
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
                        <th>Arabic Title</th>
                        <th>Maker Name</th>
                        <th>Arabic Maker Name</th>
                        <th>Description</th>
                        <th>Arabic Description</th>
                        <th>Price</th>
                        <th>Bookmark </th>
                        <th>Size</th>         
                        <th>Quantity </th>
                        <th>Publisher Name</th>
                        <th>Feature</th>
                        <th class="not">Image</th>
                        <th class="not"> Action</th>  
                                     
                    </tr>
               </thead>
               <tbody>
               @foreach($bookmark as $bookmark)
            <tr>
                <td>{{$bookmark->title}}</td>
                <td>{{$bookmark->arabic_title}}</td>
                <td>{{$bookmark->maker_name}}</td>
                <td>{{$bookmark->arabic_maker_name}}</td>
                <td>{{$bookmark->description}}</td>
                <td>{{$bookmark->arabic_description}}</td>
                <td>{{$bookmark->price}}</td>  
                <td>{{$bookmark->bookmark_id}}</td>
                <td>{{$bookmark->size}}</td>
                <td>{{$bookmark->quantity}}</td>
                <td>{{$bookmark->users['first_name']}}</td>  
                <td class = "{{$bookmark->featured == 1 ? 'text-primary' : 'text-danger'}}" >{{$bookmark->featured == 1 ? "featured" : "not featured"}}</td>  
                <td><img style=" width: 50px; height: 50px;" src=" {{ isset($bookmark->image) ?  url('storage/'.$bookmark->image) : url('storage/bookmarks/default.png') }}" alt=""> </td>
                <td>
                    <div class="row">
                        <div class="col-2">
                            <form action="{{ action('BookmarksController@destroy', [$bookmark->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                            </form>
                        </div>
                        <div class="col-2">
                            <a href="{{ action('BookmarksController@edit', [$bookmark->id])}}"><button class=" btn btn-success"><span class="fa fa-edit"></span></button></a>
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