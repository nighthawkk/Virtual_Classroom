@extends('layouts.app')


<?php 

$file_path = base_path()."/public/includes/data.inc";
include($file_path); 
?>

@section('content')
<section class="bg-dark">
    <div class="container">
        <div class="row p-t-xxl">
            <div class="col-sm-8 col-sm-offset-2 p-v-xxl text-center">
                <h1 class="h1 m-t-l p-v-l">Create a course</h1>
            </div>
        </div>
    </div>
</section>

    
<section class="p-v-xxl bg-light">
    <div class="container">
        <div class="row p-t-xxl content">

        	
			@if($errors->has())
				@foreach ($errors->all() as $error)
				  <div class="pos-rlt wrapper b b-light r r-2x bg-danger">
                      <span class="arrow left pull-up arrow-danger"></span>
                      <p class="m-b-none text-white">{{ $error }}</p>
                  </div>
				@endforeach
			@endif
        
			<div class="create-course-teacher col-sm-9">
				<form class="form-horizontal" role="form" action="{{ url('register/course') }}" method="post" enctype="Multipart/form-data">
				    {{ csrf_field() }}
				    <div class="form-group">
				      <label class="control-label col-sm-2" for="email">Name</label>
				      <div class="col-sm-10">
				        <input type="text" class="form-control" id="email" name="title" placeholder="Enter name of the course" required="">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-sm-2" for="email">Category</label>
				      <div class="col-sm-10">
				         <select name="category_id" id="" class="form-control" required="">
				         	@foreach($category as $key => $value)
				         	    <option value="{{ $key }}">{{ $value }}</option>
				         	 @endforeach
				         </select>
				      </div>
				    </div>

				    <div class="form-group">
				    	<label for="class_number" class="col-sm-2 control-label">Number of Classes</label>
				    	<div class="col-sm-10">
				    		<input type="number" name="class_number" class="form-control" required="">
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label for="class_number" class="col-sm-2 control-label">Maximum Allowed Students ( max 20 )</label>
				    	<div class="col-sm-10">
				    		<input type="number" name="max_allowed_student" class="form-control" min="1" max="20" required="">
				    	</div>
				    </div>
				    <div class="form-group">
				    	<label for="class_number" class="col-sm-2 control-label">Start Date</label>
				    	<div class="col-sm-10 input-append date" id="dp3" data-date="12-02-2012" data-date-format="yyyy-mm-dd" id="dp3">
				    		<input type="text" name="start_date" class="form-control" id="dp5" required="">
				    		  <span class="add-on"><i class="icon-th"></i></span>
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="class_number" class="col-sm-2 control-label">Add one image</label>
				    	<div class="col-sm-10 input-append date">
				    		<input type="file" name="image" class="control" id="" required="">
				    	</div>
				    </div>

				    <div class="form-group">
				    	<label for="class_number" class="col-sm-2 control-label">Description</label>
				    	<div class="col-sm-10">
				    		<textarea name="description" class="form-control" id="summernote" cols="30" rows="10" required=""></textarea>
				    	</div>
				    </div>
				    
				    <div class="form-group">        
				      <div class="col-sm-offset-2 col-sm-10">
				        <button type="submit" class="btn btn-primary">Submit</button>
				      </div>
				    </div>
				  </form>
			</div>	

			<!-- Right Sidebar -->
			<div class="col-sm-3">
				<div class="panel wrapper-xl bg-offWhite text-center">
                  <a href="{{ url('teacher/courses') }}" class="btn btn-lg"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Back to My Courses</a>
              </div>
			</div>
			<!-- End Right Sidebar -->	
		</div>
	</div>
</section>
	
	


@endsection