@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>View User Request</h2>
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
            <form action="{{ route('joinus.update',['id'=> $user->id])}}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body row" style="font-size: 18px;">
                    <h4 class="card-title col-12">User Join Us Request</h4>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">Submission Id:   {{$user->id}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="fname" class="text-right control-label col-form-label">Requested By:  {{ucfirst($user->first_name ." ".$user->last_name )}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">Email:  {{ucfirst($user->email )}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">Phone Number:   {{ucfirst($user->phone )}} </label>
                    </div>
                  
                    <div class="form-group col-6">
                        <label for="fname" class="text-right control-label col-form-label">Business Type:  {{ucfirst($user->businesses->business_type )}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="fname" class="text-right control-label col-form-label">Product Type:  {{($user->businesses->product_type == "both" ) ? "Books, Bookmarks" : $user->businesses->product_type }}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="fname" class="text-right control-label col-form-label">Submission Date:  {{$user->created_at}}</label>
                    </div>
                    <!-- @if(isset($userRequest->image))
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">Book Image:  </label>
                        <img style=" width: 50px; height: 50px;" src="{{ url('storage/'.$userRequest->image)}}" alt="">
                    </div>
                    @endif -->
                    <div class="form-group col-6">
                        <label for="fname" class="text-right control-label col-form-label">Status: </label>
                        <select class="form-control" name="status" id="">
                            <option value="0" {{($user->status == "0" ? 'selected' : '')}}>Pending</option>
                            <option value="1" {{($user->status == "1" ? 'selected' : '')}}>Seen</option>
                        </select>
                    </div>
                </div>
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('joinus')}}">
                        <button type="button" class=" btn btn-success">
                            Back
                        </button></a>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                  
@endsection
