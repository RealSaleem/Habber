@extends('layouts.app')
@section('content')
<div class="container-fluid">
        @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>{{Session::get('success')}} &nbsp;</strong>
            </div>
        @endif 
    </div> 

<div class="container">
    <article class="card">
        <form action="{{ route('order.update1',[$idd])}}" method="POST"  enctype="multipart/form-data" > 
                {{ csrf_field() }}
                @method('PUT')
     
            
         
            <article class="card">
               
                <table id="zero_config" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Product Name </th>
                        <th>Product ID </th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Product Status</th>
                        
                       
                    </tr>
                </thead>
                <tbody>
                @if($order!=null)
                    @foreach($order as $o)
                    @foreach($books as $book)
                     @if($o['product_id']==$book['id'] && $o['product_type']=='book')
                        <tr>
                        <td>{{$book['title']}}</td>
                            <td>{{$book['isbn']}}</td>
                            <td>{{$o->price}}</td>
                            <td>{{$o->quantity}}</td>
                            <td><img style=" width: 50px; height: 50px;" src=" {{  url('storage/'.$book['image'])  }}" alt=""> </td>
                            <td>
                          <div class="card-body row">
                          
                    <select class="form-control" name="product_status" id="product_status">
                            <option value="Not Ready" {{($o->product_status == "Not Ready" ? 'selected' : '')}}>Not Ready</option>
                            <option value="Ready" {{($o->product_status == "Ready" ? 'selected' : '')}}>Ready</option>
                     </select>
                    </div>
                    </td>
                        </tr>
                        <input  type="hidden" name="book_id" value="{{$book['id']}}">
                        @endif
                        @endforeach
                    @endforeach
                @endif   
                @if($order!=null)
                    @foreach($order as $o)
                    @foreach($bookmarks as $bookmark)
                     @if($o['product_id']==$bookmark['id'] && $o['product_type']=='bookmark')
                        <tr>
                        <td>{{$bookmark['title']}}</td>
                            <td>{{$bookmark['id']}}</td>
                            <td>{{$o->price}}</td>
                            <td>{{$o->quantity}}</td>
                            <td><img style=" width: 50px; height: 50px;" src=" {{  url('storage/'.$bookmark['image'])  }}" alt=""> </td>
                            <td>
                          <div class="card-body row">
                        
                    <select class="form-control" name="product_status1" id="product_status">
                            <option value="Not Ready" {{($o->product_status == "Not Ready" ? 'selected' : '')}}>Not Ready</option>
                            <option value="Ready" {{($o->product_status == "Ready" ? 'selected' : '')}}>Ready</option>
                     </select>
                    </div>
                    </td>
                        </tr>
                        <input  type="hidden" name="bookmark_id" value="{{$bookmark['id']}}">
                        @endif
                        @endforeach
                    @endforeach
                @endif  
                </tbody>
            </table> 
                 
              
                    <div class="card-body">
                    <a href="{{route('orders.index')}}">
                        <button type="button" class=" btn btn-success">
                        @lang('messages.button.back')
                        </button></a>
                        <button type="submit" class="btn btn-primary">@lang('messages.button.update_status')</button>
                    </div>
                </div>
                </form>
                </article>
              
    


                  
@endsection
