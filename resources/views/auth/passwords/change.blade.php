@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.password_page.edit_password') </h2>
        </div>
    </div>
        <div class="container-fluid">
             @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Password Update! &nbsp;</strong>{{Session::get('success')}}
            </div>
              @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{ route('admin.password.change') }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.password_page.change_password')</h4>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.password_page.password')</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password"  id="password"  placeholder="Password">
                            <span class="text-danger">{{$errors->first('password')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.password_page.password_confirmation')</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password_confirmation"  id="password_confirmation"  placeholder="Confirm Password">
                            <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
                        </div>
                    </div>
                    
                    <div class="border-top">
                       <div class="card-body">
                            <a href="">
                            <button type="button" class=" btn btn-danger">
                            @lang('messages.button.back')
                            </button></a>
                            <button type="submit" class="btn btn-primary"> @lang('messages.button.update')</button>
                       </div>
                    </div>
                </div>     
            </form>
        </div>
    </div>
</div>
                  
@endsection
