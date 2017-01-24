@extends('layouts.app')


@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h3 class="h3 m-t-l p-v-l"></b></h3>
            </div>
        </div>
    </div>
</section>

    
<section class="p-v-xxl bg-light">
    <div class="container">
        <div class="row p-t-xxl bg-info content">
            @if($answers)
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>User Name</th>
                            <th>E-mail</th>
                            <th>Test name</th>
                            <th>Total Marks(%)</th>
                            <th>Time taken</th>
                            <th>Exam Date</th>
                        </tr>
                        </thead>
                        @foreach($answers as $ans)
                            <tr>
                                <td>{{$ans->username}}</td>
                                <td>{{$ans->useremail}}</td>
                                <td>{{$ans->subjectname}}</td>
                                <td>{{ceil($ans->porcent)}}%</td>
                                <td>{{$ans->time}}</td>
                                <td>{{$ans->created_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
        @endif
        </div>
    </div>
</section>