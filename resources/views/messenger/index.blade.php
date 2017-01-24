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

        
	    <div class="row p-t-xxl content">

            @if(Session::has('error_message'))
                <div class="pos-rlt wrapper b b-light r r-2x bg-danger">
                    <span class="arrow left pull-up arrow-danger"></span>
                    <p class="m-b-none text-white">{{ Session::get('error_message') }}</p>
                </div> 
            @endif
        
            <div class="col-sm-9">
                @if($threads->count() > 0)
                @foreach($threads as $thread)
                    <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                    <div class="media alert {{ $class }} panel">
                        <h4 class="media-heading"><a href="{{ url('messages/' . $thread->id) }}">{{ $thread->subject }}</a></h4>
                        <p><small><strong class="label label-info">From :</strong> <span class="label label-success"> {{ $thread->creator()->name }}</span></small></p>
                        <p>
                            <small>
                                <strong class="label label-info">To :</strong> 
                                @foreach($thread->participants as $participant)
                                    <!-- Don't show the sender in "To" name -->
                                    @if($thread->creator()->id != $participant->user->id)
                                        <span class="label label-success">{{ $participant->user->name }}</span>
                                    @endif
                                @endforeach
                            </small>
                        </p>
                        <p>{{ $thread->latestMessage->body }}</p>
                        
                    </div>
                @endforeach
            @else
                <div class="panel">
                    <p style="padding: 20px;" class="text-danger">Sorry, no threads.</p>
                </div>
                
            @endif
            </div>
            <div class="col-sm-3">
                <div class="panel wrapper-xl bg-offWhite text-center">
                   <a href="{{URL::to('messages/create')}}" title="Change photo" class="btn btn-lg"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> New Message</a>
                </div>
            </div>

	    </div>
	</div>
</section>

@endsection