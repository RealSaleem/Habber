@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.banner_page.add_new_banner')</h2>
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
                    <h4 class="card-title">@lang('messages.banner_page.add_banner_info')</h4>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.description')</label>
                        <div  class="col-sm-9">
                         <textarea class="form-control" id="description" name="description" value="{{ old('description') }}" rows="4" cols="54" style="resize:none, " placeholder= "Details"  ></textarea>
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.business_page.product_type')</label>
                        <div class="col-sm-9">
                        
                            <select class="form-control" name="product_type"  id="product_type">
                             
                                <option disabled selected value> -- select an option -- </option>
                                <option value="bookclub" {{ (old('product_type') == "bookclub" ? "selected":"")}}>Bookclubs</option>
                                <option value="book" {{ (old('product_type') == "book" ? "selected":"")}}>Books</option>
                                <option value="bookmark" {{ (old('product_type') == "bookmark" ? "selected":"")}}> Bookmarks</option>
                                
                             </select>
                            
                            <span class="text-danger">{{$errors->first('product_type')}}</span>
                            <span class="text-danger">{{$errors->first('bookmarks_id')}}</span>
                         <span class="text-danger">{{$errors->first('books_id')}}</span>
                         <span class="text-danger">{{$errors->first('bookclubs_id')}}</span>
                        </div>
                        </div>
                        <div class="form-group row">
                          <label  for="cono1" class="col-sm-3 text-right control-label col-form-label type "></label>
                        <div class="col-sm-9">
                         <select class="form-control" name="type"  id="type" value="type" >
                         </select>     
                         
                        </div>
                    </div>
            
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label" >@lang('messages.banner_page.status')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status"  id="status">
                                <option value="0" {{ (old('status') == "0" ? "selected":"")}}>Disable</option>
                                <option value="1" {{ (old('status') == "1" ? "selected":"")}}>Enable</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        </div>
                     </div> 
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.link')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="banner_url"  value="{{ old('banner_url') }}" id="banner_url"  placeholder="Banner Link">
                            <span class="text-danger">{{$errors->first('banner_url')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.sort_order')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="sort_order"  value="{{ old('sort_order') }}" id="sort_order"  placeholder="Banner Order">
                            <span class="text-danger">{{$errors->first('sort_order')}}</span>
                        </div>
                    </div>
                    
                       <div class="form-group row">
                        <label for="image" class="col-sm-3 text-right control-label col-form-label" >@lang('messages.banner_page.image')
                        <br> (1000*450)  </label>
                        <div class="col-md-9">

                            <input  type="file" id="image" class="form-control" name="image">
                            <span class="text-danger">{{$errors->first('image')}}</span>
                        </div>
                       </div>
                     <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('banners.index')}}">
                        <button type="button" class=" btn btn-danger">
                        @lang('messages.button.back')
                        </button></a>
                        <button type="submit" class="btn btn-primary"> @lang('messages.button.submit')</button>
                       </div>
                      </div>
                </div>     
            </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $('#type').hide();

$('#product_type').change(function(e){
    e.preventDefault()
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   // id
   var type = $(this).val();
    if(type == "null") {

        $(".type").hide();   
        $('#type').hide();
        e.preventDefault()
        return false;
      
    }
   $.ajax({
     url: "{{ URL('/admin/getlist')}}"+"/"+type,
     type: 'get',
     dataType: 'json',
     success: function(response){
        var len = response.id.length;
        for(var i=0; i < len; i++){
           var id = response.id[i];
           var name = response.name[i];
           var option = "<option value='"+id+"'>"+name+"</option>"; 
           $("#type").append(option); 
       }
       $('#type').attr('name', type +'_id');
       $(".type").text(type);
       $(".type").show();
         

       $('#type').show();

     }
  });
});
});

 

</script>
                  
@endsection
