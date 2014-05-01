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
         <p>{{ Lang::get('labels.title-contact') }}</p>
          <ul>
            <li>Carlos Luis Jiménez: <strong> 8471-1844 </strong> </li>
           <li>Diana González: <strong>8973-5543 </strong></li>
           <li>Luis Fernando Alfaro: <strong>6066-8928</strong> </li>
           <li>David Castro:<strong> 8569-5795</strong> </li>
           <li>Cel oficina: <strong>6066-8920 </strong>  </li>
         </ul>
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
