@extends('layouts.app')

@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l">{{ $user->name }}</h1>
                <h5>{{ $user->designation }}</h5>
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
                        
                        <div class="wrapper-lg">
                            <div class="user-image-frame">
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
                        <div class="wrapper b-b">
                          <p class="m-b-none">
                              @if(Auth::user()->role_id == 2)
                                  <a href="{{ url('teacher/courses') }}"><span></span> {{ count($t_courses) }} Courses</a>
                              @endif
                          </p>
                        </div>
                        
                      </div>
                      <!--/ post -->
                    
                  </div>
                  <!--/ blog post -->

                  <!--blog sidebar -->
                  <div class="col-sm-4">
                      <div class="panel wrapper-xxl bg-offWhite text-center">
                           <a href="" title="Change photo" class="btn btn-lg" data-toggle="modal" data-target="#editPhoto"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Change Photo</a>
                      </div>

                      <div class="panel wrapper-xxl bg-offWhite text-center">
                           <a href="" title="Update Profile" class="btn btn-lg" data-toggle="modal" data-target="#editName"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Profile</a>
                      </div>
                    
                    @if(count($t_courses) > 0)
                      <div class="panel wrapper-xxl bg-offWhite">
                        <h5 class="m-t-none m-b-lg text-center">My Courses</h5>
                        @foreach($t_courses as $course)
                        <div class="">
                          <?php $image = basename($course->thumb_url); ?>
                          @if(!empty($image))
                            <a herf="{{ url('course') }}/{{ $course->id }}" class="pull-left thumb-md b m-r-sm"> <img src="{{ asset('course/imgs') }}/<?php echo $image;?>" alt="..." class="img-full"> </a>
                          @else
                            <a herf="{{ url('course') }}/{{ $course->id }}" class="pull-left thumb-md b m-r-sm"> <img src="{{ asset('course/imgs') }}/no/placeholder.png" alt="..." class="img-full"> </a>
                          @endif
                          <div class="clear">
                            <a href="{{ url('course') }}/{{ $course->id }}" class="text-info text-ellipsis">{{ $course->title }}</a>
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


                <!-- User Image upload modal goes here -->

                <div class="modal fade" id="editPhoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Upload/Change Your Photo</h4>
                      </div>
                        <div class="modal-body">
                          <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ url('user/profile/upload-photo') }}">
                                  {{ csrf_field() }}
                                  <div class="form-group">
                                      <div class="col-md-12">
                                          <input type="file" name="profile-photo" class="" required="">
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                          </form>
                    </div>
                  </div>
                </div> 

                <!-- edit Teacher/Student name -->
                <div class="modal fade" id="editName" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title" id="myModalLabel">Update Your Profile</h4>
                        </div>
                          <div class="modal-body">
                             <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ url('user/profile/edit-name') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" name="designation" class="form-control" value="{{ $user->designation }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea name="biography" class="form-control" value="">{{ $user->biography }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>


        </div>
    </div>
</section>

@endsection