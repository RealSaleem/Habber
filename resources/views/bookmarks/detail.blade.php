@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Bookmark Detail</h2>
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
            <form >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body row" style="font-size: 18px;">
                    <h4 class="card-title col-12">Bookmarks</h4>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.bookmark_id'):   {{ucfirst($bookmark->bookmark_id)}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.title'):   {{ucfirst($bookmark->title)}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.maker_name'):   {{ucfirst($bookmark->maker_name)}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.description'):   {{ucfirst($bookmark->description)}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.size'):  {{ucfirst($bookmark->size )}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.quantity'):  {{ucfirst($bookmark->quantity )}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.price'):  {{ucfirst($bookmark->product_prices['price'])}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.publisher'):  {{ucfirst($bookmark->users['first_name'])}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.added_by'): {{($bookmark->bookmarkAddedBy->roles[0]->name == "Admin") ? "Admin" : $bookmark->bookmarkAddedBy->roles[0]->name .' '. $bookmark->bookmarkAddedBy->fullname }}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.status'): {{ucfirst($bookmark->status == 1 ? "active" : "not active")}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.feature'):{{ucfirst($bookmark->featured == 1 ? "featured" : "not featured")}} </label>
                    </div>
                     @if(isset($bookmark->image))
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.image'):  </label>
                        <img style=" width: 50px; height: 50px;" src="{{ url('storage/'.$bookmark->image)}}" alt="">
                    </div>
                    @endif 
                </div>
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('bookmarks.index')}}">
                        <button type="button" class=" btn btn-success">
                        @lang('messages.button.back')
                        </button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                  
@endsection
