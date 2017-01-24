<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\Topic;
use App\User;
use Auth;
class StudentController extends Controller
{
    //Show all courses of a student

    public function showAllCourses(Request $req){
        if(Auth::user()->role_id == 1){
        	$student_id = $req->user()->id;
        	$courses = \DB::table('courses')
        				->join('course_enrolled', function($join){
        					 $join->on('courses.id','=','course_enrolled.course_id');
        				})
                        ->join('users',function($join){
                            $join->on('users.id','=','courses.user_id');
                        })
        				->where('course_enrolled.student_id','=',$student_id)
        				->get();

            //dd($courses);
        	
        	return view('student.courses')->with(['courses' => $courses]);
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        }

    }

    //single material course page
    public function singleCourseMaterialPage($id){
        if(Auth::user()->role_id == 1){
            $course = Course::find($id);
            $course_enrolled = \DB::table('course_enrolled')->where('course_id','=',$id)->distinct('student_id')->count('student_id');
            $seat_left = $course->max_allowed_student - $course_enrolled;
            $user = User::find($course->user_id);
            return view('student.course-material')->with(['user' => $user,'course' => $course,'enrolled' => $course_enrolled,'seat_left' => $seat_left]);
        	//return view('student.course-material')->with(['course' => $course]);
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        } 
    }


    //Get the private profile of Student
    public function getPrivateProfile(Request $req){
         if(Auth::user()->role_id == 1){
            $st_information = $req->user();
            if(!empty($st_information) || count($st_information) > 0) {
                return view('student.profile-private')->with(['user' => $st_information]);
            }
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        }
    }


    //Get the open exam view page
    public function getOpenExamsPage($course_id){
        if(Auth::user()->role_id == 1){
            $course = Course::find($course_id);
            $exams = Topic::where('course_id',$course_id)->where('status',0)->get();
            return view('student.open-exams')->with(['exams' => $exams, 'course' => $course ]);
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        }
    }
}
