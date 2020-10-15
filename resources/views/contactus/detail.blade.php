@extends('layouts.app')
@section('content')
<h1 class="page-title">Contact Us</h1>
<div class="ml-auto text-right">
</div> 
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
          <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>                 
                          </tr>
               </thead>
               <tbody>
           <tr>
          <td>{{$contact->name}}</td>
            <td>{{$contact->email}}</td>
            <td>{{$contact->phone}}</td>  
            <td>{{$contact->message}}</td>
            </tr>
           
           </tbody>
           </table>
        </div>   
    </div>    
</div>
@endsection
 
               
             