@extends('layouts.app')
@section('content')
<h1 class="page-title"> @lang('messages.address_page.address')</h1>
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
    <a href="{{ route('address.create') }}" ><button style="color: grey;font-size:16px;border: 3px solid black" >  + Add New Address</button> </a>
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
                        <th>Shipping Charges</th>
                        <th class="not">Action</th>  
                                     
                    </tr>
               </thead>
            <tbody>
                @foreach($address as $address)
                <tr>
                    <td>{{$address->address_name}}</td>
                    <td>{{$address->address_line1}}</td>
                    <td>{{$address->address_line2}}</td>
                    <td>{{$address->state}}</td>
                    <td>{{($address->cities['name'])}}</td>  
                    <td>{{($address->countries['name'])}}</td>
                    <td>{{$address->post_code}}</td>
                    <td>{{$address->phone}}</td>
                    <td>{{($address->users['first_name'] ." ". $address->users['last_name'])}}</td>
                    <td>{{($address->countries['shipping_charges'])}}</td>
                    <td>
                    <div class="dropdown">
            <button class="btn btn-flat btn-info dropdown-toggle" type="button" id="dropdownMenu1" name="action" data-toggle="dropdown">
             Actions
             <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                <li role="presentation"> <form action="{{ action('AddressController@destroy', [$address->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-light" type="submit">Delete</button>
                                </form></li>
                                <li role="presentation"><form action="{{ action('AddressController@edit', [$address->id])}}" method="post">
                                    @csrf
                                    @method('get')
                                    <input type="hidden" name="fromUser" value="{{$fromUser->id ?? null}}">
                                    <button class="btn btn-light" type="submit">Edit</button>
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
<!-- <script src="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"></script> -->
<!-- <script src="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"> </script> -->
<script>

    $(document).ready(function() {
        $('#zero_config').DataTable({
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
</script>
@stop