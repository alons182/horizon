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
      
       
             {{ Form::open(array('url' => 'newpassword','method' => 'post')) }}
           
            <div class="control-group">
                {{ Form::label('email_newp', 'Email') }}
                <div class="controls">
                    {{ Form::email('email_newp') }}
                </div>
            </div>
            <div class="control-group">
                {{ Form::label('code', Lang::get('labels.label-reset-code')) }}
                <div class="controls">
                    {{ Form::text('code') }}
                </div>
            </div>
            <div class="control-group">
                {{ Form::label('password', Lang::get('labels.label-new-password') ) }}
                <div class="controls">
                    {{ Form::password('password') }}
                </div>
            </div>
 
            
 
            <div class="form-actions">
                {{ Form::submit('Reset', array('class' => 'btn btn-primary')) }}
            </div>
            <div class="links-index">
                     <a href="{{ URL::route('register') }}">Register</a>
                    <a href="{{ URL::route('login') }}">Login</a>
                </div>
 
        {{ Form::close() }}
       
       
    
    </div>
   
  
   
    
</div>
   
 
@stop
