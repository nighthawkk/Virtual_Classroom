<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $fillable=['name', 'status', 'duration', 'course_id'];

    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function questions(){
        return $this->hasMany('App\Question');
    }

    public function hasQuestions(){
        if($this->questions()->get()->count()){
            return true;
        }
        else{
            return false;
        }
    }

    public function answers(){
        return $this->hasMany('App\Answer');
    }

    public function isExamined(){
        if($this->answers()->get()->count()){
            return false;
        }
        return true;
    }
}
