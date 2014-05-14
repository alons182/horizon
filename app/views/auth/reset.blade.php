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
      
       
             {{ Form::open(array('url' => 'reset','method' => 'post')) }}
           
            <div class="control-group">
                {{ Form::label('email_reset', 'Email') }}
                <div class="controls">
                    {{ Form::email('email_reset') }}
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
