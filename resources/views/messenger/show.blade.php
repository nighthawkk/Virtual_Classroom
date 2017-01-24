@extends('layouts.app')

@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l"></h1>
            </div>
        </div>
    </div>
</section>

	
<section class="p-v-xxl bg-light">
	<div class="container">
	    <div class="row p-t-xxl content col-sm-12">


	    	<!-- Main content starts here -->
	    	<div class="col-sm-9">
	    		<div class="">
	    			<div class="panel-body">
	    				@foreach($thread->messages as $message)
	        			<div class="media">
				        	<div class="media-left">
							    <span class="thumb-sm avatar">
							    	@if(!empty($message->user->profile_photo))
			                            <img src="{{ url($message->user->profile_photo) }}" class="img-circle">
			                        @else
			                            <img src="{{ url('user/no_photo/no_photo.png') }}" class="img-circle">
			                        @endif
							    </span>
						  	</div>
						  	<div class="media-body">
						    	<div class="pos-rlt wrapper b b-light r r-2x bg-white">
				                	<span class="arrow left pull-up"></span>
				                	<h5 class="m-b-none" style="padding-top: 0px; padding-bottom: 10px;"><b>Subject : </b>{{ $thread->subject }}</h5>
				                	<h6 class="media-heading" style="padding-bottom: 10px;"><b>From : </b>{{ $message->user->name }}</h6>
				                	<div class="text-muted"><small>{{ $message->created_at->diffForHumans() }}</small></div>
				                    <p style="padding-top:10px;">{{ $message->body }}</p>
				              	</div>
						  	</div>
					    </div>
					    @endforeach
	        		</div>
	    		</div>
	    		<div class="reply-form">
					<form class="form-horizontal col-sm-12" method="post" action="{{ url('messages') }}/{{ $thread->id }}">
						{{ csrf_field() }}
						<div class="form-group">
							<div class="col-md-11 col-md-offset-1">
								<textarea class="form-control" name="message" required="" placeholder="Reply to this message" style="padding: 15px;"></textarea>
							</div>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary text-center" style="margin:auto;">Reply</button>
						</div>

					</form>
	    		</div>
	    	</div>

	    	<!-- End of Main Content -->

	    	<!-- Sidebar right starts here -->
	    	<div class="col-sm-3 panel-body">
	    		<div class="panel wrapper-xl bg-offWhite text-center">
                   <a href="{{URL::to('messages')}}" class="btn btn-lg"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Back to Inbox</a>
                </div>
	    	</div>
	    	<!-- End of right Sidebar -->

			
	    </div>
	</div>
</section>

@endsection