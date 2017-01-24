<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\User;
use Auth;

class TeacherController extends Controller
{
    //

    public function getAllCourses(Request $req){
        if(Auth::user()->role_id == 2){
        	$user = $req->user()->id;
        	$courses = \DB::table('courses')->where('user_id','=',$user)->get();
        	return view('teacher.courses')->with(['courses' => $courses,'type' => 'teacher']);
        }
    }


    //single material course page
    public function singleCourseMaterialPage($id){
        if(Auth::user()->role_id == 2){
            $course = Course::find($id);
            $course_enrolled = \DB::table('course_enrolled')->where('course_id','=',$id)->distinct('student_id')->count('student_id');
            $seat_left = $course->max_allowed_student - $course_enrolled;
            $user = User::find($course->user_id);
            $all_courses = Course::where('user_id','=',$user->id)->where('id','!=',$id)->get();
            return view('teacher.course-material')->with(['all_courses' => $all_courses ,'user' => $user,'course' => $course,'enrolled' => $course_enrolled,'seat_left' => $seat_left]);
        	//return view('teacher.course-material')->with(['course' => $course,'user'=> $user,'courses' => $courses]);
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        }
    }
}
