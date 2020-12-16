<!-- Sidebar scroll-->
<div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav" class="p-t-30">
            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('welcome')}}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">@lang('messages.header.dashboard')</span></a></li>
                <li class="sidebar-item" {{ (auth()->user()->roles[0]->hasPermissionTo('user-edit','user-delete','user-create','user-list') ||  auth()->user()->hasAnyDirectPermission('user-edit','user-delete','user-create','user-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.user_page.users')  </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('users.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('users.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <!-- publisher -->
                <li class="sidebar-item" {{ (auth()->user()->hasAnyRole('Admin') ||  auth()->user()->hasAnyDirectPermission('book-edit','book-delete','book-create','book-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.book_page.books') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('books.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('books.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" {{ (auth()->user()->hasAnyRole('Admin') ||  auth()->user()->hasAnyDirectPermission('bookmark-edit','bookmark-delete','bookmark-create','bookmark-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.bookmark_page.bookmarks') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('bookmarks.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('bookmarks.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"{{ (auth()->user()->hasAnyRole('Admin') ||  auth()->user()->hasAnyDirectPermission('book-club-edit','book-club-delete','book-club-create','book-club-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.bookclub_page.bookclubs')    </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('bookclubs.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('bookclubs.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" {{ (auth()->user()->hasAnyRole('Admin')  ||  auth()->user()->hasAnyDirectPermission('genre-edit','genre-delete','genre-create','genre-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.genre_page.genres') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('genres.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('genres.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create')</span></a></li>
                    </ul>
                </li>
                 <!--<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.business_page.business') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('business.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('business.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>-->
                <li class="sidebar-item" {{ (auth()->user()->roles[0]->hasPermissionTo('address-edit','address-delete','address-create','address-list') ||  auth()->user()->hasAnyDirectPermission('address-edit','address-delete','address-create','address-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.address_page.address') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('address.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('address.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" {{ (auth()->user()->roles[0]->hasPermissionTo('user-request-edit','user-request-delete','user-request-create','user-request-list') ||  auth()->user()->hasAnyDirectPermission('user-request-edit','user-request-delete','user-request-create','user-request-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.userrequest_page.userrequest') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('user_requests.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" {{ (auth()->user()->roles[0]->hasPermissionTo('contact-edit','contact-delete','contact-create','contact-list') ||  auth()->user()->hasAnyDirectPermission('contact-edit','contact-delete','contact-create','contact-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.contactus_page.contactus') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('contactus.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" {{ (auth()->user()->roles[0]->hasPermissionTo('join-us-edit','join-us-delete','join-us-create','join-us-list') ||  auth()->user()->hasAnyDirectPermission('join-us-edit','join-us-delete','join-us-create','join-us-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.joinusrequest_page.joinusrequest') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('joinus') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" {{ (auth()->user()->roles[0]->hasPermissionTo('banner-edit','banner-delete','banner-create','banner-list') ||  auth()->user()->hasAnyDirectPermission('banner-edit','banner-delete','banner-create','banner-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.banner_page.banners') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('banners.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('banners.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                </li>
                <li class="sidebar-item" {{ (auth()->user()->roles[0]->hasPermissionTo('ad-edit','ad-delete','ad-create','ad-list') ||  auth()->user()->hasAnyDirectPermission('ad-edit','ad-delete','ad-create','ad-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.ad_page.ad') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('ads.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('ads.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" {{ (auth()->user()->roles[0]->hasPermissionTo('permission-edit','permission-delete','permission-create','permission-list') ||  auth()->user()->hasAnyDirectPermission('permission-edit','permission-delete','permission-create','permission-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.permission_page.permission') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('permissions.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('permissions.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item" {{ (auth()->user()->roles[0]->hasPermissionTo('role-edit','role-delete','role-create','role-list') ||  auth()->user()->hasAnyDirectPermission('role-edit','role-delete','role-create','role-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.role_page.role') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('roles.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('roles.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>
            </li>
            <li class="sidebar-item" {{ (auth()->user()->roles[0]->hasPermissionTo('language-edit','language-delete','language-create','language-list') ||  auth()->user()->hasAnyDirectPermission('language-edit','language-delete','language-create','language-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.language_page.languages') </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="{{ route('languages.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    <li class="sidebar-item"><a href="{{ route('languages.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                </ul>
            </li>
            <li class="sidebar-item" {{ (auth()->user()->roles[0]->hasPermissionTo('country-edit','country-delete','country-create','country-list') ||  auth()->user()->hasAnyDirectPermission('country-edit','country-delete','country-create','country-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.country_page.countries') </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="{{ route('countries.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    <li class="sidebar-item"><a href="{{ route('countries.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                </ul>
            </li>
            <li class="sidebar-item" {{ (auth()->user()->roles[0]->hasPermissionTo('country-edit','country-delete','country-create','country-list') ||  auth()->user()->hasAnyDirectPermission('country-edit','country-delete','country-create','country-list')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.city_page.city') </span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="{{ route('city.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    <li class="sidebar-item"><a href="{{ route('city.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                </ul>
            </li>
            <li class="sidebar-item" {{ (auth()->user()->roles[0]->hasPermissionTo('site-setting-edit','site-setting-delete','site-setting-create','site-setting-list') ||  auth()->user()->hasAnyDirectPermission('site-setting-edit','site-setting-delete','site-setting-create','site-setting-list')) == true ? "" : "hidden"}}> <a class="sidebar-link waves-effect waves-dark"  href="{{ route('sitesetting.index') }}" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.site_setting_page.site_setting') </span></a>
                <!-- <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="{{ route('sitesetting.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                    <li class="sidebar-item"><a href="{{ route('sitesetting.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                </ul> -->
            </li>
            <li class="sidebar-item"{{ (auth()->user()->hasAnyRole('Admin')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu"> @lang('messages.push_notifications_page.push_notifications') </span></a>
               <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="{{ route('push_notifications.index') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                </ul> 
            </li>
            <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.order_page.order')</span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item"><a href="{{ route('orders.index') }}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                </ul>
            </li>
            <!-- {{ (auth()->user()->hasAnyRole('Admin') ||  auth()->user()->hasAnyDirectPermission('book-edit','book-delete','book-create','book-list')) == true ? "" : "hidden"}} -->
            <li class="sidebar-item"{{ (auth()->user()->hasAnyRole('Admin')) == true ? "" : "hidden"}}> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">@lang('messages.static_page.staticpage') </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('static_pages.show',['about-us','en'])}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.static_page.aboutus') </span></a></li> 
                        <li class="sidebar-item"><a href="{{ route('static_pages.show',['privacy-policy','en'])}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.static_page.privacypolicy') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('static_pages.show',['return-policy','en'])}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.static_page.returnpolicy') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('static_pages.show',['terms-and-conditions','en'])}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.static_page.termsandcondition') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('static_pages.show',['about-us','ar'])}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.static_page.aboutusar') </span></a></li> 
                        <li class="sidebar-item"><a href="{{ route('static_pages.show',['privacy-policy','ar'])}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.static_page.privacypolicyar') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('static_pages.show',['return-policy','ar'])}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.static_page.returnpolicyar') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('static_pages.show',['terms-and-conditions','ar'])}}" class="sidebar-link"><i class="mdi mdi-note-outline"></i><span class="hide-menu"> @lang('messages.static_page.termsandconditionar') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('static_pages.index') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.list') </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('static_pages.create') }}" class="sidebar-link"><i class="mdi mdi-note-plus"></i><span class="hide-menu"> @lang('messages.sidebar.create') </span></a></li>
                    </ul>
                </li>

    
       

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