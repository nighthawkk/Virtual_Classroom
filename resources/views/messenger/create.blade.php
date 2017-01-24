@extends('layouts.app')

@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l"></h1>
            </div>
        </div>
    </div>
</section>

	
<section class="p-v-xxl bg-light">
	<div class="container">
	    <div class="row p-t-xxl content">


          <!-- Start of left bar content -->
          <div class="col-sm-9">
              @if($hide == 0)
                  <form action="{{ url('messages') }}" method="post"  class="form-horizontal col-sm-12">
                      {{ csrf_field() }}
                      <div class="col-sm-4">
                          <div class="panel left-users">
                              <!-- Show the available users here -->
                              <?php $i = 0; $j = 0; $exist = [];?>
                              @if(count($users) > 0)
                                  <div class="form-group users">
                                      <div class="checkbox col-sm-12 col-md-12 list-group-lg m-b-none r-none">
                                          @foreach($users as $user)
                                          
                                              @if(Auth::user()->id != $user->id)
                                                  @if($user->role_id == 1)
                                                      @if(Auth::user()->role_id == 2)
                                                          @if($i == 0)
                                                              <h3 class="s_title">Students</h4>
                                                              <div class="line line-lg b-b b-info w-3x m-auto"></div>
                                                          @endif
                                                      @else
                                                          @if($i == 0)
                                                              <h3 class="s_title">Classmates</h4>
                                                              <div class="line line-lg b-b b-info w-3x m-auto"></div>
                                                          @endif
                                                      @endif
                                                      <div class="student-section clearfix">
                                                          <label title="{{ $user->name }}"><input type="checkbox" name="recipients[]" value="{{ $user->id }}">
                                                              <span class="thumb-sm avatar m-t-n-sm m-b-n-sm m-l-sm"> 
                                                                @if(!empty($user->profile_photo))
                                                                    <img src="{{ url($user->profile_photo) }}">
                                                                @else
                                                                    <img src="{{ url('user/no_photo/no_photo.png') }}">
                                                                @endif
                                                              </span>
                                                              <span>{!!$user->name!!}</span>     
                                                          </label>
                                                      </div>
                                                  @else
                                                    @if($j == 0)
                                                        <h4 class="t_title" style="margin-top: 40px;"> Instructors </h4>
                                                        <div class="line line-lg b-b b-info w-3x m-auto"></div>
                                                    @endif
                                                    <div class="teacher-section clearfix">
                                                        
                                                          <label title="{{ $user->name }}"><input type="checkbox" name="recipients[]" value="{{ $user->id }}">
                                                              <span class="thumb-sm avatar m-t-n-sm m-b-n-sm m-l-sm"> 
                                                                @if(!empty($user->profile_photo))
                                                                    <img src="{{ url($user->profile_photo) }}">
                                                                @else
                                                                    <img src="{{ url('user/no_photo/no_photo.png') }}">
                                                                @endif
                                                              </span>
                                                              <span>{!!$user->name!!}</span>     
                                                          </label>
                                                    </div>
                                                    <?php $j++; ?>
                                                  @endif
                                              @endif
                                              <?php $i++; ?>
                                          @endforeach
                                      </div>
                                  </div>
                              @endif
                          </div>
                      </div>
                      <div class="col-sm-8">
                          <div class="">
                              <!-- Show the Message form here -->
                              <div class="form-group">
                                  <label class="control-label col-sm-2" for="subject">Subject</label>
                                  <div class="col-sm-10">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="" required="">
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="control-label col-sm-2" for="message">Message</label>
                                  <div class="col-sm-10">
                                      <textarea class="form-control" id="message" name="message" required=""></textarea>
                                  </div>
                              </div>
                              <div class="form-group">        
                                  <div class="col-sm-offset-2 col-sm-10">
                                      <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                              </div>
                          </div>  
                      </div>
                  </form>
              @else
                  <div class="panel">
                      <div class="pos-rlt wrapper b b-light r r-2x bg-danger">
                        <span class="arrow left pull-up arrow-danger"></span>
                        <p class="m-b-none text-white">You only can send message to your coursemates and teachers.</p>
                      </div> 
                 </div>

              @endif
          </div>
          <!-- End of Left bar content -->

          <!-- Right Sidebar -->
          <div class="col-sm-3">
              <div class="panel wrapper-xl bg-offWhite text-center">
                  <a href="{{ url('messages') }}" class="btn btn-lg"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Back to Inbox</a>
              </div>
          </div>

          <!-- End Right Sidebar -->

	    </div>
	</div>
</section>

@endsection