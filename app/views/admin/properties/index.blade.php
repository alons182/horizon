@extends('admin._layouts.default')
 
@section('main')

    <div class="well well-large actions">
       <div class="title">
            <h1>
            Properties <a href="{{ URL::route('admin.properties.create') }}" class="btn btn-success"><i class="icon-plus-2"></i> Add new property</a>
            </h1>
        </div>
        
        <div class="filtros">
           
           
            {{ Form::open(array('url' => 'admin/properties','method' => 'get')) }}
               <div class="form-group">
                    <div class="controls">
                        {{ Form::label('q', 'Search') }}
                        {{ Form::text('q',$search,array('class'=>'form-control')) }}
                    </div>
               
                    <div class="controls">
                        {{ Form::label('cat', 'Categories') }}
                        {{ Form::select('cat', array('' => '-- Select --') + $options, $selected, array('class'=>'form-control') ) }}
                    </div>
                     <div class="controls">
                        {{ Form::label('status', 'State') }}
                        {{ Form::select('status', array('' => '-- Select --','0' => 'Unpublished','1' => 'Published'), $selectedStatus, array('class'=>'form-control') ) }}
                    </div>
                    
             </div>  
            {{ Form::close() }}

        </div>
    </div> 
    
     {{ Notification::showAll() }}
    <hr>
    <div class="table-responsive">
        <table class="table table-striped  ">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Title</th>
                <th>Location</th>
                <th>Price</th>
                <th>Category</th>
                <th>When</th>
                <th>Status</th>
                <th><i class="icon-cog"></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
                <tr>
                    <td>{{ $property->id }}</td>
                    <td>{{ $property->code }}</td>
                    <td><a href="{{ URL::route('admin.properties.edit', $property->id) }}">{{ $property->title }}</a></td>
                    <td>{{ $property->location }}</td>
                    <td>{{ $property->priced }}</td>
                    <td>{{ $property->categories->first()->name }}</td>
                    <td>{{ $property->created_at }}</td>
                    <td>
                                             
                       

                         {{ Form::open(array('route' => array('admin.properties.update', $property->id),'method' => 'put')) }}
                            
                            @if ($property->publish == 1) 
                            <button type="submit"  class="btn  btn-xs active" ><i class="icon-publish"></i></button>
                             @else 
                             <button type="submit"  class="btn btn-xs " ><i class="icon-unpublish"></i></button>
                             @endif 

                             {{ Form::hidden('option', 'status') }}
                             {{ Form::hidden('state', $property->publish) }}
                           
                        {{ Form::close() }}
                        {{ Form::open(array('route' => array('admin.properties.update', $property->id),'method' => 'put')) }}
                          
                            @if ($property->featured == 1) 
                            <button type="submit"  class="btn btn-xs active " ><i class="icon-featured"></i></button>
                             @else 
                             <button type="submit"  class="btn btn-xs " ><i class="icon-unfeatured"></i></button>
                             @endif 
                            
                             {{ Form::hidden('option', 'featured') }}
                             {{ Form::hidden('featured', $property->featured) }}
                             
                        {{ Form::close() }}

                        
                    </td>
                    <td>
                        
                        <a href="{{ URL::route('admin.properties.edit', $property->id) }}" class="btn btn-success btn-sm pull-left">Edit</a>
                        
                      
                        {{ Form::open(array('route' => array('admin.properties.destroy', $property->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
                            <button type="submit" href="{{ URL::route('admin.properties.destroy', $property->id) }}" class="btn btn-danger btn-sm">Delete</button>
                        {{ Form::close() }}

                    </td>
                </tr>
            @endforeach
        </tbody>
       <tfoot>
             <tr >
                 @if ($properties) 
                <td  colspan="10">{{$properties->appends(array('q' => $search,'cat'=>$selected,'status'=>$selectedStatus))->links()}}</td>
                 @endif 
             </tr>
             
        </tfoot>
    </table>
    </div>  
    
 
@stop
