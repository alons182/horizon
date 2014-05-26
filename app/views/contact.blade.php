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
         <div class="info-contact" style="background:#FFF; padding: .5em;">
           <p>{{ Lang::get('labels.title-contact') }}</p>
          <ul>
           <li>Adrián Sibaja: <strong> 8386-5206 </strong> </li>
           <li>Benoit Guigni: <strong>8474-5156 </strong></li>
           <li>Rigoberto guerrero: <strong>8882-7202</strong> </li>
           <li>Carlos Jiménez:<strong> 8471-1844.</strong> </li>
           <li>Office: <strong>2667-1000 </strong>  </li>
         </ul>
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
