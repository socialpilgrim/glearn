<?php

namespace App\Http\Controllers;
use App\Http\Helpers\CustomHelper;
use Illuminate\Support\Facades\Config;
use App\Teacher;
use Illuminate\Http\Request;
use Google_Client;
use Session;
use App\ClassTiming;


class TeacherLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function teacher_login_post(Request $request)
    {
         $session_token = Session::get('access_token_teacher');
        if (isset($session_token['access_token_teacher']) && $session_token['access_token_teacher'])
          {
              $res = $this->verify_email_DB();
			   if($res == 101 )
			   {
					 return back()->with('error', Config::get('constants.WebMessageCode.118'));
					 $this->logout();
				} 
				else
				{
					return redirect()->route('teacher.dashboard');
				} 
               
    
          }
          else
          {
              $auth_url = CustomHelper::set_token_teacher();
              return redirect($auth_url);
          }
    
    
      }
      public function teacher_login_get()
      {

			if (!isset($_GET['code'])) 
			{
				$auth_url = CustomHelper::set_token_teacher();
				return redirect($auth_url);
			}
			else
			{
				$code = $_GET['code'];
			   
				CustomHelper::get_token_teacher($code);
				
			   $res = $this->verify_email_DB();

			  // print_r($res);
			   /*  echo $code;*/
			   //echo  $responce->email;
			  
				if($res == 101 )
				{
					 return back()->with('error', Config::get('constants.WebMessageCode.118'));
					 $this->logout();
				} 
				else
				{
					return redirect()->route('teacher.dashboard');
				} 
				//print_r($responce); 
				//echo $responce['email']; 
			
			}
      }
       public function teacherDashboard(Request $request)
      {
         $logged_teacher = Session::get('teacher_session');
		 $logged_teacher_id = $logged_teacher['teacher_id'];
		 
		 $days = "Monday";//date('l');
		 
		 $teacherData = ClassTiming::with('studentClass','studentSubject')->where('class_day',$days)->where('teacher_id',$logged_teacher_id)->get();
		 
		 $todaysDate = date("d M");
		 
		// dd($logged_teacher_id);
		/* $sql='select DATE_FORMAT(CURDATE() , "%d %M") tdate, class_day, from_timing, to_timing, class_name, section_name, subject_name
						from tbl_techers t
						left join tbl_class_timings c on t.id = c.teacher_id and c.class_day="Monday"
						left join tbl_student_classes s on c.class_id = s.id
						left join tbl_student_subjects ss on c.subject_id = ss.id
						where t.id = '. $logged_teacher_id;

		 $teacherData = \DB::select($sql); */

		// print_r($teacherData);
		// echo date('l')
		//echo $todaysDate;
		 //exit;
		 
         return view('teacher.dashboard', compact('teacherData','todaysDate'));
      } 
    
      public function logout(Request $request) 
      {
			Session::forget('access_token_teacher');
			Session::forget('teacher_session');
			return redirect(url('/'));
      }

	public function verify_email_DB()
	{

		 $session_token = Session::get('access_token_teacher');
		  $responce = CustomHelper::get_user_from_token($session_token['id_token']);  
		  $responce = json_decode($responce,true);
		  $credentials = $responce['email'];;
		  
		
		  $teacher = Teacher::where('email',$credentials)->first();;
		 
			
		   if (!empty($teacher)) { 
					$name = $teacher['name'];//.' '.$teacher['last_name'];
				 Session::put('teacher_session',array('teacher_id' => $teacher['id'],'teacher_email' =>$teacher['email'],'teacher_name'=>$name));
				return 100;
		   }else{
				return 101;
			  } 
	}


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
