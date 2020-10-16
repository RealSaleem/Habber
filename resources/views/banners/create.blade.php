@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Banner</h2>
        </div>
    </div>
        <div class="container-fluid">
             @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Banner Created! &nbsp;</strong>{{Session::get('success')}}
            </div>
              @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{action('BannerController@store')}}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">Add Banner Info</h4>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Description</label>
                        <div  class="col-sm-9">
                         <textarea class="form-control" id="description" name="description" value="{{ old('description') }}" rows="4" cols="54" style="resize:none, " placeholder= "Details"  ></textarea>
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status"  id="status">
                                <option value="0" {{ (old('status') == "0" ? "selected":"")}}>Disable</option>
                                <option value="1" {{ (old('status') == "1" ? "selected":"")}}>Enable</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        </div>
                     </div> 

                    <div class="form-group row">
                        <label for="image" class="col-sm-3 text-right control-label col-form-label">Image</label>
                        <div class="col-sm-9">
                        <input id="image" type="file" class="form-control" name="image">
                            <span class="text-danger">{{$errors->first('image')}}</span>
                        </div>
                    </div>
                     <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('banners.index')}}">
                        <button type="button" class=" btn btn-danger">
                            Cancel
                        </button></a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                       </div>
                      </div>
                </div>     
            </form>
        </div>
    </div>
</div>
                  
@endsection