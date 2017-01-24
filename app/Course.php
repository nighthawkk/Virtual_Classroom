<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{


	protected $table = 'courses';


    protected $fillable = [
        'title', 'category_id', 'class_number','max_allowed_student','user_id','description','start_date','end_date','thumb_url','large_url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    public function teacher(){
    	return $this->hasOne('App\User','id','user_id');
    }
    

     public function topics(){
        return $this->hasMany('App\Topic');
    }

}
