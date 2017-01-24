@extends('layouts.app')


@section('content')


<?php
    $image = basename($course->large_url);
?>


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

            <div class="row">
                <!--blog post -->
                <div class="col-sm-8">
                    
                    <!--post -->
                    <div class="panel">
                        <div class="">
                            @if($errors->any())
                                <div class="pos-rlt wrapper b b-light r r-2x bg-danger">
                                    <span class="arrow left pull-up arrow-danger"></span>
                                    <p class="m-b-none text-white">{{$errors->first()}}</p>
                                </div>
                            @endif
                            @if (session('message'))
                                <div class="pos-rlt wrapper b b-light r r-2x bg-success">
                                    <span class="arrow left pull-up arrow-success"></span>
                                    <p class="m-b-none text-white">{{ session('message') }}</p>
                                </div>
                            @endif

                            @if(isset($message))
                                <div class="pos-rlt wrapper b b-light r r-2x bg-success">
                                    <span class="arrow left pull-up arrow-success"></span>
                                    <p class="m-b-none text-white">{{ $message }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="item img-bg img-info">
                            @if(!empty($image))
                                <img src="{{ asset('course/imgs') }}/<?php echo $image ?>" class="img-full">
                            @else
                                <img src="{{ asset('course/imgs/no') }}/placeholder.png" class="img-full">
                            @endif
                        </div>
                        <div class="bottom wrapper-lg w-full">
                            <h4 class="h4 text-inline"><a class="text" href="">{{ $course->title }}</a></h4>
                            <small class="">Published : {{ date('j F,Y',strtotime($course->created_at )) }}</small>
                        </div>
                        <div class="wrapper-lg">
                            <a href="" class="m-r-xl"><span>{{ $enrolled }}</span> Students Enrolled</a>
                            <a href=""><span>{{ $seat_left }}</span> Seat Left</a>    
                            <a href="{{ url('course') }}/{{ $course->id }}/class" class="btn btn-danger pull-right"> Join Class </a>
                        </div>
                        <div class="wrapper b-b">
                            <p class="m-b-none">
                                {!! $course->description !!}
                            </p>
                        </div>
                        
                    </div>
                    <!--/ post -->
                    
                </div>
                <!--/ blog post -->

                <!--blog sidebar -->
                <div class="col-sm-4">
                    <div class="panel wrapper-xxl bg-offWhite">
                        <h5 class="m-t-none m-b-lg">Information</h5>
                        <div class="">
                            <p>Call No :  <b>{{ $user->email }}_{{ $course->id }}</b></p>
                        </div>
                        <div class="">
                            <div class="line-sm b-b"></div>
                        </div>
                        <div class="">
                            <p>Start Date: <b>{{ date('j F,Y',strtotime($course->start_date )) }}</b></p>
                        </div>
                        <div class="">
                            <div class="line-sm b-b"></div>
                        </div>
                        <div class="">
                            <p><a href="{{ url('course') }}/{{ $course->id }}/class" class="btn btn-danger">Join Class</a></p>
                        </div>
                    </div>
                    <div class="panel wrapper-xxl bg-offWhite">
                        <div class="">
                            <a href="{{ url('exam/course') }}/{{ $course->id }}/topic/all"> Exams </a>
                        </div>
                        <div class="">
                            <div class="line-sm b-b"></div>
                        </div>
                    </div>
                    <div class="panel wrapper-xxl bg-offWhite text-center">
                        <h5 class="m-t-none m-b-lg">Instructor Biography</h5>
                        <div class="">
                            @if(!empty($user->profile_photo))
                                <img src="{{ url($user->profile_photo) }}" class="img-full">
                            @else
                                <img src="{{ url('user/no_photo/no_photo.png') }}" class="img-full">
                            @endif
                        </div>
                        <div class="text-center">
                            <h4>{{ $user->name }}</h4>
                            <h6>{{ $user->designation }}</h6>
                            <p>{{ $user->biography }}</p>
                        </div>
                    </div>
                </div>
                <!--/ blog sidebar -->
            </div>
        </div>
    </div>
</section>

@endsection