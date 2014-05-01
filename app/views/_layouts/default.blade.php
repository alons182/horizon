<!doctype html>
<html lang="{{ Session::get('user_lang') }}">
<head>
    <meta charset="utf-8">
    <title>Horizon Properties</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ URL::asset('/css/normalize.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/main.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ URL::asset('/img/favicon_16x16.ico') }}">
    <script src="{{ URL::asset('/js/vendor/modernizr-2.6.2.min.js') }}"></script>

</head>
<body>
    <ul id="fullscreen-slideshow" class="cycle-slideshow fullscreen-slideshow" data-cycle-slides="li" data-cycle-speed="1000" data-cycle-auto-height="false">
        <li><img src="img/1.jpg" alt="image01"/></li>
        
        
    </ul>

<div class="wrap">
            

            <header>
                <div class="inner">
                    <div id="logo"><a href="/"><img src="/img/logo.png" alt="Horizon Properties" /></a></div>
                    <div id="menu">
                    
                       
                         @if (Sentry::check())
                                <ul >
                                   
                                    <li><a href="{{ URL::action( 'PropertiesController@favorites' ) }}"><i class="icon-home"></i> {{ Lang::get('labels.label-your-properties') }} </a></li>
                                   
                                    
                                    
                                </ul>
                            @endif
                    </div>
                    <div id="login">
                        @if (Sentry::check())
                        <a href="{{ URL::route('logout') }}" class="link-logout"><span class="icon-key"></span>{{ Lang::get('labels.label-logout') }}</a>
                        @else
                        <a href="#" class="link-login"><span class="icon-key"></span>{{ Lang::get('labels.label-login') }}</a>
                        <div id="container-login">
                            {{ Form::open(array('route' => 'login')) }}
                                @if ($errors->has('login'))
                                    <div class="alert alert-error">{{ $errors->first('login', ':message') }}</div>
                                @endif
                                
                               
                                <h3>Email</h3>
                               
                                     {{ Form::email('email') }}
                                <h3>Password</h3>
                               
                                     {{ Form::password('password') }}
                                    
                                    
                              
                                    <div class="buttons">
                                     {{ Form::submit( Lang::get('labels.label-login') , array('class' => 'btn2')) }}
                                     <a href="#" class="link-login">{{ Lang::get('labels.label-cancel') }}</a>
                                 </div>
                                 
                           {{ Form::close() }}

                           <a href="{{ URL::route('register') }}">{{ Lang::get('labels.label-register') }}</a>

                        </div>
                        @endif
                    </div>
                </div>
            </header>
            <section id="main">
                @yield('main')
                    
                
            </section>
            
        </div>
        <footer>
                <div id="gray_block">
                    <div class="inner">
                        <nav id="menu_footer">
                            <ul>
                                <li><a href="{{ URL::action( 'HomeController@about' ) }}">{{ Lang::get('labels.label-about') }}</a></li>
                                <li><a href="{{ URL::action( 'HomeController@tips' ) }}">{{ Lang::get('labels.label-tips') }}</a></li>
                                <li><a href="{{ URL::route('testimonials.index') }}">{{ Lang::get('labels.label-testimonials') }}</a></li>
                                <li><a href="{{ URL::action( 'HomeController@contact' ) }}">{{ Lang::get('labels.label-contact') }}</a></li>
                            </ul>
                        </nav>

                        
                    </div>
                </div>
                <div id="copyright">
                    <div class="inner">
                        <div id="info">
                            <address>
                                    <a href="mailto:info@rentameliberia.com">
                                    info@rentameliberia.com</a> -
                                    Tel: (506) 2666-4000
                              
                            </address>
                        </div>
                        <div id="redes">
                            <ul>
                                <li><a id="facebook" href="https://www.facebook.com/RentameLiberia" title="Facebook" ><span class="icon-facebook" ></span></a></li>
                                <li><a id="twitter" href="#"><span class="icon-twitter" title="Twitter" ></span></a></li>
                                <li><a id="youtube" href="#"><span class="icon-youtube" title="Youtube" ></span></a></li>
                            </ul>
                        </div>
                        <a class="copy" href="http://www.avotz.com" target="_blank">Copyright &copy; 2014 | Avotz</a>
                        <div id="idiomas">
                            <label>
                                <select name="idioma" id="idioma">
                                    @if (Session::get('user_lang') == "es" )
                                     <option value="es" selected >Español</option>
                                     <option value="en">Ingles</option>
                                     @endif
                                      @if (Session::get('user_lang') == "en" )
                                     <option value="en" selected >Ingles</option>
                                     <option value="es">Español</option>
                                     @endif
                                    
                                </select>
                               
                            </label>
                            
                            <span class="icon-play"></span>
                        </div>
                        
                    </div>
                </div>
            </footer>
 
    

        <script src="/js/vendor/jquery-1.10.1.min.js"></script>
        <script src="/js/vendor/rotate3Di/jquery-css-transform/jquery-css-transform.js" type="text/javascript"></script> 
        <script src="/js/vendor/rotate3Di/rotate3Di.js" type="text/javascript"></script> 
        <script src="/js/vendor/jquery.validate.min.js" type="text/javascript"></script>  
        <script src="/js/vendor/jquery.cycle2.min.js"></script>
        <script src="/js/vendor/jquery.imagesloaded.min.js"></script>
        
        
        <script src="/js/main.js"></script>
        
        
        <script>
            
            
            var _gaq=[['_setAccount','UA-33163227-1'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
</body>
</html>
