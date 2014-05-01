@extends('admin._layouts.default')
 
@section('main')
     <div class="inner">
        <div id="login" class="login-index">
            <div id="message">
            {{ Notification::showAll() }}
                            
            </div>
            @if ($errors->has('login'))
                        
            <div class="alert alert-error">{{ $errors->first('login', ':message') }}</div>
                       
                       
            @endif
            {{ Form::open() }}
               
     
                <div class="control-group">
                    {{ Form::label('email', 'Email') }}
                    <div class="controls">
                        {{ Form::email('email') }}
                    </div>
                </div>
     
                <div class="control-group">
                    {{ Form::label('password', 'Password') }}
                    <div class="controls">
                        {{ Form::password('password') }}
                    </div>
                </div>
     
                <div class="form-actions">
                    {{ Form::submit('Login') }}
                </div>
             <div class="links-index">
                     <a href="#">Olvido su contraseña?</a>
                    
                </div>
            {{ Form::close() }}
        </div>
    </div>
    
 
@stop
