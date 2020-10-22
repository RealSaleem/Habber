@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.favourite_page.view_favourite')</h2>
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
                    <h2 class="card-title col-12">@lang('messages.favourite_page.favourites')</h2>
                    <div class="form-group col-12">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.business_page.user') @lang('messages.bookclub_page.name'):   {{ucfirst($fav->users->first_name .' '.$fav->users->last_name)}} </label>
                    </div>
                    @if(count($fav->books) > 0)
                    <h3 class = "card-title col-12">@lang('messages.book_page.books'):</h3>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.books') @lang('messages.book_page.title'):  {{ucfirst($fav->books[0]->title )}}</label>
                    </div>

                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.books') @lang('messages.book_page.description'):  {{ucfirst($fav->books[0]->description )}}</label>
                    </div>

                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.books') @lang('messages.book_page.author_name'):  {{ucfirst($fav->books[0]->author_name )}}</label>
                    </div>

                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.books') @lang('messages.book_page.price'):  {{ucfirst($fav->books[0]->price )}}</label>
                    </div>

                 
                    @endif
                    @if(count($fav->bookmarks) > 0)
                    <h3 class = "card-title col-12">@lang('messages.bookmark_page.bookmarks'):</h3>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.bookmarks') @lang('messages.bookmark_page.title'):   {{ucfirst($fav->bookmarks[0]->title)}} </label>
                    </div>

                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.bookmarks') @lang('messages.bookmark_page.description'):  {{ucfirst($fav->bookmarks[0]->description )}}</label>
                    </div>

                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.bookmarks') @lang('messages.bookmark_page.maker_name'):  {{ucfirst($fav->bookmarks[0]->author_name )}}</label>
                    </div>

                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.bookmark_page.bookmarks') @lang('messages.bookmark_page.price'):  {{ucfirst($fav->bookmarks[0]->price )}}</label>
                    </div>

                    @endif
                </div>
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('user.favourites' , $fav->user_id) }}">
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
