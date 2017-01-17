@extends('_layouts.default')
 
@section('main')
 
    <div class="inner">
    <div id="message">
        {{ Notification::showAll() }}



     
       @if ($errors->any())

        <div class="alert alert-error">
                 <ul>
                  @foreach( $errors->all() as $message )
                    <li>{{ $message }}</li>
                  @endforeach
                </ul>
        </div>
      @endif

    


    </div>  

      <div id="formulario-contact">
         <div class="info-contact" style="background:#FFF; padding: .5em; position:relative;">
           <p>{{ Lang::get('labels.title-contact') }}</p>
          <ul>
                      
          <li>Domenico Musolino : <strong>8303-8553</strong></li>
         
          <li><strong> info@compramecr.com</strong></li>
           
         </ul>
         <div class="sellOrRent">
           <strong>Please Contact Us if you need to sell your property</strong>
         </div>
         </div>
         
        	 {{ Form::open(array('url' => 'homes','method' => 'post','id' =>'ContactForm')) }}
        		<div class="form-group">
                        <div class="controls">
                           <h3>{{ Lang::get('labels.label-form-name') }}</h3>
                            {{ Form::text('name') }}
                        </div>
                        <div class="controls">
                           <h3>{{ Lang::get('labels.label-form-email') }}</h3>
                            {{ Form::email('email') }}
                        </div>
                        <div class="controls">
                            <h3>{{ Lang::get('labels.label-form-comment') }}</h3>
                            {{ Form::textarea('comments') }}
                        </div>
                   
                       <div class="buttons">
                        {{ Form::submit( Lang::get('labels.label-send') , array('class' => 'btn btn-success btn-save btn-large')) }}
                		<a href="#" class="btn btn-large link-testimonial">{{ Lang::get('labels.label-cancel') }}</a>
                       </div>
                 </div>  
                
        	 {{ Form::close() }}
        </div>
           
    </div>
 
@stop
