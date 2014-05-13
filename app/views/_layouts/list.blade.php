<!doctype html>
<html lang="{{ Session::get('user_lang') }}">
<head>
    <meta charset="utf-8">
    <title>Horizon Properties</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ URL::asset('/css/normalize.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('/css/print.css') }}" type="text/css" media="print" />
    <link rel="icon" type="image/png" href="{{ URL::asset('/img/favicon_horizon_16x16.ico') }}">
    <link href="{{ URL::asset('/js/vendor/lightbox/css/lightbox.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('/js/vendor/modernizr-2.6.2.min.js') }}"></script>

</head>
<body>
<div class="wrap">
            

            <header>
                <div id="buscador-mini">
                    <a class="link-search btn btn-celeste" href="#"><span class="icon-search"></span><span class="text-search">{{ Lang::get('labels.label-searcher') }}</span></a>
                    <div id="container-search">
                    {{ Form::open(array('url' => 'properties','method' => 'get','id' =>'search_mini')) }}
                        
                         <input type="hidden" id="cat" name="cat" value="1" />
                        <!--<fieldset>
                            <input type="radio" name="cat" value="1" class="radio" id="alquiler" checked />
                            {{ Form::label('alquiler', 'Alquiler') }}
                            
                            <input type="radio" name="cat" value="2" class="radio" id="compra" />
                            {{ Form::label('compra', 'Compra') }}
                        </fieldset>-->
                        




                        <h3>{{ Lang::get('labels.label-search-term') }}</h3>
                        <span class="lupa icon-search"></span>
                             {{ Form::text('q') }}
                            
                            
                       <h3>{{ Lang::get('labels.label-code-property') }}</h3>
                             {{ Form::text('code') }}
                            <h3>{{ Lang::get('labels.label-range-price') }}</h3>
                            <div class="styled-select-precios">
                                <span class="arrow-select"></span>
                                <select name="priced" id="priced" >
                                    <option value="">{{ Lang::get('labels.label-from') }}</option>
                                   <option value="100">$100</option>
                                        <option value="400">$400</option>
                                        <option value="500">$500</option>
                                        <option value="600">$600</option>
                                         <option value="700">$700</option>
                                         <option value="800">$800</option>
                                         <option value="900">$900</option>
                                         <option value="1000">$1000</option>
                                </select>
                            </div>
                            <div class="styled-select-precios">
                                 <span class="arrow-select"></span>
                                <select name="priceh" id="priceh" >
                                    <option value="">{{ Lang::get('labels.label-to') }}</option>
                                    <option value="400">$400</option>
                                        <option value="500">$500</option>
                                        <option value="600">$600</option>
                                         <option value="700">$700</option>
                                         <option value="800">$800</option>
                                         <option value="900">$900</option>
                                         <option value="1000">$1000</option>
                                         <option value="1000000">+ $1000</option>
                                </select>
                            </div>
                            <h3>{{ Lang::get('labels.label-type-property') }}</h3>
                            <div class="styled-select-tipopropiedad">
                                 <span class="arrow-select"></span>
                                <select name="type" id="type">
                                    <option value="">{{ Lang::get('labels.label-all') }}</option>
                                    <option value="apartment">{{ Lang::get('labels.label-apartment') }}</option>
                                    <option value="house">{{ Lang::get('labels.label-house') }}</option>
                                    <option value="commercial">{{ Lang::get('labels.label-comercial') }}</option>
                                    <option value="lote">{{ Lang::get('labels.label-lote') }}</option>
                                    <option value="project">{{ Lang::get('labels.label-project') }}</option>
                                </select>
                            </div>
                            <h3>{{ Lang::get('labels.label-furniture') }}</h3>
                            <div class="styled-select-tipopropiedad">
                                <span class="arrow-select"></span>
                                <select name="furniture" id="furniture" >
                                    <option value="">--</option>
                                    <option value="1">{{ Lang::get('labels.label-yes') }}</option>
                                    <option value="0">{{ Lang::get('labels.label-no') }}</option>
                                </select>
                            </div>
                        
                        
                       
                            <h3>{{ Lang::get('labels.label-bedrooms') }}</h3>
                            <div class="styled-select-tipopropiedad">
                                <span class="arrow-select"></span>
                                <select name="bedrooms" id="bedrooms" >
                                    <option value="">--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                </select>
                            </div>
                            <div class="buttons">
                             {{ Form::submit(Lang::get('labels.label-search') , array('class' => 'btn2')) }}
                             <a href="#" class="link-search">{{ Lang::get('labels.label-cancel') }}</a>
                         </div>
                         
                   {{ Form::close() }}
                    </div>
                </div>
                <div class="inner">
                    <div id="logo"><a href="/"><img src="/img/logo.png" alt="Horizon" /></a></div>
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
                                     {{ Form::submit(Lang::get('labels.label-login') , array('class' => 'btn2')) }}
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
                                    <a href="mailto:info@horizoncostarica.com">
                                    info@horizoncostarica.com</a> -
                                    Tel: (506) 2667-1000
                              
                            </address>
                        </div>
                        <div id="redes">
                            <ul>
                                <li><a id="facebook" href="https://www.facebook.com/horizoncostarica" title="Facebook" target="_blank"><span class="icon-facebook" ></span></a></li>
                                <li><a id="twitter" href="#"><span class="icon-twitter" title="Twitter" target="_blank"></span></a></li>
                                <li><a id="youtube" href="#"><span class="icon-youtube" title="Youtube" target="_blank"></span></a></li>
                            </ul>
                        </div>
                        <a class="copy" href="http://www.avotz.com" target="_blank">Copyright &copy; 2014 | Avotz</a>
                        <!--<div id="idiomas">
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
                        </div>-->
                        
                    </div>
                </div>
            </footer>
 
    

        <script src="/js/vendor/jquery-1.10.1.min.js"></script>
        <script src="/js/vendor/rotate3Di/jquery-css-transform/jquery-css-transform.js" type="text/javascript"></script> 
        <script src="/js/vendor/rotate3Di/rotate3Di.js" type="text/javascript"></script>
        <script src="/js/vendor/lightbox/js/lightbox-2.6.min.js" type="text/javascript"></script>
        <script src="/js/vendor/jquery.validate.min.js" type="text/javascript"></script>
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
