@extends('layouts.app')


@section('content')


<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l">All Courses</h1>
            </div>
        </div>
    </div>
</section>

	
<section class="p-v-xxl bg-light">
	<div class="container">
	    <div class="row p-t-xxl">

            @if(session('message'))
                <div class="pos-rlt wrapper b b-light r r-2x bg-success">
                    <span class="arrow left pull-up arrow-success"></span>
                    <p class="m-b-none text-white">{{ session('message') }}</p>
                </div>
            @endif



			@if($errors->has())
				@foreach ($errors->all() as $error)
				  <div class="pos-rlt wrapper b b-light r r-2x bg-danger">
                      <span class="arrow left pull-up arrow-danger"></span>
                      <p class="m-b-none text-white">{{ $error }}</p>
                  </div>
				@endforeach
			@endif


			

			@if(count($courses) > 0)
				@foreach($courses as $course)

					<div class="col-md-3 single-course-box">
							<a href="{{ url('course') }}/{{ $course->id }}" >
					  
							<?php 

								$image = basename($course->thumb_url);

							?>
							<div class="item text-center bg-info">
								<div class="top-image course-image">
									<img src="{{ asset('course/imgs/') }}/<?php echo $image ?> " class="">
								</div>
								<div class="course-course-title">
									<h5>{{ $course->title }}</h5>
									<div class="line line-lg b-b b-info w-3x m-auto"></div>
								</div>	
								<div class="w-full p-h-xxl p-v-lg">
									<p class="h6"><b>By:</b> {{ $course->name }}</p>
									<h6>Start Date: <span class="text-info">{{ date('j F,Y',strtotime($course->start_date)) }}</span></h6>
									<!-- <h6>Allowed Students: {{ $course->max_allowed_student }}</h6>
									<h6>Number of Classes: {{ $course->class_number }}</h6>	 -->							
								</div>						
							</div>
						</a>
					</div>
				@endforeach
			@else

				<div class="media-body">
			    	<div class="pos-rlt wrapper b b-light r r-2x bg-danger">
	                	<span class="arrow left pull-up arrow-danger"></span>
	                	<p class="m-b-none">Sorry, no courses found ! Please try again!</p>
	              	</div>
			  	</div>

			@endif
	    </div>
	</div>
</section>




@endsection