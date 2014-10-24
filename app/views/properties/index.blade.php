@extends('_layouts.list')
 
@section('main')

<ul class="items">

 @foreach ($properties as $property)

                    <li class="item">
                         
                        <div class="item-description">
                            <span class="code">{{ $property->code }}</span>
                            <a href="{{ URL::route('properties.show', $property->id) }}">
                                <h3>{{ $property->title }}</h3>
                                <p>{{ $property->location }}</p>
                                
                            </a>
                        </div>
                        <div class="item-action">
                            <div class="price">
                                <div class="dolar">
                                    $<?php echo number_format($property->priced, 0, ".", ","); ?>
                                    
                                </div>
                                <div class="colon">
                                     @if ($property->pricec)   
                                        &euro;<?php echo number_format($property->pricec, 0, ".", ","); ?>
                                     @endif
                                </div>
                            </div>
                           <a class="icon-facebook" href="#" 
                              onclick="
                                window.open(
                                  'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent({{Request::url().'/'.$property->id }}), 
                                  'facebook-share-dialog', 
                                  'width=626,height=436'); 
                                return false;">
                              
                            </a>
                            
                            
                            <a class="icon-twitter" href="https://twitter.com/share?url={{Request::url().'/'.$property->id }}" target="_blank"></a>
                            
                            <?php 
                            $user = Sentry::getUser();
                              
                            ?>
                            @if ($logueado &&  count($property->users))    
                            <a id="pro-{{ $property->id }}" data-proid="{{ $property->id }}" data-login="register" class="icon-heart2 btn_favorites_mini " href="#"  title="Esta en tus favoritos" ></a>
                            @else
                                @if ($logueado)
                                    <a id="pro-{{ $property->id }}" data-proid="{{ $property->id }}" data-login="register" class="icon-heart btn_favorites_mini" href="#"  title="No esta en tus favoritos" ></a>
                                @else
                                    <a id="pro-{{ $property->id }}" data-proid="{{ $property->id }}" data-login="guest" class="icon-heart heart-gray btn_favorites_mini" href="#"  title="inicia Sesion" ></a>
                                @endif
                            @endif
                            
                            
                        </div>
                       
                        <a href="{{ URL::route('properties.show', $property->id, $properties) }}">
                            <div class="item-imagen">
                                @if ($property->image)
                                     <img src="/images_properties/<?php echo $property->image; ?>" data-original="img/propiedad.jpg"  alt="{{ ($property->tags == "") ? $property->title : $property->tags }}" class="lazy" width="356" height="274" />
                                @else
                                   <img src="/img/no-image2.jpg" alt="No Image" width="356" height="274" />
                                @endif

                            </div>
                        </a>

                    </li>

                   

                    
                   
  @endforeach
</ul>
  

{{$properties->appends(array('q' => $search,'cat'=>$selected,'code'=>$code,'priced'=>$priced,'priceh'=>$priceh,'bedrooms'=>$bedrooms,'type'=>$type,'furniture'=>$furniture))->links()}}
@stop