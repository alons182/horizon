@extends('_layouts.default')
 
@section('main')
     <div class="inner">
       
        <div  class="login-index">
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
                    {{ Form::submit( Lang::get('labels.label-login') , array('class' => 'btn btn-primary')) }}
                </div>
                <div class="links-index">
                     <a href="{{ URL::route('reset') }}">{{ Lang::get('labels.label-forget-pass') }}</a>
                    <a href="{{ URL::route('register') }}">{{ Lang::get('labels.label-register') }}</a>
                </div>
     
            {{ Form::close() }}
        </div>
        
    </div>
    
 
@stop
