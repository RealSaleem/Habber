@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.push_notifications_page.add_push_notifications')</h2>
        </div>
    </div>
    <div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Message Sent! &nbsp;</strong>{{Session::get('success')}}
            </div>
        @endif 
        @if(Session::has('featured'))
            <div class="alert alert-danger text-center" role="alert">
                <strong>Limit Exceded! &nbsp;</strong>{{Session::get('featured')}}
            </div>
        @endif 
        <div class="col-md-12">
        <div class="card">
        
            <form action="{{ action('PushNotificationController@sendNotification') }}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.push_notifications_page.add_push_notifications_info')</h4>
                        <div class="form-group row">
                        <label for="lname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.push_notifications_page.description')</label>
                        <div class="col-sm-9">
                            <textarea type="textarea" class="form-control" name="description" value="{{ old('description') }}" id="description" placeholder="Description"  maxlength = "560"></textarea>
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.push_notifications_page.options')</label>
                        <div class="col-sm-9">
                            <select class="form-control" onchange="wow(this);" name="option"  id="option">
                               <option value="">Select Please</option>
                                <option value="1" {{ (old('option') == "1" ? "selected":"")}}>Send to selected users</option>
                                <option value="0" {{ (old('option') == "0" ? "selected":"")}}>Send to all users</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('option')}}</span>
                        </div>
                     </div>
                     
                     
    
                    <div class="form-group row" id="users23">
                        <label for="fname" name="la" class="col-sm-3 text-right control-label col-form-label">@lang('messages.push_notifications_page.users')</label>
                            <div class="col-md-9">
                                <select class="select2 form-control m-t-15" id="users" name="users[]" multiple="multiple" >
                                @if (isset($usersDropDown))   
                                @foreach($usersDropDown as $u)
                                    <optgroup label="">
                                        <option value="{{$u->id}}">{{$u->full_name}}</option>
                                    </optgroup>
                                    @endforeach
                                    @endif
                                </select>
                                <span class="text-danger">{{$errors->first('users')}}</span>
                            </div>
                     
                    </div>
                    
                     <div class="border-top">
                      <div class="card-body">

                        <button type="submit" id="add" class="btn btn-primary"> @lang('messages.button.submit')</button>
                        
                    </div>
                    </div>
                </div>   
</form>
@endsection
@section('scripts')
<script>
$(".select2").select2();
</script>


 <script>
var value1;
 function wow(obj)
{
     value1 = obj.options[obj.selectedIndex].value;

    return (value1 === "0" ? document.getElementById("users23").style.display ="none" : document.getElementById("users23").style.display ="flex");
}
</script>
<!--
  var description, users;
  var firebaseConfig = {
    apiKey: "AIzaSyCZXm7EImj1uWqJXE9kgGZ7Kv7yOS12kyg",
    authDomain: "hebber-72e2b.firebaseapp.com",
    databaseURL: "https://hebber-72e2b.firebaseio.com",
    projectId: "hebber-72e2b",
    storageBucket: "hebber-72e2b.appspot.com",
    messagingSenderId: "540308436088",
    appId: "1:540308436088:web:17370782494127d555e98d",
    measurementId: "G-003VDYR3FC"
};
  
  
  firebase.initializeApp(firebaseConfig); 
 
 function ready(){
    
 description=document.getElementById("description").value;
 users=document.getElementById("users").value;

}
function selectedusers(){
    var selected = [];
  for (var option of document.getElementById("users").options) {
    if (option.selected) {
      selected.push(option.value);
    }
  }
     for(var i=0;i<=selected.length;i++){
    firebase.database().ref('/User/' + selected[i] + '/Notification/').set({
    description : description,
    to : selected[i],
    read : "false"
  });
 }
}
function allusers(){
    u=document.getElementById("users");
    for(var i=0;i<=u.length;i++){
    firebase.database().ref('/User/' + u[i].value + '/Notification/').set({
    description : description,
    to : u[i].value,
    read : "false"
  });
 }
}
firebase.database().ref();
 document.getElementById("add").onclick = function(){
   ready();
   (value1 === "1")? selectedusers() : allusers();
    }
   
    

</script> -->

@stop