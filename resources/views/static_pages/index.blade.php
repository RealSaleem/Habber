@extends('layouts.app')
@section('content')
    
<h1 class="page-title">@lang('messages.static_page.staticpage')
</h1>
<div class="ml-auto text-right">
</div> 
@if(Session::has('success'))
    <div class="alert alert-success text-center" role="alert">
        <strong>{{Session::get('success')}}</strong>
    </div>
@endif 
<div class="card">
    <div class="card-body">
    <a href="{{ route('static_pages.create') }}" ><button style="color: grey;font-size:16px;border: 3px solid black" >  + Add New Static</button> </a>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Arabic Title</th>
                        <th>Description</th>
                        <th>Arabic Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($static as $static_page)
                    <tr>    

                        <td>{{$static_page->title}}</td>
                        <td>{{$static_page->arabic_title}}</td>
                        <td>{{$static_page->description}}</td>  
                        <td>{{$static_page->arabic_description}}</td>
    
                        <td>
                        <div class="row">
                        <div class="col-2">
                                    <form action="{{ action('StaticPagesController@destroy', [$static_page->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                                    </form>
                                </div>
                                <div class="col-2">
                                    <form action="{{action('StaticPagesController@edit', [$static_page->url])}}" method="post">
                                    @csrf
                                    @method('get')
                                        <button class=" btn btn-success" type="submit">
                                        <span class="fa fa-edit"></span>
                                        </button>
                                    </form>
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