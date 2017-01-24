<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login','WelcomeController@login');
Route::get('/signup','WelcomeController@signup');
Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/register/course',['middleware' => 'auth', 'uses' => 'CourseController@getCreateCourseView']);
Route::post('/register/course',['middleware' => 'auth' , 'uses' => 'CourseController@create']);
Route::get('courses','CourseController@showAll');
Route::post('search','CourseController@search');
Route::post('user/profile/upload-photo',['middleware' => 'auth', 'uses' => 'UserProfileController@uploadPhoto']);
Route::post('user/profile/edit-name',['middleware' => 'auth' , 'uses' => 'UserProfileController@updateName']);
Route::get('user/profile',['middleware' => 'auth', 'uses' => 'UserProfileController@getProfile']);


//Course
Route::group(['prefix' => 'course'],function(){
	Route::get('{id}','CourseController@showSingle');
	Route::get('{id}/enroll',['middleware' => 'auth', 'uses' => 'CourseController@enroll']);
	Route::get('{id}/class',['middleware' => 'auth', 'uses' => 'CourseController@getClassPage']);

	Route::post('{id}/update',['middleware' => 'auth', 'uses' => 'CourseController@editCourse']);
	Route::post('{id}/delete',['middleware' => 'auth', 'uses' => 'CourseController@deleteCourse']);
});

// Teacher
Route::group(['prefix' => 'teacher'], function(){
	Route::get('my-course/{id}',['middleware' => 'auth' , 'uses' => 'TeacherController@singleCourseMaterialPage']);
	Route::get('courses',['middleware' => 'auth' , 'uses' => 'TeacherController@getAllCourses']);
	Route::get('profile',['middleware' => 'auth', 'uses' => 'UserProfileController@getProfile']);

});



//Student
Route::group(['prefix' => 'student'], function(){
	Route::get('courses',['middleware' => 'auth','uses' => 'StudentController@showAllCourses']);
	Route::get('my-course/{id}',['middleware' => 'auth', 'uses' => 'StudentController@singleCourseMaterialPage']);
	Route::get('course/{course_id}/exams/open',['middleware' => 'auth' , 'uses' => 'StudentController@getOpenExamsPage']);
});



//Library

Route::group(['prefix' => 'vc/library'], function(){
	Route::get('/','LibraryController@getBooks');
	Route::get('new',['middleware' => 'auth', 'uses' => 'LibraryController@addBookView']);
	Route::post('save',['middleware' => 'auth','uses' => 'LibraryController@saveBook']);
});



//Messaging/chat

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'middleware' => 'auth','uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create','middleware' => 'auth', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store','middleware' => 'auth', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show','middleware' => 'auth', 'uses' => 'MessagesController@show']);
    Route::post('{id}', ['as' => 'messages.update', 'middleware' => 'auth','uses' => 'MessagesController@update']);
});



//Exam 
Route::group(['prefix' => 'exam'], function(){
	Route::get('course/{course_id}/topic/new',['middleware' => 'auth' , 'uses' => 'ExamController@getNewTopicCreateView']);
	Route::get('course/{course_id}/topic/all',['middleware' => 'auth' , 'uses' => 'ExamController@index']);
	Route::get('course/{course_id}/topic/{topic_id}', ['middleware' => 'auth', 'uses'=>'ExamController@getQuestions']);
	Route::get('course/{course_id}/topic/{topic_id}/edit',['middleware' => 'auth' , 'uses' => 'ExamController@getEdit']);
	Route::get('course/{course_id}/topic/{topic_id}/delete',['middleware' => 'auth', 'uses' => 'ExamController@getDelete']);
	Route::get('course/{course_id}/topic/{topic_id}/question/{question_id}/delete',['middleware' => 'auth', 'uses' => 'ExamController@deleteQuestion']);
	Route::get('course/{course_id}/topic/{topic_id}/start',['middleware' => 'auth','uses' => 'ExamController@getBeforeStartTest']);
	Route::get('course/{course_id}/topic/{topic_id}/start-test',['middleware' => 'auth','uses' => 'ExamController@getStartTest']);
	Route::get('course/{course_id}/topic/{topic_id}/result',['middleware' => 'auth', 'uses' => 'ExamController@showTopicResult']);
	Route::get('course/{course_id}/topic/{topic_id}/results',['middleware' => 'auth', 'uses' => 'ExamController@getAllTopicsResults']);


	Route::post('course/{course_id}/topic/create',['middleware' => 'auth', 'uses' => 'ExamController@createNewTopic']);
	Route::post('course/{course_id}/topic/{topic_id}/update',['middleware' => 'auth', 'uses' => 'ExamController@updateTopic']);
	Route::post('course/{course_id}/topic/{topic_id}/question/create',['middleware' => 'auth', 'uses' => 'ExamController@postNewQuestion']);
	Route::post('course/{course_id}/topic/{topic_id}/question/{question_id}/update',['middleware' => 'auth', 'uses' => 'ExamController@updateQuestion']);
	Route::post('course/{course_id}/topic/{topic_id}/save-question-result',['middleware' => 'auth','uses' => 'ExamController@postSaveQuestionResult']);

});