@extends('_layouts.list')

@section('meta-title')
Find beach houses, houses, investment opportunities, or properties to retire | {{ $property->title }}
@stop
@section('meta-description')
{{ str_limit(strip_tags($property->description), 150) }}
@stop
 
@section('main')

<div class="right-panel-properties">
    <div class="show-properties-related">
        <span>{{ Lang::get('labels.label-see-more') }}</span>
    </div>
    <div class="panel-scroll">
   @foreach ($properties_search as $property_search)
     @if ($property_search->id <> $property->id )
    
        <div class="right-panel-item">
            <div class="right-panel-item-imagen">
                <a href="{{ URL::route('properties.show', $property_search->id) }}">
                     @if ($property_search->image)
                       <img src="/images_properties/thumb_<?php echo $property_search->image; ?>" data-original="img/main_propiedad.jpg" class="lazy" alt="{{ ($property_search->tags == "") ? $property_search->title : $property_search->tags }}" width="140" height="100" />
                    @else
                       <img src="/img/no-image2.jpg" alt="No Image" width="140" height="100">
                    @endif

                </a>
                
            </div>
            <div class="right-panel-item-details">
               <a href="{{ URL::route('properties.show', $property_search->id) }}">
                    <span>{{ $property_search->title }}</span>
                    <span>{{ $property_search->location }}</span>
               </a>
            </div>

        </div>
    
    
     @endif
     @endforeach
     </div>

</div>
 <div class="inner">
                    <div class="item-details">

                        <div class="item-title">
                            <div class="title">
                                <span class="code">{{ $property->code }}</span>
                            
                                <h1>{{ $property->title }}</h1>
                                
                            </div>
                            
                                
                           
                        </div>
                        <div class="item-main-imagen">
                            @if ($property->image)
                               <img src="/images_properties/<?php echo $property->image; ?>" data-original="img/main_propiedad.jpg" class="lazy" alt="{{ ($property->tags == "") ? $property->title : $property->tags }}" width="600" height="450" />
                            @else
                               <img src="/img/no-image2.jpg" alt="No Image" width="600" height="450">
                            @endif
                            
                             @if ($property->image)
                                <a class="btn btn-celeste" href="/images_properties/<?php echo $property->image; ?>" data-lightbox="gallery">{{ Lang::get('labels.label-see-gallery') }}</a>
                             @else
                                <a class="btn btn-celeste" href="/img/no-image2.jpg" data-lightbox="gallery">{{ Lang::get('labels.label-see-gallery') }}</a>
                             @endif

                           
                           
                            <ul>
                                @foreach ($property->gallery as $image)
                                <li><a href="/images_properties/{{ $image->url }}" data-lightbox="gallery"></a></li>
                                @endforeach
                            </ul>
                            
                        </div>
                        <div class="item-main-description">
                            {{ $property->description }}
                        </div>
                    </div>
                    <div  class="side-panel">
                        <div class="precios">
                            <h2>$<?php echo number_format($property->priced, 0, ".", ","); ?></h2>
                            <!-- <h3> @if ($property->pricec)   
                                        &euro;<?php/* echo number_format($property->pricec, 0, ".", ","); */?>
                                      @endif</h3> -->

                        </div>
                        <div class="redes">
                            <h2>{{ Lang::get('labels.label-share') }}</h2>
                            
                            <a class="icon-facebook" title="Facebook" href="#" 
                              onclick="
                                window.open(
                                  'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
                                  'facebook-share-dialog', 
                                  'width=626,height=436'); 
                                return false;">
                              
                            </a>
                            
                            
                            <a class="icon-twitter" title="Twitter" href="https://twitter.com/share?url={{Request::url()}}" target="_blank"></a>
                            <!--<a class="icon-envelop"href="#"></a>-->
                            <a id="btn_print" href="#" onclick="window.print();return false;" title="Imprimir"><span class="icon-print"></span></a>
                        </div>
                        <div class="favoritos">
                            
                            @if ($favorite && $logueado)
                            <h2>Eliminar de tus favoritos</h2>
                                <a class="icon-heart2 btn_favorites" data-login="register" href="#"></a>
                            @else
                                 
                                  <h2>{{ Lang::get('labels.label-favorites') }}</h2>
                                 @if ($logueado)
                                   
                                    <a class="icon-heart btn_favorites" data-login="register" href="#"></a>
                                    @else
                                    <a class="icon-heart heart-gray btn_favorites" data-login="guest" href="#"></a>
                                    @endif
                            @endif
                            <div id="message-favorites">
                            </div>
                           
                        </div>
                        <div class="ubicacion">
                            <h2>Info</h2>
                            <address>
                                    Direccion : {{ $property->location }} <br />
                                    Ciudad : {{ $property->city }}<br />
                                    Area: {{ $property->area }}<br />
                                    Contactos : {{ $property->contact }}<br />
                             
                            </address>
                        </div>
                        <div class="form-solicitud">
                            <h2>{{ Lang::get('labels.label-request-rent') }}</h2>
                            <form id="RequestForm">
                                <label for="name">{{ Lang::get('labels.label-form-name') }}</label><br />
                                <input type="text" name="name" id="name" required /><br />
                                <label for="email">{{ Lang::get('labels.label-form-email') }}</label><br />
                                <input type="email" name="email" id="email" required /><br />
                                <label for="phone">{{ Lang::get('labels.label-form-phone') }}</label><br />
                                <input type="text" name="phone" id="phone" /><br />
                                <label for="comments">{{ Lang::get('labels.label-form-comment') }}</label><br />
                                <textarea name="comments" id="comments" cols="30" rows="3"></textarea><br />
                                <input type="submit" id="btnEnviar" value="{{ Lang::get('labels.label-send') }}"/>
                                <p class="mensaje"></p>
                                <input type="hidden" name="property_id" id="property_id" value="{{ $property->id }}" />
                            </form>
                            
                            
                        </div>

                    </div>
                </div>
@stop