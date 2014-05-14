@extends('_layouts.default')
 
@section('main')
  <div class="inner">
    
    
    <div  class="login-index">
        <div id="message">
        {{ Notification::showAll() }}
                        
        </div>  
         @if ($errors->has('register'))
                   
                       
         <div class="alert alert-error">{{ $errors->first('register', ':message') }}</div>
                   

        @endif 
      
       
             {{ Form::open(array('url' => 'activation','method' => 'post')) }}
           
            <div class="control-group">
                {{ Form::label('email_actv', 'Email') }}
                <div class="controls">
                    {{ Form::email('email_actv') }}
                </div>
            </div>
            <div class="control-group">
                {{ Form::label('code', Lang::get('labels.label-activation-code')) }}
                <div class="controls">
                    {{ Form::text('code') }}
                </div>
            </div>
 
            
 
            <div class="form-actions">
                {{ Form::submit('Activate', array('class' => 'btn btn-primary')) }}
            </div>
            <div class="links-index">
                     <a href="{{ URL::route('register') }}">Register</a>
                    <a href="{{ URL::route('login') }}">Login</a>
                </div>
 
        {{ Form::close() }}
       
       
    
    </div>
   
  
   
    
</div>
   
 
@stop
