@extends('admin._layouts.default')
 
@section('main')

    <div class="well well-large actions">
       <div class="title">
            <h1>
            Requests 
            </h1>
        </div>
        
        <div class="filtros">
           
           
            {{ Form::open(array('url' => 'admin/prequests','method' => 'get')) }}
               <div class="form-group">
                    <div class="controls">
                        {{ Form::label('q', 'Search') }}
                        {{ Form::text('q',$search,array('class'=>'form-control')) }}
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
                <th>Email</th>
                <th>Phone</th>
                <th>Comments</th>
                <th>Request Property</th>
               
                <th>When</th>
                
                <th><i class="icon-cog"></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prequests as $prequest)
                <tr>
                    <td>{{ $prequest->id }}</td>
                    <td>{{ $prequest->name }}</td>
                    <td>{{ $prequest->email }}</a></td>
                    <td>{{ $prequest->phone }}</a></td>
                    <td>{{ $prequest->comments }}</td>
                    <td>
                     <a href="{{ URL::route('admin.properties.edit', $prequest->property_id) }}">({{ $prequest->property()->first()->code }}) {{ $prequest->property()->first()->title }} </td>
                    <td>{{ $prequest->created_at }}</td>
                    
                    <td>
                   
                                     
                      
                        {{ Form::open(array('route' => array('admin.prequests.destroy', $prequest->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
						    <button type="submit" href="{{ URL::route('admin.prequests.destroy', $prequest->id) }}" class="btn btn-danger btn-sm">Delete</button>
						{{ Form::close() }}

                    </td>
                </tr>
            @endforeach
        </tbody>
       <tfoot>
             <tr >
                 @if ($prequests) 
                <td  colspan="10">{{$prequests->appends(array('q' => $search))->links()}}</td>
                 @endif 
             </tr>
             
        </tfoot>
    </table>
</div>
 
@stop