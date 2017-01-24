@extends('layouts.app')

@section('content')
<!-- Header -->
    <section class="bg-dark m-t-xxl p-v-xxl" style="margin-top: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center m-t-lg">
                    <h1 class="h1 font-semi-bold">Best Courses. Learn Anytime, Anywhere.</h1>
                    <h3 class="m-t-lg l-h-1x">Take the world's best courses, online.</h3>
                    <a href="{{ url('courses') }}" class="btn btn-lg btn-danger" style="margin-top: 20px;">Browse Courses</a>
                </div>
            </div>
        </div>
    </section>
    <section class="separator bg-dark" style="margin-top: 0px;">
        <div class="decor-svg">
            <svg class="decor fill-white fill-" height="100%" preserveAspectRatio="none" version="1.1" viewBox="0 0 100 100" width="100%" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 100 L100 0 L100 100" stroke-width="0"/>
            </svg>
        </div>
    </section>
    <section class="bg-white">
        <div class="container">
            <div class="row text-center m-b-xxl p-b-xl">
                
                <div class="wrapper m-t-xxl m-b-xl text-center ">
                    <h2 class="font-bold">How It Works</h2>
                </div>
                <div class="col-md-4">
                    <i class="icon-earphones-alt fa-5x text-light text-dk m-b-sm"></i>
                    <h5 class="m-v-lg p-t-xs">Join Free</h5>
                    <p>
                        Join with us for free. Whether you are a student, want to learn or whether you are an instructor, want to teach. Register now and start your own course or start learning.
                    </p>
                </div>
                
                <div class="col-md-4">
                    <i class="icon-frame fa-5x text-light text-dk"></i>
                    <h5 class="m-v-lg p-t-xs">Coursework</h5>
                    <p>
                        Each course is like an interactive textbook, featuring quizzes and projects. Instructors and learners will be connected through live video and audio streaming during a class session.
                    </p>
                </div>
                <div class="col-md-4">
                    <i class="icon-fire fa-5x text-light text-dk"></i>
                    <h5 class="m-v-lg p-t-xs">Help & Support</h5>
                    <p>
                        Connect with thousands of other learners and debate ideas, discuss course material, and get help mastering concepts through our interactive forum. Or share ideas through private or public messaging. 
                    </p>
                </div>
                
            </div>
        
            <div class="m-t-xl m-b-xl text-center">
                
                <p class="m-t-lg">
                    <a href="{{ url('login') }}" class="btn btn-lg b-2x b-dark m-sm scrollto">Start Learning Today</a>
                </p>
            </div>
            
        </div>
    </section>



    <section class="p-v-xxl img-bg img-white dker banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <h1 class="font-bold l-h-1x p-v m-v-xl text-black  text-center">
                      Ready to <span class="text-danger">master some skills?</span>
                    </h1>
                    <p class="h5 text-muted m-b-xl" style="color: #1c2b36;"> Take your career to the next level! </p>
                    <a href="{{ url('register') }}" class="btn btn-lg btn-danger">Sign Up Now</a>
                </div>
                
            </div>
        </div>
    </section>
  
@endsection
