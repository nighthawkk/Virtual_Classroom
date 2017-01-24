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
                            <form action="{{ url('course') }}/{{ $course->id }}/enroll" method="get" class="enroll-btn">
                                <div class="form-group">
                                    <button type="submit" class="form-control pull-right btn btn-primary" value="Enroll">Enroll in This Course</button>
                                </div>
                            </form>
                            
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

                    <div class="panel wrapper-xxl bg-offWhite text-center">
                        <div id="inCall" class="ptext">
                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#editCourse"><i class="fa fa-edit"></i> Edit</a> 
                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteCourse"><i class="fa fa-remove"></i> Delete</a>
                        </div>
                    </div>
                    <div class="panel wrapper-xxl bg-offWhite">
                        <div class="">
                            <a href="{{ url('course') }}/{{ $course->id }}/class" class="btn btn-danger"> Goto Class </a>
                        </div>
                        <div class="">
                            <div class="line-sm b-b"></div>
                        </div>
                        <div class="">
                            <a href="{{ url('exam/course') }}/{{ $course->id }}/topic/all">  All Exam Topics </a>
                        </div>
                        <div class="">
                            <div class="line-sm b-b"></div>
                        </div>
                        <div class="">
                            <a href="{{ url('exam/course')}}/{{ $course->id }}/topic/new">  + Create an Exam Topic </a>
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
                    
                    @if(count($all_courses) > 0)
                        <div class="panel wrapper-xxl bg-offWhite">
                            <h5 class="m-t-none m-b-lg text-center">Check My Other Courses</h5>
                            @foreach($all_courses as $all_course)
                            <div class="">
                                <?php $image = basename($course->thumb_url); ?>
                                @if(!empty($image))
                                    <a herf="{{ url('course') }}/{{ $all_course->id }}" class="pull-left thumb-md b m-r-sm"> <img src="{{ asset('course/imgs') }}/<?php echo $image;?>" alt="..." class="img-full"> </a>
                                @else
                                    <a herf="{{ url('course') }}/{{ $all_course->id }}" class="pull-left thumb-md b m-r-sm"> <img src="{{ asset('course/imgs') }}/no/placeholder.png" alt="..." class="img-full"> </a>
                                @endif
                                <div class="clear">
                                    <a href="{{ url('course') }}/{{ $all_course->id }}" class="text-info text-ellipsis">{{ $course->title }}</a>
                                    <small class="block text-muted">Start Date: {{ date('j F,Y',strtotime($course->start_date)) }}</small>
                                </div>
                            </div>
                            <div class="line-sm"></div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <!--/ blog sidebar -->
            </div>


                <div class="col-md-9">
                    <!-- Main content -->
                    <!-- Modals -->
                    <div class="row">
                        <!-- Edit Course Modal -->
                        <div id="editCourse" class="modal fade bs-example-modal-lg" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Edit course</h4>
                                  </div>
                                  <div class="modal-body">
                                        <form class="form-horizontal" role="form" action="{{ url('course') }}/{{ $course->id }}/update" method="post" enctype="Multipart/form-data">
                                        {{ csrf_field() }}
                                            
                                            <div class="form-group">
                                                <label for="class_number" class="col-sm-2 control-label">Number of Classes</label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="class_number" class="form-control" value="{{ $course->class_number }}" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="class_number" class="col-sm-2 control-label">Maximum Allowed Students ( max 20 )</label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="max_allowed_student" value="{{ $course->max_allowed_student }}" class="form-control" min="1" max="20" required="">
                                                </div>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label for="class_number" class="col-sm-2 control-label">Description</label>
                                                <div class="col-sm-10">
                                                    <textarea name="description" class="form-control" id="summernote" cols="30" rows="10" required="">{!! $course->description !!}</textarea>
                                                </div>
                                            </div>
                                        
                                            <div class="form-group">        
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                              </div>
                        </div>

                        <!-- Delete Course modal -->
                        <div id="deleteCourse" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Delete course</h4>
                                  </div>
                                  <div class="modal-body">
                                      <p>Are you sure you want to delete this course ? This can't be reverted!</p>
                                  </div>
                                  <div class="modal-footer">
                                        <form class="form-vertical" method="post" action="{{ url('course') }}/{{ $course->id }}/delete">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <button type="submit" href="{{ url('course') }}/{{ $course->id }}/delete" class="btn btn-danger">Confirm</button>
                                            </div>
                                        </form>
                                       
                                       <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                  </div>
                                </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
    	    </div>
        </div>
	</div>
</section>

@endsection