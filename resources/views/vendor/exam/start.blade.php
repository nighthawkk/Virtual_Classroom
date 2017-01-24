@extends('layouts.app')


@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h3 class="h3 m-t-l p-v-l">Exam : <b>{{ $topic->name }}</b></h3>
                <h3 class="h3 m-t-l p-v-l">Duration : <b>{{ $topic->duration }} minutes</b></h3>
            </div>
        </div>
    </div>
</section>

    
<section class="p-v-xxl bg-light">
    <div class="container">
        <div class="row p-t-xxl bg-info content">
        	<div class="jumbotron">
		        <h3>Topic Name: <b>{{$topic->name}}</b></h3>
		        <h3>Duration: <b>{{$topic->duration}} minutes</b></h3>

		        <a class="btn btn-success btn-lg" href="{{action('ExamController@getStartTest',[$course->id,$topic->id])}}" role="button">START EXAM</a>
			</div>

        </div>
    </div>
</section>


@endsection