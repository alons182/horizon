@extends('_layouts.default')
 
@section('main')

<div class="inner">
    <div id="message">
        {{ Notification::showAll() }}
         @if ($errors->any())

        <div class="alert alert-error">
                 <ul>
                  @foreach( $errors->all() as $message )
                    <li>{{ $message }}</li>
                  @endforeach
                </ul>
        </div>
      @endif
    </div>            
    <a href="#" id="link-testimonial" class="link-testimonial btn btn-celeste">{{ Lang::get('labels.label-add-testimonial') }}</a>
    <div id="formulario-tesimonial">
        	 {{ Form::open(array('url' => 'testimonials','method' => 'post','id' =>'TestimonialForm')) }}
        		<div class="form-group">
                        <div class="controls">
                           <h3>{{ Lang::get('labels.label-form-name') }}</h3>
                            {{ Form::text('name') }}
                        </div>
                        <div class="controls">
                           <h3>{{ Lang::get('labels.label-form-email') }}</h3>
                            {{ Form::email('email') }}
                        </div>
                        <div class="controls">
                            <h3>{{ Lang::get('labels.label-form-comment') }}</h3>
                            {{ Form::textarea('comments') }}
                        </div>
                   
                       <div class="buttons">
                        {{ Form::submit( Lang::get('labels.label-send') , array('class' => 'btn btn-success btn-save btn-large')) }}
                		<a href="#" class="btn btn-large link-testimonial">{{ Lang::get('labels.label-cancel') }}</a>
                       </div>
                 </div>  
                
        	 {{ Form::close() }}
        </div>
    @foreach ($testimonials as $testimonial)

        <div class="opinion">
            <blockquote class="comments">
                <p></p>
                {{ $testimonial->comments }}
                <p></p>
            </blockquote>    
            <div class="date">
                {{ $testimonial->created_at }}
            </div>
            <div class="author">
                 {{ $testimonial->name }} 
            </div>
            <hr />
          
        </div>



                    
     @endforeach
     {{$testimonials->links()}}
</div>
@stop



