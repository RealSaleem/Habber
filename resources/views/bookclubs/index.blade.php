@extends('layouts.app')
@section('content')
<h1 class="page-title">@lang('messages.bookclub_page.bookclubs')</h1>
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
                        <th>Name</th>
                        <th>Image</th>
                        <th> Action</th>                  
                          </tr>
               </thead>
               <tbody>
                    @foreach($bookclub as $bookclub)
                <tr>
                    <td>{{$bookclub->name}}</td>
                    <td><img style=" width: 50px; height: 50px;" src=" {{ isset($bookclub->banner_image) ?  url('storage/'.$bookclub->banner_image) : url('storage/bookclub/default.png') }}" alt=""> </td>
                    <td>
                        <div class="row">
                            <div class="col-1">
                                <form action="{{ action('BookClubController@destroy', [$bookclub->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                                </form>
                            </div>
                            <div class="col-1">
                                <a href="{{ action('BookClubController@edit', [$bookclub->id])}}"><button class=" btn btn-success"><span class="fa fa-edit"></span></button></a>
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
     });
    })
</script>
@stop