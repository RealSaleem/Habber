@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.banner_page.edit_banner')</h2>
        </div>
    </div>
        <div class="container-fluid">
             @if(Session::has('success'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Banner Edited! &nbsp;</strong>{{Session::get('success')}}
            </div>
              @endif 
            
        </div> 
    <div class="col-md-12">
        <div class="card">
            <form action="{{action('BannerController@update',[$banner->id])}}" method="post"  enctype="multipart/form-data" >   
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">@lang('messages.banner_page.edit_banner_info')</h4>
                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.description')</label>
                        <div  class="col-sm-9">
                        <textarea class="form-control" id="description" name="description" rows="4" cols="54" style="resize:none," value=""  >{{ $banner->description }}</textarea>
                            <span class="text-danger">{{$errors->first('description')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.business_page.product_type')</label>
                        <div class="col-sm-9">
                        
                            <select class="form-control" name="product_type"  id="product_type" >
                             
                                <option disabled selected value> -- select an option -- </option>
                                <option value="bookclub" {{ ($banner->product_type == "bookclub" ? "selected":"")}}>Bookclubs</option>
                                <option value="book" {{ ($banner->product_type == "book" ? "selected":"")}}>Books</option>
                                <option value="bookmark" {{ ($banner->product_type == "bookmark" ? "selected":"")}}> Bookmarks</option>
                                
                             </select>
                            
                            <span class="text-danger">{{$errors->first('product_type')}}</span>
                        </div>
                        </div>
                        <div class="form-group row">
                          <label  for="cono1" class="col-sm-3 text-right control-label col-form-label type "></label>
                        <div class="col-sm-9">
                         <select class="form-control" name="type" id="type"value="{{ $banner->type}}" >
                         </select>     
                         <span class="text-danger">{{$errors->first('type')}}</span>
                        </div>
                    </div>
            
            

                    <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.status')</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="status"  id="status">
                                <option value="0" {{ ($banner->status == 0 ? "selected":"")}}>Disable</option>
                                <option value="1" {{ ($banner->status == 1 ? "selected":"")}}>Enable</option>
                             </select>   
                            <span class="text-danger">{{$errors->first('status')}}</span>
                        </div>
                     </div> 
                     <div class="form-group row">
                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.language')</label>
                        <div class="col-sm-9">
                        <select  class="form-control" name="language_id" id="language_id" >
                        @foreach($language as $l)
                            <option value="{{$l->id}}" {{ ($banner->language_id == $l->id ? "selected" : "")}} > {{$l->name}}</option>
                            @endforeach
                        </select>
                            <span class="text-danger">{{$errors->first('language_id')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.link')</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="banner_url" value="{{ $banner->banner_url }}">
                            <span class="text-danger">{{$errors->first('banner_url')}}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="image" class="col-sm-3 text-right control-label col-form-label">@lang('messages.banner_page.image')</label>
                        <div class="col-sm-9">
                        <input id="image" type="file" class="form-control" name="image">
                            <span class="text-danger">{{$errors->first('image')}}</span>
                            @if(isset($banner->image))
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <img class="form-control" style=" width: 100px; height: 100px;" src="{{ url('storage/'.$banner->image)}}" alt="no-image">
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                     <div class="border-top">
                       <div class="card-body">
                        <a href="{{route('banners.index')}}">
                        <button type="button" class=" btn btn-danger">
                        @lang('messages.button.back')
                        </button></a>
                        <button type="submit" class="btn btn-primary"> @lang('messages.button.update')</button>
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
    //$('#type').hide();
    var selectedValue = $( "#product_type" ).val();
    if(selectedValue == "bookclub" || selectedValue == "bookmark" || selectedValue == "books") {
        fetch(selectedValue);
    }

    $('#product_type').change(function(e){
        e.preventDefault()
        var type = $(this).val();
        fetch(type);

    });
    
    var data = {!! json_encode($banner, JSON_HEX_TAG) !!};
    var selectedId = (data.books) ? data.books.id : data.bookmarks ?  data.bookmarks.id : data.bookclubs ? data.bookclubs.id : null  ;
    // $("#type").val();
   
    // console.log(data.bookclubs != null);
    // if(data.books != null ) {
    //     $('#type').show();
    //     $('#type').attr('name', 'book_id');
    //     $(".type").text('books');
    //     $(".type").show();
    // }
    // else if(data.bookmarks != null ) {
    //     $('#type').show();
    //     $('#type').attr('name', 'bookmark_id');
    //     $(".type").text('bookmarks');
    //     $(".type").show();
    // }
    // else if(data.bookclubs != null) {
    //     $('#type').show();
    //     $('#type').attr('name', 'bookclub_id');
    //     $(".type").text('bookclubs');
    //     $(".type").show();
    //     $('product_type option[value="SEL1"]')
    // }
    // else {
    //     $('#type').hide();
    // }



    function fetch(type) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    // id
       
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
                
                var option = "<option value='"+id+"' >"+name+"</option>"; 
                $("#type").append(option); 
            }
            $('#type').attr('name', type +'_id');
            $(".type").text(type);
            $(".type").show();
            $('#type').show();
            if(selectedId != null ) {
                $("#type").val(selectedId);
            }

            } 
        

        });
    }
       
    

});
 
 

</script>                
@endsection