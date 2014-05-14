@extends('admin._layouts.default')
 
@section('main')
 
    <h2>Create new property</h2>

    {{ Notification::showAll() }}
     @if ($errors->any())

        <div class="alert alert-danger">
                 <ul>
                  @foreach( $errors->all() as $message )
                    <li>{{ $message }}</li>
                  @endforeach
                </ul>
        </div>
      @endif
    {{ Form::open(array('route' => 'admin.properties.store','files' => true)) }}
 
        <div class="panel panel_main well well-large">
            <div class="column column1">
            <div class="form-group">

                {{ Form::label('categories', 'Categories') }}
                <div class="controls">
                    {{ Form::select('categories[]', $options, null , array('multiple' => 'multiple', 'class' => 'form-control')) }}
                </div>
            </div>
            <div class="form-group">

                {{ Form::label('type', 'Type') }}
                <div class="controls">
                    {{ Form::select('type', array('apartment' =>  Lang::get('labels.label-apartment') , 'house' => Lang::get('labels.label-house'),'comercial' => Lang::get('labels.label-comercial'),'lote' => Lang::get('labels.label-lote'),'project' => Lang::get('labels.label-project')),null,array('class'=>'form-control') ) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('code', 'Code') }}
                <div class="controls">
                    {{ Form::text('code', null,array('class'=>'form-control')) }}

                </div>
            </div>
     
            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                <div class="controls">
                    {{ Form::text('title',null,array('class'=>'form-control')) }}
                </div>
            </div>
             <div class="form-group">
                {{ Form::label('description', 'Description') }}
                <div class="controls">
                    {{ Form::textarea('description',null,array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('furniture', 'Furnished') }}
                <div class="controls">
                    {{ Form::select('furniture', array( '0' => 'No','1' => 'Yes'), null, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('bedrooms', 'Bedrooms') }}
                <div class="controls">
                    {{ Form::text('bedrooms',null,array('class'=>'form-control')) }}
                </div>
            </div>

            
        </div>
            <div class="column column2">
                <div class="form-group">
                {{ Form::label('priced', 'Price $') }}
                <div class="controls">
                    {{ Form::text('priced',null,array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('pricec', 'Price €') }}
                <div class="controls">
                    {{ Form::text('pricec',null,array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('location', 'Location') }}
                <div class="controls">
                    {{ Form::text('location',null,array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('city', 'City') }}
                <div class="controls">
                    {{ Form::text('city',null,array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('area', 'Area') }}
                <div class="controls">
                    {{ Form::text('area',null,array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('contact', 'Contact') }}
                <div class="controls">
                    {{ Form::text('contact', null, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('featured', 'Featured') }}
                <div class="controls">
                    {{ Form::select('featured', array( '0' => 'No','1' => 'Yes'), null, array('class'=>'form-control')) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('publish', 'State') }}
                <div class="controls">
                    {{ Form::select('publish', array('1' => 'Publish', '0' => 'Unpublish'), null,array('class'=>'form-control')) }}
                </div>
            </div>
        </div>
        </div>
        <div class="panel panel_right well well-large">
            <div class="form-group">
            <fieldset>
                <legend>Main image</legend>
                 <div class="main_image">
                    <img src="/img/no-image.png" alt="No Image">
                    <div class="controls">
                        {{ Form::file('image') }}
                    </div>
                </div>
            </fieldset>
            </div>
            <fieldset>
            <legend>Gallery</legend>
            <div id="items">
            
             
            <input class="inputbox btn btn-info" type="button" name="new_photo"  value="Nueva Foto"  ID="add"/><i class="icon-plus-sign"></i>
            
            </div>
            </fieldset>
        </div>
        
       
        <div class="well">
            {{ Form::submit('Save', array('class' => 'btn btn-success btn-save btn-large')) }}
            <a href="{{ URL::route('admin.properties.index') }}" class="btn btn-default ">Cancel</a>
        </div>
 
    {{ Form::close() }}
 
@stop