@extends('admin._layouts.default')
 
@section('main')

    <div class="well well-large actions">
       <div class="title">
            <h1>
            Testimonials 
            </h1>
        </div>
        
        <div class="filtros">
           
           
            {{ Form::open(array('url' => 'admin/testimonials','method' => 'get')) }}
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
                <th>Email</th>
                <th>Comments</th>
                
               
                <th>When</th>
                <th>Publish</th>
                <th><i class="icon-cog"></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($testimonials as $testimonial)
                <tr>
                    <td>{{ $testimonial->id }}</td>
                    <td>{{ $testimonial->name }}</td>
                    <td>{{ $testimonial->email }}</a></td>
                    <td>{{ $testimonial->comments }}</td>
                    <td>{{ $testimonial->created_at }}</td>
                    <td>
                                             
                        
                         {{ Form::open(array('route' => array('admin.testimonials.update', $testimonial->id),'method' => 'put')) }}
                            @if ($testimonial->publish == 1) 
                            <button type="submit"  class="btn btn-xs  active " ><i class="icon-publish"></i></button>
                             @else 
                             <button type="submit"  class="btn btn-xs " ><i class="icon-unpublish"></i></button>
                             @endif 
                             {{ Form::hidden('option', 'publish') }}
                             {{ Form::hidden('state', $testimonial->publish) }}
                        {{ Form::close() }}
                    </td>
                    <td>
                   
                                     
                      
                        {{ Form::open(array('route' => array('admin.testimonials.destroy', $testimonial->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
						    <button type="submit" href="{{ URL::route('admin.testimonials.destroy', $testimonial->id) }}" class="btn btn-danger btn-sm">Delete</button>
						{{ Form::close() }}

                    </td>
                </tr>
            @endforeach
        </tbody>
       <tfoot>
             <tr >
                 @if ($testimonials) 
                <td  colspan="10">{{$testimonials->appends(array('q' => $search,'status'=>$selectedStatus))->links()}}</td>
                 @endif 
             </tr>
             
        </tfoot>
    </table>
</div>
 
@stop