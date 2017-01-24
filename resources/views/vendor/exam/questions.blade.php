@extends('layouts.app')

@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l">Question Management : <b>{{ $topic->name }}</b></h1>
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
                    <div class="question-topic">
                        <h3>Course Name: <b>{{ $course->title }}</b></h3>
                        <h3>Topic Name: <b>{{ $topic->name }}</b></h3>
                        <h3>Duration: <b>{{ $topic->duration }}</b> minutes</h3>
                    </div>

                     <button type="button" class="btn btn-primary" id="btn-add-new-question"><span class="glyphicon glyphicon-plus"></span> Add new question</button>

                     <br><br><br>
                     <form class="form-horizontal" method="post" action="{{ url('exam/course') }}/{{ $course->id }}/topic/{{ $topic->id }}/question/create" id="add-new-question">
                         @include('vendor.exam.question-form')


                    @if(!$questions->isEmpty())
                        <div class="panel panel-default">
                            <!-- Default panel contents -->
                            <div class="panel-heading"><span class="glyphicon glyphicon-cog"></span> Questions added</div>

                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @foreach($questions as $question)

                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading{{$question->id}}">
                                            <h4 class="panel-title">
                                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$question->id}}" aria-expanded="false" aria-controls="collapse{{$question->id}}">
                                                    Question #{{$question->id}} : <b>{{ $question->question }}</b>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{$question->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$question->id}}">
                                            <div class="panel-body">
                                                <form class="form-horizontal" id="add-new-question" method="post" action="{{ url('exam/course') }}/{{ $course->id }}/topic/{{ $topic->id }}/question/{{ $question->id }}/update">
                                                @include('vendor.exam.question-form')

                                            </div>
                                        </div>
                                    </div>

                            @endforeach
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
                <div class="panel wrapper-xl bg-offWhite text-center">
                    <a href="{{ url('exam/course') }}/{{ $course->id }}/topic/all" class="btn btn-lg">All exam topic</a>
                </div>
            </div>




        </div>
    </div>
</section>
@endsection