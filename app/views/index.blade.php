@extends('_layouts.default')
 
@section('main')
    
   
    <div class="inner">
                    
        
            
                
                <div id="main-site" class="slide_1 slide" >
                    
                    <div id="middle">
                        <div id="destacadas">
                            <h3>{{ Lang::get('labels.label-featured-properties') }}</h3>
                            <ul>
                            @foreach ($properties as $property)

                                <li><a href="{{ URL::route('properties.show', $property->id) }}">
                                    <span class="img_p">
                                     @if ($property->image)
                                      <img src="/images_properties/thumb_{{$property->image}}" alt="property"/>
                                    @else
                                       <img src="/img/thumb_no-image2.jpg" alt="No Image"  />
                                    @endif


                                    </span><span class="nombre">{{$property->title}}</span></a></li>
                                
                             @endforeach

                            </ul>
                        </div>
                        
                    </div>
                    <div id="buscador" class="slide_2 slide" >
                    
                    {{ Form::open(array('url' => 'properties','method' => 'get')) }}
                        <input type="hidden" id="cat" name="cat" value="1" />
                        
                        <div id="advanced">
                            <div class="column column-1">
                                <h3>{{ Lang::get('labels.label-code-property') }}</h3>
                                 {{ Form::text('code') }}
                                <h3>{{ Lang::get('labels.label-range-price') }}</h3>
                                <div class="styled-select-precios">
                                    <select name="priced" id="priced" >
                                        <option value="">{{ Lang::get('labels.label-from') }}</option>
                                        <option value="50000">$50,000</option>
                                        <option value="100000">$100,000</option>
                                        <option value="150000">$150,000</option>
                                        <option value="200000">$200,000</option>
                                         <option value="250000">$250,000</option>
                                         <option value="300000">$300,000</option>
                                         <option value="400000">$400,000</option>
                                         <option value="500000">$500,000</option>
                                    </select>
                                </div>
                                <div class="styled-select-precios">
                                    <select name="priceh" id="priceh" >
                                        <option value="">{{ Lang::get('labels.label-to') }}</option>
                                        <option value="100000">$100,000</option>
                                        <option value="150000">$150,000</option>
                                        <option value="200000">$200,000</option>
                                         <option value="250000">$250,000</option>
                                         <option value="300000">$300,000</option>
                                         <option value="400000">$400,000</option>
                                         <option value="500000">$500,000</option>
                                         <option value="10000000">+ $500,000</option>
                                    </select>
                                </div>
                                <h3>{{ Lang::get('labels.label-bedrooms') }}</h3>
                                    <div class="styled-select-tipopropiedad">

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
                            </div>
                            <div class="column column-2">
                                <h3>{{ Lang::get('labels.label-type-property') }}</h3>
                                <div class="styled-select-tipopropiedad">
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
                                        <select name="furniture" id="furniture" >
                                            <option value="">--</option>
                                            <option value="1">{{ Lang::get('labels.label-yes') }}</option>
                                            <option value="0">{{ Lang::get('labels.label-no') }}</option>
                                        </select>
                                    </div>
                                
                                
                               
                                    
                                
                            </div>
                            
                            
                        </div>

                        <div id="basic">
                            <p class="leyenda-buscador">{{ Lang::get('labels.title-search') }}</p>
                            <span class="lupa icon-search"></span>
                             {{ Form::text('q') }}
                            
                             {{ Form::submit(Lang::get('labels.label-search'), array('class' => 'btn')) }}
                        </div>
                       
                        
                         
                   {{ Form::close() }}
                    
                </div>
                    
                    <div id="bottom">
                        <div class="cycle-slideshow" data-cycle-slides=".slide">
                              @foreach ($testimonials as $testimonial)
                             <div class="slide opinion " >
                                <blockquote class="comments">
                                    <p></p>
                                    {{ $testimonial->comments }}
                                    <p></p>
                                     
                                </blockquote>    
                               <div class="date">
                                    {{ $testimonial->created_at }}
                                </div>
                                <div class="author">
                                     {{ $testimonial->name }} 
                                </div>
                                
                              
                            </div>
                             @endforeach

                            
                       
                        </div>
                       
                    </div>
                    
                </div>
                

            
        
    </div>

     
@stop
