@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.address_page.add_new_address')</h2>
        </div>
    </div>
       <div class="container-fluid">
            @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Address Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
            @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{ action('AddressController@store')}}" method="post"  enctype="multipart/form-data">   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.address_page.add_address_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.address_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address_name"  value="{{ old('address_name') }}" id="address_name"  placeholder="Address Name">
                            <span class="text-danger">{{$errors->first('address_name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.address_line1')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address_line1"  value="{{ old('address_line1') }}" id="address_line1"  placeholder="Address Line1">
                            <span class="text-danger">{{$errors->first('address_line1')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.address_line2')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address_line2"  value="{{ old('address_line2') }}" id="address_line1"  placeholder="Address Line2">
                            <span class="text-danger">{{$errors->first('address_line2')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.country')</label>
                        <div class="col-sm-9">
                            <select  class="form-control" name="country_id" id="country_id">
                            <option value="" disabled selected> select country</option>
                                @foreach($country as $c )
                                <option value="{{$c->id}}" > {{$c->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{$errors->first('country')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.state')</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="city" id="city_id" >
                        </select>
                            <span class="text-danger">{{$errors->first('city')}}</span>
                        </div>
                    </div>
                
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.city')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="state"  value="{{ old('state') }}" id="state"  placeholder="City">
                            <span class="text-danger">{{$errors->first('state')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.post_code')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="post_code"  value="{{ old('post_code') }}" id="post_code"  placeholder="Post Code">
                            <span class="text-danger">{{$errors->first('post_code')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.phone')</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="phone"  value="{{ old('phone') }}" id="phone"  placeholder="Phone">
                            <span class="text-danger">{{$errors->first('phone')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.address_page.user')</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="user_id" id="user_id">
                                @foreach($user as $u )
                                <option value="{{$u->id}}" > {{$u->first_name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{$errors->first('user_id')}}</span>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                           <a href="{{ isset($fromUser) ? route('user_address',[$fromUser]) : route('address.index')}}">
                           <button type="button" class=" btn btn-danger">
                           @lang('messages.button.back')
                            </button></a>
                            <button type="submit" class="btn btn-primary">@lang('messages.button.submit')</button>
                         </div>

                    </div>
                </div>   
            </form>  
        </div>
    </div>
</div>
                  
@endsection

@section('scripts')
<!-- <script src="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"></script> -->
<!-- <script src="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"> </script> -->
<script>

    $(document).ready(function() {
       $('#country_id').change(function (){
        var country_id = $("#country_id option").filter(":selected").val()
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('admin/country/city') }}" + "/" + country_id,
                type: 'GET',
                success: function(result)
                {
                    if(result == "null" || result.length == 0 ) {
                        // window.setTimeout(function(){location.reload()},2000)
                        toastr.error('Please Select Another Country Currently we do not provide delivery service to this Country');
                        $('#city_id')
                                .find('option')
                                .remove()
                                .end()
                                .append('<option value= disabled>No Citites</option>');
                           
                        // $('#city_id')
                    }
                    else {
                        console.log(result.length);
                        $.each(result, function(key, value) {

                            $('#city_id')
                                .find('option')
                                .remove()
                                .end()
                                .append($('<option>', { value : value.id })
                                .text(value.name));     
                        });
                    }
                  
                   
                    // window.setTimeout(function(){location.reload()},2000);
                }
            });
       })
        
    });
</script>
@stop
