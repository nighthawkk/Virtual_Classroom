<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;


class ForumController extends Controller
{
    //

	public function isCatAuthor($cat_id){
		$category = \DB::table('forum_categories')->where('id','=',$cat_id)->where('cat_author_id','=',Auth::user()->id)->first();
		if(count($category) > 0){
			return true;
		}else{
			return false;
		}
	}

	public function isThreadAuthor($thread_id){
		$thread = \DB::table('forum_threads')->where('id','=',$thread_id)->where('author_id','=',Auth::user()->id)->first();
		if(count($thread) > 0){
			return true;
		}else{
			return false;
		}
	}

}
