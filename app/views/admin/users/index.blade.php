@extends('admin._layouts.default')
 
@section('main')
 <div class="well well-large actions">
       <div class="title">
            <h1>
    
        Users <a href="{{ URL::route('admin.users.create') }}" class="btn btn-success"><i class="icon-plus-2"></i> Add new user</a>
            </h1>
        </div>
        
</div>
     {{ Notification::showAll() }}
    <hr>
 <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Name</th>
                <th>Group</th>
                <th>When</th>
                <th><i class="icon-cog"></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ URL::route('admin.users.edit', $user->id) }}">{{ $user->email }}</a></td>
                    <td>{{ $user->first_name  }} {{$user->last_name  }}</td>
                   
                    <td>
                        @foreach ($user->getGroups() as $group)
                        {{ 
                        
                            $group->name
                       
                        }}
                         @endforeach
                    </td>
                    <td>{{ $user->created_at }}</td>
                    
                    <td>
                        
                        <a href="{{ URL::route('admin.users.edit', $user->id) }}" class="btn btn-success btn-sm pull-left">Edit</a>
                        
                      
                        {{ Form::open(array('route' => array('admin.users.destroy', $user->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
						    <button type="submit" href="{{ URL::route('admin.users.destroy', $user->id) }}" class="btn btn-danger btn-sm">Delete</button>
						{{ Form::close() }}

                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
             <tr >
                 @if ($users) 
                <td  colspan="10">{{$users->links()}}</td>
                 @endif 
             </tr>
             
        </tfoot>
    </table>
</div>
 
@stop
