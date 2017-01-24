<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Http\Requests;
Use App\Course;
use Image;
use App\User;
use Auth;

class CourseController extends Controller
{
    //

    public function getCreateCourseView(){
        if(Auth::user()->role_id == 2){
            return view('courses.create');      
        }else{
            return 'You do not have permission to access this page';
        }
    }


    // Show all courses 
    public function showAll(){
    	$courses = \DB::table('courses')->join('users','users.id', '=','courses.user_id')
                    ->select('courses.*','users.name')->get();
         //dd($courses);
    	return view('courses.courses')->with(['courses' => $courses]);
    }

    //Show single course
    public function showSingle($id){
        $course = Course::find($id);
        $course_enrolled = \DB::table('course_enrolled')->where('course_id','=',$id)->distinct('student_id')->count('student_id');
        $seat_left = $course->max_allowed_student - $course_enrolled;
        $user = User::find($course->user_id);
        $all_courses = Course::where('user_id','=',$user->id)->where('id','!=',$id)->get();
    	return view('courses.single')->with(['all_courses' => $all_courses ,'user' => $user,'course' => $course,'enrolled' => $course_enrolled,'seat_left' => $seat_left]);
    }


    //Enroll a student

    public function enroll(Request $req, $id){
        if($req->user()->role_id == 1){
            $course_id = $id;
            $user_id = $req->user()->id;
            $enrolled_id = \DB::table('course_enrolled')->where([
                    [ 'course_id', $course_id ],
                    [ 'student_id', $user_id ]
                ])->get();
            if(count($enrolled_id) < 1){
                if($course_id != null && !empty($course_id)){
                \DB::table('course_enrolled')->insert([
                        'course_id' => $course_id,
                        'student_id' => $user_id
                    ]);
                return view('courses.thanks')->with(['message' => 'Ureka! You have successfully enrolled!','course_id' => $course_id]);
                }else{
                    return \Redirect::back()->withErrors(['Something went wrong! You can not enrolled in this course this right now!']);
                }
            }else{
                return \Redirect::back()->withErrors(['You are already enrolled in this course!']);
            }
        }else{
            return \Redirect::back()->withErrors(['Only students are allowed to enroll in a course!']);
        }
        
        
    }



    // Search functionality 

    public function search(Request $req){
        $search_criteria = $req->input('search');
        $this->validate($req,[
            'search' => 'required'
            ]);
        $courses = \DB::table('courses')->where('title','like','%'.$search_criteria.'%')->join('users','users.id', '=','courses.user_id')->select('courses.*','users.name')->get();
        return view('courses.courses')->with(['courses' => $courses,'type' => 'student']);
    }






    //Create a course 

    public function create(Request $req){
        $image = $req->file('image');

        $url = $this->imageManipulate($image);

        // replace the point from the european date format with a dash
        $date = str_replace('/', '-', $req->input('start_date'));
        // create the mysql date format
        $date = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
        $data = [
            'title' => $req->input('title'),
            'category_id' => $req->input('category_id'),
            'class_number' => $req->input('class_number'),
            'user_id' => $req->user()->id,
            'max_allowed_student' => $req->input('max_allowed_student'),
            'start_date' => $date,
            'thumb_url' => $url['thumb'],
            'large_url' => $url['large'],
            'description' => $req->input('description')
            ];

        $this->validate($req,[
            'title' => 'required',
            'category_id' => 'required',
            'class_number' => 'required',
            'max_allowed_student' => 'required',
            'start_date' => 'required',
            'description' => 'required'
            ]);
        
        $id = \DB::table('courses')->insertGetId($data);
        if($id != null){
            return redirect('teacher/courses')->with('message','Course Created Successfully!');
        }
    }



    public function imageManipulate($obj){
        $image = $obj;
        $thumbImageUrl = $this->resize($image,250,'thumb');        
        $largeImageUrl = $this->resize($image,1600,'large');  
        $url = [
            'thumb' => $thumbImageUrl,
            'large' => $largeImageUrl
        ];
        return $url;
    }


    public function resize($image,$size,$type){
        try{
            $extension      =   $image->getClientOriginalExtension();
            $imageRealPath  =   $image->getRealPath();
            $thumbName      =   $type.'_'. $image->getClientOriginalName();
            
            //$imageManager = new ImageManager(); // use this if you don't want facade style code
            //$img = $imageManager->make($imageRealPath);
        
            $img = Image::make($imageRealPath); // use this if you want facade style code
            $img->resize(intval($size), null, function($constraint) {
                 $constraint->aspectRatio();
            });
            $path = public_path('course/imgs').'/'.time(). $thumbName;
            $img->save($path);

            return $path;

        }catch(Exception $e){

            return false;
        }
    }

    // Update course 
    public function editCourse($course_id,Request $req){
        if($req->user()->role_id == 2){
            $data = [
                'class_number' => $req->input('class_number'),
                'max_allowed_student' => $req->input('max_allowed_student'),
                'description' => $req->input('description')
            ];

            $this->validate($req,[
                'class_number' => 'required',
                'max_allowed_student' => 'required',
                'description' => 'required'
                ]);
            $course = Course::find($course_id);
            if($course->update($data)){
                return \Redirect::back()->withErrors(['Course updated successfully!']);
            }
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        }

    }
    //Delete course
    public function deleteCourse($course_id){
        $course = Course::find($course_id)->delete();
        return redirect('teacher/courses')->with('message','Course Deleted Successfully!');
    }

    //Get the class page 

    public function getClassPage($course_id){
        $course = Course::find($course_id);
        $teacher = User::where('id','=',$course->user_id)->get()->first();
        return view('courses.class')->with(['course' => $course,'teacher' => $teacher ]);
    }


}
