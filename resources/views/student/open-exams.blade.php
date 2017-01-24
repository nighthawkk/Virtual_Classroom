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
        <div class="row p-t-xxl bg-info content">

            <div class="col-md-3">
                <!-- left sidebar -->
                <div class="list-group">
                      <a href="{{ url('student') }}/my-course/{{ $course->id }}" class="list-group-item"><< Back to course page</a>
                </div>
            </div>

            <div class="col-md-9">
                <!-- Main content -->
                    @if(count($exams) > 0)
                    <ul> 
                        @foreach($exams as $exam)
                            <li>{{ $exam->name }}<a href="{{ url('exam/course') }}/{{ $course->id }}/topic/{{$exam->id}}/start" class="btn btn-info">Take it</a></li>
                        @endforeach
                    </ul>
                    @else
                        <span class="alert">No open examination is found.</span>
                    @endif


            </div>

        </div>
    </div>
</section>

@endsection