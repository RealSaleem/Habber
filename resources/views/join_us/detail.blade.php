@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.joinusrequest_page.view_user_request')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>{{Session::get('success')}} &nbsp;</strong>
            </div>
        @endif 
    </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{ route('joinus.update',['id'=> $business->id])}}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body row" style="font-size: 18px;">
                    <h4 class="card-title col-12">@lang('messages.joinusrequest_page.userjoinusrequest')</h4>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.joinusrequest_page.submission_id')   {{$business->id}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="fname" class="text-right control-label col-form-label">@lang('messages.joinusrequest_page.requested_by'):  {{$business->name  }}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.joinusrequest_page.email'):  {{ucfirst($business->email )}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.joinusrequest_page.phone_number'):   {{ucfirst($business->phone )}} </label>
                    </div>
                  
                    <div class="form-group col-6">
                        <label for="fname" class="text-right control-label col-form-label">@lang('messages.joinusrequest_page.business_type')  {{ucfirst($business->business_type )}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="fname" class="text-right control-label col-form-label">@lang('messages.joinusrequest_page.product_type'):  {{($business->product_type == "both" ) ? "Books, Bookmarks" : $business->product_type }}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="fname" class="text-right control-label col-form-label">@lang('messages.business_page.details') : {{$business->details }}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="fname" class="text-right control-label col-form-label">@lang('messages.joinusrequest_page.submission_date')  {{$business->created_at}}</label>
                    </div>
                   
                    <!-- @if(isset($userRequest->image))
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">Book Image:  </label>
                        <img style=" width: 50px; height: 50px;" src="{{ url('storage/'.$userRequest->image)}}" alt="">
                    </div>
                    @endif -->
                    <div class="form-group col-6">
                        <label for="fname" class="text-right control-label col-form-label">@lang('messages.joinusrequest_page.status'): </label>
                        <select class="form-control" name="status" id="">
                            <option value="0" {{($business->status == "0" ? 'selected' : '')}}>Pending</option>
                            <option value="1" {{($business->status == "1" ? 'selected' : '')}}>Seen</option>
                        </select>
                    </div>
                </div>
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('joinus')}}">
                        <button type="button" class=" btn btn-success">
                        @lang('messages.button.back')
                        </button></a>
                        <button type="submit" class="btn btn-primary"> @lang('messages.button.update_status')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                  
@endsection
