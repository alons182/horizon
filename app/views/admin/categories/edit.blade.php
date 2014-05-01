@extends('admin._layouts.details')
 
@section('main')
    
    <h2>Edit category <a href="{{ URL::route('admin.categories.create') }}" class="btn btn-success"><i class="icon-plus-2"></i> Add new category</a></h2>
    {{ 
       Notification::showAll() }}
        @if ($errors->any())

        <div class="alert alert-danger">
                 <ul>
                  @foreach( $errors->all() as $message )
                    <li>{{ $message }}</li>
                  @endforeach
                </ul>
        </div>
      @endif
    {{ Form::model($category, array('method' => 'put', 'route' => array('admin.categories.update', $category->id))) }}
        
       <div class="panel panel_main well well-large">
            <div class="column column1">
               <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    <div class="controls">
                        {{ Form::text('name',null,array('class'=>'form-control')) }}

                    </div>
                </div>
         
                <div class="form-group">
                    {{ Form::label('description', 'Description') }}
                    <div class="controls">
                        {{ Form::textarea('description',null,array('class'=>'form-control')) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('publish', 'Publish') }}
                    <div class="controls">
                        {{ Form::select('publish', array('1' => 'Publish', '0' => 'Unpublish'), $category->publish,array('class'=>'form-control')) }}
                    </div>
                </div>
            </div>
        </div>
        {{ Form::hidden('category_id', $category->id) }}
        <div class="well">
            {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
            <a href="{{ URL::route('admin.categories.index') }}" class="btn btn-default ">Cancel</a>
        </div>
 
    {{ Form::close() }}
 
@stop