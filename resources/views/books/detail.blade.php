@extends('layouts.app')
@section('content')


<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>@lang('messages.book_page.books')</h2>
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
                    <h4 class="card-title col-12">@lang('messages.book_page.books')</h4>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.title'):   {{ucfirst($book->title)}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.author_name'):   {{ucfirst($book->author_name)}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.cover_type'):   {{ucfirst($book->cover_type)}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.description'):   {{ucfirst($book->description)}} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.total_pages'):  {{ucfirst($book->total_pages )}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.book_language'):  {{ucfirst($book->book_language )}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.price'):  {{ucfirst($book->product_prices['price'])}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.publisher'):  {{ucfirst($book->users['first_name'])}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.isbn'):  {{ucfirst($book->isbn)}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.bookclub'):  {{ucfirst($book->book_clubs['name'])}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.genre'):  {{ucfirst($book->genre['title'])}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.added_by'): {{($book->bookAddedBy->roles[0]->name == "Admin") ? "Admin" : $book->bookAddedBy->roles[0]->name .' '. $book->bookAddedBy->fullname }} </label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.status'):  {{ucfirst($book->status == 1 ? "Activate" : "Deactivate")}}</label>
                    </div>
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.feature'):  {{ucfirst($book->featured == 1 ? "featured" : "not featured")}} </label>
                    </div>
                     @if(isset($bookmark->image))
                    <div class="form-group col-6">
                        <label for="lname" class="text-right control-label col-form-label">@lang('messages.book_page.image'):  </label>
                        <img style=" width: 50px; height: 50px;" src="{{ url('storage/'.$book->image)}}" alt="">
                    </div>
                    @endif 
                </div>
                <div class="border-top">
                    <div class="card-body">
                    <a href="{{route('books.index')}}">
                        <button type="button" class=" btn btn-success">
                        @lang('messages.button.back')
                        </button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                  
@endsection
