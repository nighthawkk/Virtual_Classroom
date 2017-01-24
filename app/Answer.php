<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $fillable = ['question_id', 'user_id','topic_id', 'user_answer', 'question', 'option1', 'option2', 'option3', 'option4', 'right_answer', 'time_taken'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function topic(){
        return $this->belongsTo('App\Topic');
    }
}
