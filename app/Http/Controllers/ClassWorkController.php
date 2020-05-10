<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use Session;
use App\Http\Helpers\CommonHelper;
use App\ClassTopic;
use App\ClassWork;
use App\ClassTiming;


class ClassWorkController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
	
	
		 
    public function __construct()
    {
		
    }

    public function index(){
		
		 $logged_teacher = Session::get('teacher_session');
		 $logged_teacher_id = $logged_teacher['teacher_id'];
	
		 
        $class_list = ClassTiming::with('studentClass','studentSubject')->where('teacher_id',$logged_teacher_id)->get();

        $links = array();
        foreach ($class_list AS $value) {
            $assignment =  ClassWork::where('class_id', $value->class_id)->where('subject_id',$value->subject_id)->where('teacher_id',$logged_teacher_id)->first();
            
                $links[$value->class_id][$value->subject_id]['id'] = (!empty($assignment))? $assignment->id:'';
                $links[$value->class_id][$value->subject_id]['g_live_link'] = (!empty($assignment))? $assignment->g_live_link:'';
               // $links[$value->class_id][$value->subject_id]['g_class_id'] = (!empty($assignment))? $assignment->g_class_id:'';
				
        } 
    	return  view('teacher.assignment.index',compact('class_list','links'));
    	//return  view('teacher.assignment.index');
    }

	
     public function ajaxCreateAssignment(Request $request)
    {   
	
		 $logged_teacher = Session::get('teacher_session');
		 $logged_teacher_id = $logged_teacher['teacher_id'];
		
        $class_id = $request->class_id;
        $subject_id = $request->subject_id;
        $g_class_id = $request->g_class_id;
        $topic_name = $request->topic_name;
        $title = $request->assignment_title;
      
		
		$g_topic_id = '';
		
		
		/* if($topic_name == ''){
            return json_encode(array('status'=>'error', 'message'=> 'Topic Name Required.'));
        } */
        if($title == ''){
            return json_encode(array('status'=>'error', 'message'=> 'Title Required.'));
        }
		
		$token = CommonHelper::varify_Teachertoken(); // verify Teacher token 	

		
		if($topic_name != '')
		{
			$data = array( "name" => $topic_name );
			$data = json_encode($data);
			
			$responce = CommonHelper::create_topic($token,$g_class_id,$data); // access Google api craete Topic
			$resData = array('error'=> '');
		
			if($responce == 101)
			{
				return json_encode(array('status'=>'error', 'message'=> Config::get('constants.WebMessageCode.119')));
			}
			else
			{	
				$resData = array_merge($resData,json_decode($responce,true));
				if($resData['error'] != '')
				{
					return json_encode(array('status'=>'error', 'message'=> $resData['error']['message']));
				}	
				else
				{
					
					$g_topic_id = $resData['topicId'];
					
					$obj_topic = new ClassTopic;
					$obj_topic->topicname = $topic_name;
					$obj_topic->class_id = $class_id;
					$obj_topic->g_topic_id = $g_topic_id;
					
					$obj_topic->save();
					$topic_id = $obj_topic->id;  // Last Insert Id 
				}
			}
		}
		
		
		$array_data = array(
								"title" => $title,
							  "workType" => "ASSIGNMENT",
							  "state" => "PUBLISHED",
							  "topicId"=> $g_topic_id,
							  "description" => "Open 3 dots in right side and click edit"
									);
		
		$array_data = json_encode($array_data);
		
		$work_response = CommonHelper::create_courcework($token,$g_class_id,$array_data);
		$w_resData = array('error'=> '');
				
		if($work_response == 101)
			{
				return json_encode(array('status'=>'error', 'message'=> Config::get('constants.WebMessageCode.119')));
			}
			else
			{
				$w_resData = array_merge($w_resData,json_decode($work_response,true));
				if($w_resData['error'] != '')
				{
					return json_encode(array('status'=>'error', 'message'=> $resData['error']['message']));
				}	
				else
				{
				
						$cource_url = $w_resData['alternateLink'];
						
						$classWork = new ClassWork;
						$classWork->class_id = $class_id;
						$classWork->g_live_link = $w_resData['alternateLink'];
						$classWork->g_class_id = $g_class_id;
						$classWork->classwork_type = $w_resData['workType'];
						$classWork->topic_id = $topic_id;
						/* $classWork->g_points = '';
						$classWork->g_status = '';
						$classWork->g_action = ''; */
						$classWork->g_title = $w_resData['title'];
						//$classWork->g_due_date = '';
						$classWork->teacher_id = $logged_teacher_id;
						//$classWork->timetable_id = $timing_id;
						$classWork->subject_id = $subject_id;
						$classWork->save();
					
						return json_encode(array('status'=>'success', 'cource_url'=>$cource_url , 'message'=> Config::get('constants.WebMessageCode.127')));
				}
			}
	} 
}
