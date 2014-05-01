@extends('admin._layouts.default')
 
@section('main')
 
    <h2>Create new Users</h2>

    {{ Notification::showAll() }}
    @if ($errors->has('register'))
        <div class="alert alert-danger">{{ $errors->first('register', ':message') }}</div>
    @endif
    {{ Form::open(array('route' => 'admin.users.store')) }}
 
         <div class="panel panel_main well well-large">
            <div class="column column1">

                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    <div class="controls">
                        {{ Form::email('email',null,array('class'=>'form-control')) }}
                    </div>
                </div>
     
                <div class="form-group">
                    {{ Form::label('password', 'Password') }}
                    <div class="controls">
                        {{ Form::password('password',array('class'=>'form-control')) }}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('first_name', 'First Name') }}
                    <div class="controls">
                        {{ Form::text('first_name',null,array('class'=>'form-control')) }}

                    </div>
                </div>
         
                <div class="form-group">
                    {{ Form::label('last_name', 'Last Name') }}
                    <div class="controls">
                        {{ Form::text('last_name',null,array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">

                {{ Form::label('groups', 'Group') }}
                <div class="controls">
                    <select name="groups" id="groups" class="form-control">
                         @foreach ($options as $option)
                            <option value="{{$option->id}}">{{$option->name}}</option>

                          @endforeach          
                    </select>
                    
                </div>
            </div>
               
            </div>
        </div>
         
        <div class="well">
            {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
            <a href="{{ URL::route('admin.users.index') }}" class="btn btn-default ">Cancel</a>
        </div>
 
    {{ Form::close() }}
 
@stop