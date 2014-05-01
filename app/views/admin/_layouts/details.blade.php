<!doctype html>
<html lang="{{ Session::get('user_lang') }}">
<head>
    <meta charset="utf-8">
    <title>Rentame Liberia Admin</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link href="{{ URL::asset('/css/normalize.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/mainBackend.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/js/vendor/lightbox/css/lightbox.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ URL::asset('/img/favicon.ico') }}">
    
    <script src="{{ URL::asset('/js/vendor/modernizr-2.6.2.min.js') }}"></script>
   

</head>
<body>
 <div class="wrap">
        
        <header>
               
                <div id="logo"><a href="/admin/"><img src="/img/logo.png" alt="Rentameliberia" /><span>rentameliberia</span></a></div>
                <div id="btn_nav">Menu</div>
                <div id="menu_backend">
                    
                     @if (Sentry::check())
                            <ul >

                                
                                <li><a href="{{ URL::route('admin.properties.index') }}"><i class="icon-home"></i> Properties</a></li>
                                <li><a href="{{ URL::route('admin.categories.index') }}"><i class="icon-archive"></i> Categories</a></li>
                                <li><a href="{{ URL::route('admin.prequests.index') }}"><i class="icon-mail"></i> Requests</a></li>
                                 <li><a href="{{ URL::route('admin.testimonials.index') }}"><i class="icon-bookmark"></i> Testimonials</a></li>
                                  <li><a href="{{ URL::route('admin.users.index') }}"><i class="icon-vcard"></i> Users</a></li>

                                
                            </ul>
                        @endif
                </div>
                @if (Sentry::check() )
                 <div id="login"><a href="{{ URL::route('admin.logout') }}"><i class="icon-key"></i> Logout</a></div>
                 @else
                    <div id="login"><a href="{{ URL::route('admin.login') }}"><i class="icon-key"></i> Login</a></div>
                 @endif
            
        </header>
        
        <section id="main">
             @yield('main')
        </section>
    </div>
    <script src="/js/vendor/jquery-1.10.1.min.js"></script>
    <script src="/js/vendor/lightbox/js/lightbox-2.6.min.js" type="text/javascript"></script>
    <script src="/js/vendor/bootstrap.min.js"></script>
    <script src="{{ URL::asset('/js/vendor/ajaxupload.js') }}"></script>
    <script src="/js/backend.js"></script>
</body>
</html>
