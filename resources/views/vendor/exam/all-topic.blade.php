@extends('layouts.app')

@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l">{{ $course->title }}</h1>
            </div>
        </div>
    </div>
</section>

    
<section class="p-v-xxl bg-light">
    <div class="container">
        <div class="row p-t-xxl content">
        	@include('errors.list')

            @if(Session::has('flash_mess'))
                <div class="panel">
                    <div class="pos-rlt wrapper b b-light r r-2x bg-success">
                        <span class="arrow left pull-up arrow-success"></span>
                        <p class="m-b-none text-white">{{Session::get('flash_mess')}}</p>
                    </div>
                </div>
            @endif

            <div class="col-sm-9">
                <div class="panel" style="padding: 25px;">
                    @if(!$topics->isEmpty())
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>Topic Name</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach($topics as $topic)
                                    <tr>
                                        <td>{{$topic->name}}</td>
                                        <td>{{$topic->duration}} mins</td>
                                        <td>
                                            <h4>
                                            @if($topic->status == 1)
                                                <span class="label label-success">Completed
                                             @else
                                                <span class="label label-warning">Open
                                            @endif

                                                </span>
                                            </h4>
                                        </td>
                                        <td>
                                            @if(!Auth::guest())
                                                @if(Auth::user()->role_id == 2)
                                                    <a class="btn btn-info" href="{{action('ExamController@getQuestions', [$course->id,$topic->id])}}">Manage Questions</a>
                                                    <a class="btn btn-warning" href="{{action('ExamController@getEdit', [$course->id,$topic->id])}}">Edit</a>
                                                    <a class="btn btn-danger" id="btn-delete" href="{{action('ExamController@getDelete', [$course->id,$topic->id])}}">Delete</a>
                                                @else
                                                    <a href="{{ url('exam/course') }}/{{ $course->id }}/topic/{{ $topic->id}}/start" class="btn btn-info">Start Test</a>
                                                @endif
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    @else
                        <div class="panel">
                            <div class="pos-rlt wrapper b b-light r r-2x bg-danger">
                                <span class="arrow left pull-up arrow-danger"></span>
                                <p class="m-b-none text-white">No exam topic found for this Course!</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>


             <div class="col-sm-3">
                <!-- left sidebar -->
                <div class="panel wrapper-xl bg-offWhite text-center">
                    <a href="{{ url('teacher/my-course') }}/{{ $course->id }}" class="btn btn-lg"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Back to course page</a>
                </div>
                <div class="panel wrapper-xl bg-offWhite text-center">
                    <a href="{{ url('exam/course')}}/{{ $course->id }}/topic/new" class="btn btn-lg">+ Create an exam topic</a>
                </div>
            </div>
        </div>
    </div>
    @if(count($topics) > 0)
     {{$topics->links()}}
     @endif
</section>
@endsection