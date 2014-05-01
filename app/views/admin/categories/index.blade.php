@extends('admin._layouts.default')
 
@section('main')
 <div class="well well-large actions">
       <div class="title">
        <h1>
            Categories <a href="{{ URL::route('admin.categories.create') }}" class="btn btn-success"><i class="icon-plus-2"></i> Add new category</a>
        </h1>
        
        </div>
        <div class="filtros">
           
           
            {{ Form::open(array('url' => 'admin/categories','method' => 'get')) }}
               <div class="form-group">
                    <div class="controls">
                        {{ Form::label('q', 'Search') }}
                        {{ Form::text('q',$search,array('class'=>'form-control')) }}
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
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>When</th>
                <th>Publish</th>
                <th><i class="icon-cog"></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td><a href="{{ URL::route('admin.categories.edit', $category->id) }}">{{ $category->name }}</a></td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                                             
                        
                         {{ Form::open(array('route' => array('admin.categories.update', $category->id),'method' => 'put')) }}
                            @if ($category->publish == 1) 
                            <button type="submit"  class="btn btn-xs  active " ><i class="icon-publish"></i></button>
                             @else 
                             <button type="submit"  class="btn btn-xs " ><i class="icon-unpublish"></i></button>
                             @endif 
                             {{ Form::hidden('option', 'publish') }}
                             {{ Form::hidden('state', $category->publish) }}
                        {{ Form::close() }}
                    </td>
                    <td>
                        
                        <a href="{{ URL::route('admin.categories.edit', $category->id) }}" class="btn btn-success btn-sm pull-left">Edit</a>
                        
                      
                        {{ Form::open(array('route' => array('admin.categories.destroy', $category->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
						    <button type="submit" href="{{ URL::route('admin.categories.destroy', $category->id) }}" class="btn btn-danger btn-sm">Delete</button>
						{{ Form::close() }}

                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
             <tr >
                 @if ($categories) 
                <td  colspan="10">{{$categories->appends(array('q' => $search,'status'=>$selectedStatus))->links()}}</td>
                 @endif 
             </tr>
             
        </tfoot>
    </table>
</div>
 
@stop
