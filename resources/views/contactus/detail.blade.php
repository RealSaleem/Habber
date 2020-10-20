@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>View Contact Us Request</h2>
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
                    <h4 class="card-title col-12">Contact Us Request</h4>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">User Name:   {{ucfirst($contact->name)}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">Email:  {{ucfirst($contact->email )}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">Phone Number:   {{$contact->phone}} </label>
                    </div>
                  
                    <div class="form-group col-6">
                        <label for="fname" class="text-right control-label col-form-label">Message:  {{ucfirst($contact->message )}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="fname" class="text-right control-label col-form-label">Submission Date:  {{$contact->created_at}}</label>
                    </div>
                    <!-- @if(isset($userRequest->image))
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">Book Image:  </label>
                        <img style=" width: 50px; height: 50px;" src="{{ url('storage/'.$userRequest->image)}}" alt="">
                    </div>
                    @endif -->
                </div>
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('contactus.index')}}">
                        <button type="button" class=" btn btn-success">
                            Back
                        </button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                  
@endsection
