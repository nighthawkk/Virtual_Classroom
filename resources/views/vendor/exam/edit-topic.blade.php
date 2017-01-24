@extends('layouts.app')

@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l">Edit topic of <b>{{ $course->title }}</b></h1>
            </div>
        </div>
    </div>
</section>

    
<section class="p-v-xxl bg-light">
    <div class="container">
        <div class="row p-t-xxl bg-info content">
        	@include('errors.list')

            <div class="col-md-9">
                <div>
                    <form class="form-horizontal" method="post" action="{{ url('exam/course') }}/{{ $course->id }}/topic/{{ $topic->id }}/update">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="topic-name">Name of Topic</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" required="" placeholder="Name of the exam topic" value="{{ $topic->name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="course" value="{{ $course->id }}">
                        </div>

                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="topic-name">Duration</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="duration" required="" placeholder="Duration of the exam in minutes" value="{{ $topic->duration }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2">
                                <label for="topic-name">Active</label>
                            </div>
                            <div class="col-md-3">
                                <input type="checkbox" name="status" value="1" checked="checked">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 text-center">
                                <button type="submit" class="btn btn-primary"> Update exam topic </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-sm-3">
                <!-- left sidebar -->
                <div class="panel wrapper-xl bg-offWhite text-center">
                    <a href="{{ url('teacher/my-course') }}/{{ $course->id }}" class="btn btn-lg"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Back to course page</a>
                </div>
                <div class="panel wrapper-xl bg-offWhite text-center">
                    <a href="{{ url('exam/course') }}/{{ $course->id }}/topic/all" class="btn btn-lg">All Exam Topic</a>
                </div>
                <div class="panel wrapper-xl bg-offWhite text-center">
                    <a href="{{ url('exam/course')}}/{{ $course->id }}/topic/new" class="btn btn-lg">+ Create an exam topic</a>
                </div>
            </div>


        </div>
    </div>
</section>
@endsection