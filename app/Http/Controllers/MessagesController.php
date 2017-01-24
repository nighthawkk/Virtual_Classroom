<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Course;


class MessagesController extends Controller
{
     /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        $currentUserId = Auth::user()->id;
        
        // All threads that user is participating in
        $threads = Thread::forUser($currentUserId)->latest('updated_at')->get();
       
        return view('messenger.index', compact('threads', 'currentUserId'));
    }
    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'Error: Not found!');
            return redirect('messages');
        }
       
        // don't show the current user in list
        $userId = Auth::user()->id;
        //$users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();
        $thread->markAsRead($userId);
        $users = \DB::table('users')->join('participants','participants.user_id','=','users.id')->where('participants.thread_id','=',$id)->get();
        
        foreach($users as $user){
           $ids[] = $user->user_id;
        }
        //restricting other users who are not in conversation from accessing the message
        $user_restrict = in_array(Auth::user()->id, $ids);
        if($user_restrict != true){
            Session::flash('error_message', 'You do not have necessary permission to access the message!');
            return redirect('messages');
        }
        return view('messenger.show', compact('thread', 'users','user_restrict'));
    }
    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $users = [];
        if(Auth::user()->role_id == 1){
            $courses_enrolled = \DB::table('course_enrolled')->select('course_id')->where('student_id',Auth::user()->id)->get();
            foreach($courses_enrolled as $course){
               $users[] = \DB::table('course_enrolled')->join('users','users.id','=','course_enrolled.student_id')->where('course_id','=',$course->course_id)->get();
               $teachers[] = \DB::table('users')->join('courses','users.id','=','courses.user_id')->where('courses.id','=',$course->course_id)->get();
            }
            $merged = array_merge($users,$teachers);
            $flattened = array_flatten($merged);
            //dd($users);
            foreach($flattened as $current){
                $exist[] = $current->id;
            }
            $exist = array_unique($exist);
            //dd($exist);
            foreach($exist as $key => $value){
                $s[] = User::find($value);
            }
            //dd($a);
            //dd($b);
            //dd($exist);
            $users = $s;
            //dd($users);
        }else{
            $courses_enrolled = \DB::table('courses')->join('course_enrolled','course_enrolled.course_id','=','courses.id')->select('student_id')->get();
            foreach($courses_enrolled as $course){
                $users[] = User::find($course->student_id);

            }  
            $users = array_unique($users);
        }
        
        if(count($users) > 0){
            $hide = 0;  
        }else{
            $hide = 1;
        }
        return view('messenger.create', compact('users','hide'));
    }
    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::all();
        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
            ]
        );
        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
            ]
        );
        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant($input['recipients']);
        }
        return redirect('messages');
    }
    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }
        $thread->activateAllParticipants();
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => Input::get('message'),
            ]
        );
        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();
        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(Input::get('recipients'));
        }
        return redirect('messages/' . $id);
    }
    
}
