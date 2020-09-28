@extends('layouts.app')
@extends('content')

        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong> Users   !</strong> {{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5> Users List </h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                                               
                    </tr>
                    </thead>
                </table>
                <tbody>
                 
                  @foreach($user as user)
                  
                  <tr>

                      <td>{{$user->firstname}} </td>

                      <td>{{$user->email}} </td>

                     <td>{{$user->contact}} </td>
                     
                    </tr>
                     @endforeach
                </tbody>

                </table>      

        
            </div>         
        </div>
    </div>
@endsection