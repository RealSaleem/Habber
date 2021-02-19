<!-- Sidebar scroll-->
<div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav" class="p-t-30">
            <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('welcome')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">@lang('messages.header.dashboard')</span></a></li>
            @if(Session::get('users')->hasRole('admin'))
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.user_page.users')  </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('users.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('users.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
               
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.publisher_page.publisher')  </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('publisher.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"style="background-color: #786e0047;"><a href="{{ route('publisher.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" > <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.book_page.books') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('books.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('books.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.bookmark_page.bookmarks') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('bookmarks.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('bookmarks.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                @endif
                <!-- publisher -->
                @if(Session::get('users')->businesses['product_type']=='both')
                <li class="sidebar-item" > <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.book_page.books') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('books.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('books.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.bookmark_page.bookmarks') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('bookmarks.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('bookmarks.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                @endif
                @if(Session::get('users')->businesses['product_type']=='books')
                <li class="sidebar-item" > <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.book_page.books') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('books.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('books.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                @endif
                @if(Session::get('users')->businesses['product_type']=='bookmarks')
                
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.bookmark_page.bookmarks') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('bookmarks.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('bookmarks.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                @endif

                @if(Session::get('users')->hasRole('admin'))
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.size_page.bookmark_size') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('sizes.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('sizes.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.bookclub_page.bookclubs')    </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('bookclubs.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"style="background-color: #786e0047;"><a href="{{ route('bookclubs.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" > <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.genre_page.genres') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('genres.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('genres.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create')</span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" > <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.address_page.address') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('address.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('address.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.userrequest_page.userrequest') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('user_requests.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.contactus_page.contactus') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('contactus.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" > <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.joinusrequest_page.joinusrequest') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('joinus') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" > <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.banner_page.banners') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('banners.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('banners.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" > <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.role_page.role') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('roles.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('roles.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                </li>
                <li class="sidebar-item" > <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.ad_page.ad') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('ads.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('ads.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
            <li class="sidebar-item" > <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.language_page.languages') </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('languages.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('languages.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                </ul>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.country_page.countries') </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('countries.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('countries.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                </ul>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.address_page.state') </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('city.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('city.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                </ul>
            </li>
           
           
          
                <!-- <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="{{ route('sitesetting.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    <li class="sidebar-item"><a href="{{ route('sitesetting.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                </ul> -->
            </li>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.push_notifications_page.push_notifications')</span></a>
               <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('push_notifications.index') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('push_notifications.history') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.history') </span></a></li>
                </ul> 
            </li>
            @endif
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.order_page.order')</span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('orders.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                </ul>
            </li>
         
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark"  href="{{ route('reports.index') }}" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.reports_page.system_reports') </span></a>
            <!-- {{ (auth()->user()->hasAnyRole('Admin') ||  auth()->user()->hasAnyDirectPermission('book-edit','book-delete','book-create','book-list')) == true ? "" : "hidden"}} -->
            @if(Session::get('users')->hasRole('admin'))
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.static_page.staticpage') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item" style="background-color: #786e0047;"><a href="{{ route('static_pages.index') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    </ul>
                </li>
                  <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark"  href="{{ route('sitesetting.index') }}" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.site_setting_page.site_setting') </span></a></li>
                    @endif
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark"  href="{{ url('/logout') }}"aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">  @lang('messages.reports_page.logout')</span></a></li>
       

            <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Charts</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="widgets.html" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Widgets</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="tables.html" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Tables</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="grid.html" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Full Width</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Forms </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="form-basic.html" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Form Basic </span></a></li>
                    <li class="sidebar-item"><a href="form-wizard.html" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Form Wizard </span></a></li>
                </ul>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-buttons.html" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Buttons</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Icons </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="icon-material.html" class="sidebar-link"><i class="mdi mdi-emoticon"></i><span class="hide-menu"> Material Icons </span></a></li>
                    <li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><i class="mdi mdi-emoticon-cool"></i><span class="hide-menu"> Font Awesome Icons </span></a></li>
                </ul>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-elements.html" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Elements</span></a></li>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Addons </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="index2.html" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu"> Dashboard-2 </span></a></li>
                    <li class="sidebar-item"><a href="pages-gallery.html" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> Gallery </span></a></li>
                    <li class="sidebar-item"><a href="pages-calendar.html" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a></li>
                    <li class="sidebar-item"><a href="pages-invoice.html" class="sidebar-link"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu"> Invoice </span></a></li>
                    <li class="sidebar-item"><a href="pages-chat.html" class="sidebar-link"><i class="mdi mdi-message-outline"></i><span class="hide-menu"> Chat Option </span></a></li>
                </ul>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Authentication </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="authentication-login.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Login </span></a></li>
                    <li class="sidebar-item"><a href="authentication-register.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Register </span></a></li>
                </ul>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Errors </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="error-403.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 403 </span></a></li>
                    <li class="sidebar-item"><a href="error-404.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 404 </span></a></li>
                    <li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 405 </span></a></li>
                    <li class="sidebar-item"><a href="error-500.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 500 </span></a></li>
                </ul>
            </li> -->
                <!-- <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="charts.html" aria-expanded="false"><i class="mdi mdi-chart-bar"></i><span class="hide-menu">Charts</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="widgets.html" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Widgets</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="tables.html" aria-expanded="false"><i class="mdi mdi-border-inside"></i><span class="hide-menu">Tables</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="grid.html" aria-expanded="false"><i class="mdi mdi-blur-linear"></i><span class="hide-menu">Full Width</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Forms </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="form-basic.html" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> Form Basic </span></a></li>
                        <li class="sidebar-item"><a href="form-wizard.html" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> Form Wizard </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-buttons.html" aria-expanded="false"><i class="mdi mdi-relative-scale"></i><span class="hide-menu">Buttons</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Icons </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="icon-material.html" class="sidebar-link"><i class="mdi mdi-emoticon"></i><span class="hide-menu"> Material Icons </span></a></li>
                        <li class="sidebar-item"><a href="icon-fontawesome.html" class="sidebar-link"><i class="mdi mdi-emoticon-cool"></i><span class="hide-menu"> Font Awesome Icons </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="pages-elements.html" aria-expanded="false"><i class="mdi mdi-pencil"></i><span class="hide-menu">Elements</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-move-resize-variant"></i><span class="hide-menu">Addons </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="index2.html" class="sidebar-link"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu"> Dashboard-2 </span></a></li>
                        <li class="sidebar-item"><a href="pages-gallery.html" class="sidebar-link"><i class="mdi mdi-multiplication-box"></i><span class="hide-menu"> Gallery </span></a></li>
                        <li class="sidebar-item"><a href="pages-calendar.html" class="sidebar-link"><i class="mdi mdi-calendar-check"></i><span class="hide-menu"> Calendar </span></a></li>
                        <li class="sidebar-item"><a href="pages-invoice.html" class="sidebar-link"><i class="mdi mdi-bulletin-board"></i><span class="hide-menu"> Invoice </span></a></li>
                        <li class="sidebar-item"><a href="pages-chat.html" class="sidebar-link"><i class="mdi mdi-message-outline"></i><span class="hide-menu"> Chat Option </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-key"></i><span class="hide-menu">Authentication </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="authentication-login.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Login </span></a></li>
                        <li class="sidebar-item"><a href="authentication-register.html" class="sidebar-link"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu"> Register </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-alert"></i><span class="hide-menu">Errors </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="error-403.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 403 </span></a></li>
                        <li class="sidebar-item"><a href="error-404.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 404 </span></a></li>
                        <li class="sidebar-item"><a href="error-405.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 405 </span></a></li>
                        <li class="sidebar-item"><a href="error-500.html" class="sidebar-link"><i class="mdi mdi-alert-octagon"></i><span class="hide-menu"> Error 500 </span></a></li>
                    </ul>
                </li> -->
        </ul>
    </nav>
<!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->