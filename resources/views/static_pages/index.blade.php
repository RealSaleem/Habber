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
                        <div class="dropdown">
            <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
             Actions
             <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                    <li role="presentation">  <form action="{{action('StaticPagesController@edit', [$static_page->url])}}" method="post">
                                    @csrf
                                    @method('get')
                                        <button class=" btn btn-light" type="submit">
                                      Edit
                                        </button>
                                    </form></li>
                                </ul>
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