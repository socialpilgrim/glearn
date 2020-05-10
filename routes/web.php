<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@index');


/* for testing   */
/* Route::get('/dashboard','GtestController@index')->name('dashboard');

Route::get('/gtest','GtestController@create_class')->name('gtest');
Route::get('/set_course','GtestController@set_course')->name('set_course');
Route::get('/get_token','GtestController@get_token')->name('get_token');
Route::get('/get_course','GtestController@get_course')->name('get_course');
Route::get('/create_teacher','GtestController@create_teacher')->name('create_teacher');
Route::get('/user_permission/{id}','GtestController@test_user_permission');
Route::get('/create_user','GtestController@create_user'); */
// ------ //

/*  Admin  */
Route::post('/admin/login', 'AdminController@admin_login_post')->name('admin.login.post');
Route::get('/admin/login', 'AdminController@admin_login_get')->name('admin.login');

Route::group(['middleware' => 'adminsession'], function() {

	Route::get('/admin/dashboard','AdminController@adminDashboard')->name('admin.dashboard');
	Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');
	Route::match(array('GET','POST'),'/admin/add-teacher','TeacherController@addTeacher')->name('teacher.add');
	Route::match(array('GET','POST'),'/admin/edit-teacher/{id}','TeacherController@editTeacher')->name('teacher.edit');
	Route::post('/admin/delete-teacher/{id}','TeacherController@deleteTeacher')->name('teacher.delete');
	/*Support Help*/
	Route::get('/admin/support-help','HelpController@helpList')->name('admin.helplist');
	Route::get('/admin/list-timetable','ImportTimetableController@listTimetable')->name('list.timetable');
	Route::match(array('GET','POST'),'/admin/admin_profile','AdminController@adminProfile')->name('admin.profile');

	Route::get('/admin/classes','ClassController@list_class')->name('admin.listClass');
	Route::match(array('GET','POST'),'/admin/create-classes','ClassController@addClasses')->name('classes.add');

	Route::get('/list-timetable','ImportTimetableController@listTimetable')->name('list.timetable');
	Route::match(array('GET','POST'),'/timetable-import','ImportTimetableController@timeTableImport')->name('admin.timetableimport');
	Route::get('/download-sample','ImportTimetableController@sampleDownload')->name('admin.sampleDownload');
	
	Route::get('/admin/list-students','ImportStudentsController@listStudents')->name('list.students');
	Route::get('/list-students','ImportStudentsController@listStudents')->name('list.students');
	Route::match(array('GET','POST'),'/students-import','ImportStudentsController@importClassStudentNumber')->name('admin.studentsimport');
	Route::get('/download-students','ImportStudentsController@sampleStudentsDownload')->name('admin.sampleStudentsDownload');
});


/*  Teacher  */
Route::post('/teacher/login','TeacherLoginController@teacher_login_post')->name('teacher.login.post');
Route::get('/teacher/login','TeacherLoginController@teacher_login_get')->name('teacher.login');


Route::group(['middleware' => 'teachersession'], function() {

	Route::get('/teacher/home','TeacherLoginController@teacherDashboard')->name('teacher.dashboard'); 

	Route::get('/teacher/logout', 'TeacherLoginController@logout')->name('teacher.logout');

	//Route::get('/teacher/home', 'HomeController@teacherHome')->name('teacher.home');


	Route::post('/teacher/add-class', 'HomeController@addClass')->name('add.class');

	Route::get('/teacher/quiz', 'QuizController@index')->name('teacher.quiz');
	
	Route::get('/teacher/assignment', 'ClassWorkController@index')->name('teacher.assignment');
	Route::post('/create-assignment', 'ClassWorkController@ajaxCreateAssignment');
	
	
	Route::get('/teacher/report', 'ReportController@index')->name('teacher.report'); 
		
	Route::post('/generate-help-ticket', 'HelpController@generateHelpTicket')->name('teacher.generate_ticket');
	Route::post('/update-profile-picture', 'HomeController@updateProfilePicture')->name('teacher.profile_picture');
	Route::post('/update-name', 'HomeController@updateName')->name('teacher.name');

});