@extends('layouts.app')
@section('content')
<h1 class="page-title"> {{isset($fromUser) ? ucfirst($fromUser->first_name)."'s" . ' Address' : 'Address'}}</h1>
@if(isset($fromUser))
<div class="ml-auto text-right mb-4">
    <a href="{{ action('AddressController@createUserAddress', [$fromUser->id])}}"><button class=" btn btn-info"> <span class="fa fa-plus"> Create</span></button></a>
</div> 
@endif

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
                        <th>Address Name</th>
                        <th>Address Line1</th>
                        <th>Address Line2</th>
                        <th>City</th>
                        <th>State </th>
                        <th>Country</th>
                        <th>Post Code </th>         
                        <th>Phone </th>
                        <th>User</th>
                        <th>Action</th>  
                                     
                    </tr>
               </thead>
            <tbody>
                @foreach($address as $address)
                <tr>
                    <td>{{$address->address_name}}</td>
                    <td>{{$address->address_line1}}</td>
                    <td>{{$address->address_line2}}</td>
                    <td>{{$address->city}}</td>  
                    <td>{{$address->state}}</td>
                    <td>{{$address->country_id}}</td>
                    <td>{{$address->post_code}}</td>
                    <td>{{$address->phone}}</td>
                    <td>{{ucfirst($address->users->first_name ." ". $address->users->last_name)}}</td>
                    <td>
                        <div class="row">
                            <div class="col-4">
                                <form action="{{ action('AddressController@destroy', [$address->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"><span class="fa fa-trash"></span></button>
                                </form>
                            </div>
                            <div class="col-2">
                                <form action="{{ action('AddressController@edit', [$address->id])}}" method="post">
                                    @csrf
                                    @method('get')
                                    <input type="hidden" name="fromUser" value="{{$fromUser->id ?? null}}">
                                    <button class="btn btn-success" type="submit"><span class="fa fa-edit"></span></button>
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
     });
    })
</script>
@stop