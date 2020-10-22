@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.role_page.edit_role')</h2>
        </div>
    </div>
        <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Role Updated! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
            
         </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{ action('RoleController@update',[$role->id]) }}" method="post" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.role_page.add_role_info')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.user_page.first_name')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" value="{{$role->name}}" placeholder="Name ">
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.permission_page.permission')</label>
                            <div class="col-md-9">
                                <select class="select2 form-control m-t-15" name="permission[]" multiple="multiple" >
                                    @foreach($permission as $value)
                                    <optgroup label="">
                                        <option value="{{$value->id}} " {{ (in_array($value->id, $rolePermissions)) ? 'selected' : '' }}>{{$value->name}}</option>
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        <span class="text-danger">{{$errors->first('permission')}}</span>
                    </div>
                    <div class="border-top">
                       <div class="card-body">
                            <a href="{{route('roles.index')}}">
                            <button type="button" class=" btn btn-danger">
                            @lang('messages.button.back')
                            </button></a>
                            <button type="submit" class="btn btn-primary"> @lang('messages.button.submit')</button>
                        </div>
                    </div>
                </div>     
            </form>
        </div>
    </div>
</div>
                  
@endsection
@section('scripts')
<script>
$(".select2").select2();
</script>

@stop