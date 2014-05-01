@extends('admin._layouts.details')
 
@section('main')
    
    <h2>Edit user <a href="{{ URL::route('admin.users.create') }}" class="btn btn-success"><i class="icon-plus-2"></i> Add new user</a></h2>
    {{ 
       Notification::showAll() }}
       @if ($errors->has('register'))
        <div class="alert alert-danger">{{ $errors->first('register', ':message') }}</div>
    @endif
    {{ Form::model($user, array('method' => 'put', 'route' => array('admin.users.update', $user->id))) }}
        
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
                        {{ Form::text('first_name', null,array('class'=>'form-control')) }}

                    </div>
                </div>
         
                <div class="form-group">
                    {{ Form::label('last_name', 'Last Name') }}
                    <div class="controls">
                        {{ Form::text('last_name',null, array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">

                {{ Form::label('groups', 'Group') }}
                <div class="controls">
                    <select name="groups" id="groups" class="form-control" >
                         @foreach ($options as $option)
                            @foreach ($user->getGroups() as $group)
                               
                               @if ($option->id ==  $group->id)
                               <option selected value="{{$option->id}}">{{$option->name}}</option>
                              
                                @else
                                     <option value="{{$option->id}}">{{$option->name}}</option>
                                @endif    
                               
                               
                         @endforeach
                            
                          @endforeach          
                    </select>
                    
                </div>
            </div>
        </div>
    </div>
        {{ Form::hidden('user_id', $user->id) }}
        <div class="well">
            {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
            <a href="{{ URL::route('admin.users.index') }}" class="btn btn-default ">Cancel</a>
        </div>
 
    {{ Form::close() }}
 
@stop