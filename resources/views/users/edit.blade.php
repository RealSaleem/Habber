 @extends('layouts.app')
 @section ( 'content' )
<div class="container-fluid">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>User Edited! &nbsp;</strong>{{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                <h5> Edit User Info </h5>
            </div>
            
        </div>
                    <div class="control-group">
                        <label for="p_name" class="control-label">First Name</label>
                        <div class="controls{{$errors->has('p_name')?' has-error':''}}">
                            <input type="text" name="p_name" id="p_name" class="form-control" value="{{old('p_name')}}" title="" required="required" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('p_name')}}</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="p_name" class="control-label">Last Name</label>
                        <div class="controls{{$errors->has('p_name')?' has-error':''}}">
                            <input type="text" name="p_name" id="p_name" class="form-control" value="{{old('p_name')}}" title="" required="required" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('p_name')}}</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="p_email" class="control-label">Email</label>
                        <div class="controls{{$errors->has('p_email')?' has-error':''}}">
                            <input type="text" name="p_email" id="p_email" class="form-control" value="{{old('p_email')}}" required="required" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('p_email')}}</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="p_password" class="control-label">Password</label>
                        <div class="controls{{$errors->has('p_password')?' has-error':''}}">
                            <input type="text"name="p_password" id="p_password" class="form-control"  value="{{old('p_password')}}"title="" required="required" style="width: 400px;">
                            <span class="text-danger">{{$errors->first('p_password')}}</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="p_contact" class="control-label">Contact No</label>
                        <div class="controls{{$errors->has('p_contact')?' has-error':''}}">
                            <div class="input-prepend"> <span class="add-on"></span>
                                <input type="number" name="p_contact" id="p_contact" class="form-control" value="{{old('contact')}}" title="" required="required" style="width: 400px;"> 
                                <span class="text-danger">{{$errors->first('p_contact')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Profile Picture</label>
                        <div class="controls">
                            <input type="file" name="image" id="image"/>
                            <span class="text-danger">{{$errors->first('image')}}</span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="" class="control-label"></label>
                        <div class="controls">
                            <button type="submit" class="btn btn-success">Edit User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
