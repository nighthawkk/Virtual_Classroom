@extends('layouts.app')


@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h3 class="h3 m-t-l p-v-l">Exam : <b>{{ $topic->name }}</b></h3>
            </div>
        </div>
    </div>
</section>

    
<section class="p-v-xxl bg-light">
    <div class="container">
        <div class="row p-t-xxl bg-info content">
             @if(Session::has('flash_mess'))
                <div class="alert alert-success">{{Session::get('flash_mess')}}</div>
            @endif

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading"><span class="glyphicon glyphicon-cog"></span> {{$title}}</div>
                <p>Subject: {{$topic->name}}</p>
                <p>Total questions: {{$cnt}}</p>
                <p>Correct answers: {{$cnt_right_answ}}</p>
                <p>Time taken: {{$time_taken}}</p>
                <p>Score %: {{$percentages}}%</p>

            </div>
        </div>
    </div>
</section>