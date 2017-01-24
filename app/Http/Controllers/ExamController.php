<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\Topic;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Answer;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\TopicRequest;
use App\Question;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    //

	//Get all the exam topics for one course
     public function index($course_id){
        $topics = Topic::where('course_id',$course_id)->paginate(5);
        $title = "Topics";
        $course = Course::find($course_id);
        return view('vendor.exam.all-topic')->with(['topics' => $topics, 'title' => $title,'course' => $course ]);
    }


    //Create a new topic for the course exam
    public function createNewTopic($course_id, Request $req){
        if(Auth::user()->role_id == 2){
            $topic = new Topic($req->all());
            $course = Course::find($req->input('course'));
            $course->topics()->save($topic);
            session()->flash('flash_mess', 'Topic was created completely');
    		return redirect()->action('ExamController@index', ['course_id' => $course_id]);
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        }
    }


    //Get the new topic create view
    public function getNewTopicCreateView($course_id){
        if(Auth::user()->role_id == 2){
        	$course = Course::find($course_id);
        	return view('vendor.exam.new-topic')->with(['course' => $course]);
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        }
    }


    // get Edit the topic view
    public function getEdit($course_id,$topic_id){
        if(Auth::user()->role_id == 2){
        	$topic = Topic::findOrFail($topic_id);
            $title = "Edit topic '{$topic->name}'";
            $course = Course::find($course_id);
            return view('vendor.exam.edit-topic')->with(['topic' => $topic,'title' => $title,'course' => $course]);
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        }
    }

    //Delete the topic
    public function getDelete($course_id, $topic_id){
        if(Auth::user()->role_id == 2){
        	 $topic = Topic::findOrFail($topic_id);
            Topic::destroy($topic_id);
            session()->flash('flash_mess', 'Topic  was deleted');
    		return redirect()->action('ExamController@index', ['course_id' => $course_id]);
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        }
    }


    //Update the topic
    public function updateTopic($course_id,$topic_id, Request $req){
        if(Auth::user()->role_id == 2){
        	$data = [
        		'name' => $req->input('name'),
        		'course_id' => $req->input('course'),
        		'duration' => $req->input('duration'),
        		'status' => $req->input('status')
        	];
        	$this->validate($req,[
        		'name' => 'required',
        		'duration' => 'required'
        		]);
        	$topic = Topic::find($topic_id);
        	$topic->update($data);
        	return redirect()->action('ExamController@index',['course_id' => $course_id]);
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        }

    }



      // Get the questions of topic
    public function getQuestions($course_id,$topic_id){
    	$topic = Topic::findOrFail($topic_id);
        $title = "Manage questions";
        $answer = ['1'=>1, '2'=>2,'3'=> 3,'4'=> 4];
        $questions = $topic->questions;
        $title_button = "Save question";
        $course = Course::find($course_id);
        //dd($questions);
        return view('vendor.exam.questions')->with(['topic' => $topic,'title' => $title, 'answer' => $answer , 'questions' => $questions, 'title_button' => $title_button, 'course' => $course]);
    }

    //Create a New question
    public function postNewQuestion($course_id,$topic_id, Request $req){
        if(Auth::user()->role_id == 2){
        	$topic = Topic::find($topic_id);
        	$question = new Question($req->all());
        	$topic->questions()->save($question);
        	session()->flash('flash_mess','Question was added successfully.');
        	return redirect(action('ExamController@getQuestions',['course_id' => $course_id,'id' => $topic_id]));
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        }
    }

    //Delete the question
    public function deleteQuestion($course_id,$topic_id,$question_id){
        if(Auth::user()->role_id == 2){
            Question::destroy($question_id);
            session()->flash('flash_mess', 'Question #'.$question_id.' was deleted');
            return redirect(action('ExamController@getQuestions', ['course_id'=> $course_id, 'id' =>  $topic_id ]));
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        }
    }

    //Update the question
    public function updateQuestion($course_id,$topic_id,$question_id,Request $req){
        if(Auth::user()->role_id == 2){
        	$question = Question::findOrFail($question_id);
            $question->update($req->all());
            session()->flash('flash_mess', 'Question #'.$question->id.' was changed completely');
            return redirect(action('ExamController@getQuestions', ['course_id'=> $course_id, 'id' => $topic_id ]));
        }else{
            return \Redirect::back()->withErrors(['You are not allowed to perform this action!']);
        }
    }


    // get the before exam start view
    public function getBeforeStartTest($course_id,$topic_id,Request $req){
        $course = Course::find($course_id);
        $topic = Topic::find($topic_id);
        $req->session()->forget('next_question_id');
        //setcookie('next_question_id','test');
        return view('vendor.exam.start')->with(['topic' => $topic, 'course' => $course]);
    }

    //Get the exam start
    public function getStartTest($course_id,$topic_id, Request $req){
        $course = Course::find($course_id);
        $topic = Topic::find($topic_id);
        $questions = $topic->questions()->get();
        //dd($questions);
        $first_question_id = $topic->questions()->min('id');
        //dd($first_question_id);
        $last_question_id = $topic->questions()->max('id');
        //dd($last_question_id);
        $duration = $topic->duration;
        //dd(session('next_question_id'));
        
        if($req->session()->get('next_question_id')){
            $current_question_id = $req->session()->get('next_question_id');
            //dd($current_question_id);
        }
        else{
            $current_question_id = $first_question_id;
            $req->session()->put('next_question_id', $current_question_id );
            //dd($current_question_id);
        }
        
       
        return view('vendor.exam.exam')->with(['topic' => $topic,'questions' => $questions , 'current_question_id' => $current_question_id ,'first_question_id' => $first_question_id ,'last_question_id' => $last_question_id , 'duration' => $duration, 'course' => $course ]);
    }
    

    // Save result
    public function postSaveQuestionResult($course_id,$topic_id, Request $req){
        dd($req->input('question_id'));
        dd($req->session()->get('next_question_id'));
        $topic = Topic::find($topic_id);
        $question = Question::find($req->input('question_id'));
        if($req->input('option') != null){
            //save the answer into table
            $duration = $topic->duration*60;
            $time_taken = $req->input('time_taken'.$question->id);
            $time_per_question = $duration - $time_taken;
            //dd($time_taken);
            Answer::create([
                'user_id'=>Auth::user()->id,
                'question_id'=>$req->input('question_id'),
                'topic_id' => $topic_id,
                'user_answer'=>$req->input('option'),
                'question' => $question->question,
                'option1' => $question->option1,
                'option2' => $question->option2,
                'option3' => $question->option3,
                'option4' => $question->option4,
                'right_answer'=>$question->answer,
                'time_taken'=>$time_per_question
            ]);
        }
        $next_question_id = $topic->questions()->where('id','>',$req->input('question_id'))->min('id');
        
        if($next_question_id != null) {
            return Response::json(['next_question_id' => $next_question_id]);
        }
        
        return redirect(action('ExamController@showTopicResult',['course_id' => $course_id, 'id' => $topic_id]));
    }


    public function showTopicResult($course_id,$topic_id){
        $topic = Topic::findOrFail($topic_id);
        $answers = Answer::where('topic_id',$topic_id)->get();
        if($answers->count()) {
            $cnt = $answers->count();
            $cnt_right_answ = 0;
            foreach ($answers as $a) {
                if ($a->user_answer == $a->right_answer)
                    $cnt_right_answ++;
            }
            $percentages = ceil($cnt_right_answ * 100 / $cnt);
            $time_taken = gmdate("H:i:s", Answer::where('topic_id',$topic_id)->orderBy('id', 'desc')->first()->time_taken);
            $title = 'Results of test';
            session()->flash('flash_mess', 'Your Exam data has been saved successfully');
            return view('vendor.exam.result')->with(['topic' => $topic, 'title' => $title , 'cnt' => $cnt ,'cnt_right_answ' => $cnt_right_answ, 'percentages' => $percentages,'time_taken' => $time_taken]);
            }
        else{
            return redirect('/');
         }
    }


    //Get all topic results
     public function getAllTopicsResults(){
        $title = 'Exams Results';
       $answers = DB::table('answers as t1')->
        select(DB::raw('
                t1.*, t2.*,t3.*,
                t2.name as username, t2.email as useremail, t3.name as subjectname,
                SUM(IF(t1.user_answer=t1.right_answer,1,0))/(SELECT COUNT(DISTINCT id) FROM answers t1 GROUP BY subject_id)*100 AS porcent,
                max(time_taken) as time
            '))
           ->leftJoin('users as t2', function($join){
                $join->on('t1.user_id', '=','t2.id');
            })
            ->leftJoin('subjects as t3', function($join){
                $join->on('t1.subject_id', '=','t3.id');
           })->groupBy('t1.subject_id')->get();
        return view('vendor.exam.results')->with(['title' => $title,'answers' => $answers]);
    }
}   
