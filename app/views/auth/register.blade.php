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
            <div class="control-group">
                    {{ Form::label('first_name',  Lang::get('labels.label-form-name') ) }}
                    <div class="controls">
                        {{ Form::text('first_name') }}

                    </div>
                </div>
         
                <div class="control-group">
                    {{ Form::label('last_name',  Lang::get('labels.label-form-last-name') ) }}
                    <div class="controls">
                        {{ Form::text('last_name') }}
                    </div>
                </div>
 
            <div class="form-actions">
                {{ Form::submit( Lang::get('labels.label-register'), array('class' => 'btn btn-primary')) }}
            </div>
 
        {{ Form::close() }}
    </div>
  
   
    
</div>
   
 
@stop
