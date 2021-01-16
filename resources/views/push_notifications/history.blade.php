@extends('layouts.app')
@section('content')
    
<h1 class="page-title">@lang('messages.push_notifications_page.history')
</h1>
<div class="ml-auto text-right">
</div> 
@if(Session::has('success'))
    <div class="alert alert-success text-center" role="alert">
        <strong>{{Session::get('success')}}</strong>
    </div>
@endif 
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>To</th>
                    </tr>
                </thead>
                <tbody>
                @if($value!=null)
                @for($i=0;$i<count($value);$i++)
                    <tr>    

                        <td>{{$value[$i]['title']}}</td>
                        <td>{{$value[$i]['body']}}</td>
                        <td>{{$us[$i]['first_name']}}</td>
                        
                            
                                
                    </tr>
                    @endfor
                    @endif
                </tbody>
            </table>
        </div>   
    </div>    
</div>
@endsection