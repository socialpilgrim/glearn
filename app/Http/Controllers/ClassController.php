<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
//use Auth;
use Validator;
use App\Http\Helpers\CommonHelper;
use App\StudentClass;
use App\Teacher;
use App\StudentSubject;
use DB;
use App\ClassTiming;
use App\InvitationClass;

class ClassController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
      //  return Auth::guard('admin');
    }

    /**
     * Show the application dashboard.|min:8
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	 
	public function list_class()
	{
		$classes = StudentClass::all();
     // echo "<pre>";print_r($classes);exit;
      //$timetables = array();
      //return view('admin.timetable.index');
      
		return view('admin.class.list_class',compact('classes'));	
	} 
	 
     public function addClasses(Request $request)
    {
		$teacher_id = '';
		$g_teacher_id = '';
		$islunch = 0;
          if($request->isMethod('post')) {
			  
			  $allocate_email = "me";
            $request->validate([ 
              'class_name' => 'required|max:100',
              'subject' => 'required',
              'section' => 'required|max:100',
              'class_heading' => 'required|max:100',
              'description' => 'required|max:100',
              'room' => 'required|numeric',
			   'days' => 'required',
			  'start_time' => 'required',
			  'end_time' => 'required'
             
            ]);
			
		
				
				$obj_teacher = Teacher::where('id',$request->teacher)->get();
				$g_teacher_id = $obj_teacher[0]['g_user_id'];
				$teacher_id = $request->teacher;
				if($request->islunch == 1){
				$islunch = $request->islunch;
				}
				//$allocate_email = $obj_teacher[0]['email'];
			
			
		
			
			$subject_name = StudentSubject::where('id',$request->subject)->get();
			
			$sub_name = $subject_name[0]['subject_name'];
		
			
		 	$data = array( 
							  "name"=> $request->class_name.' '.$sub_name,
							  "section"=> $request->section,
							  "descriptionHeading"=> $request->class_heading,
							  "description"=> $request->description,
							  "room"=> $request->room,
							  "ownerId"=> "me",
							  "courseState"=> "PROVISIONED"

						);	
			$data = json_encode($data);
				
			$token = CommonHelper::varify_Admintoken(); // verify admin token 
			
		
			$responce = CommonHelper::create_class($token,$data); // access Google api craete Cource
			$resData = array('error'=> '');
						
			if($responce == 101)
			{
				return back()->with('error', Config::get('constants.WebMessageCode.119'));
			}
			else
			{
				$resData = array_merge($resData,json_decode($responce,true));
				$g_class_id = $resData['id'];
				 if($resData['error'])
				{
					return redirect()->route('classes.add')->with('error',Config::get('constants.WebMessageCode.119'));
				}
				else
				{  
					 $obj = new StudentClass;
					$obj->class_name = $request->class_name;
					$obj->section_name = $request->section;
					$obj->subject_id = $request->subject;
					
					$obj->g_class_id = $g_class_id;
					$obj->g_link = $resData['alternateLink'];
					$obj->g_response = $responce;
					$obj->save();
					$class_id = $obj->id; 
				//	if($request->teacher != '' && $request->teacher != null)
				//	{
						 
						$obj_time = new ClassTiming;
						$obj_time->class_id = $class_id;
						$obj_time->teacher_id = $teacher_id;
						$obj_time->subject_id = $request->subject;
						$obj_time->class_day = $request->days;
						$obj_time->from_timing = $request->start_time;
						$obj_time->to_timing = $request->end_time;
						$obj_time->is_lunch = $islunch;
						
						$obj_time->save(); 
					
					
					// Invitation for class
						 	$inv_data = array( 
									  "courseId"=>$g_class_id,
									  "role"=> "TEACHER",
									  "userId" => $g_teacher_id

									);	
					/* 				echo $token;
									echo "//";
						print_r($inv_data);
exit;						
					 */		$inv_data = json_encode($inv_data);
							$inv_responce = CommonHelper::teacher_invitation_forClass($token,$inv_data); // access Google api craete Cource
							$inv_res_code = array('error'=> '');
							
							
							if($inv_responce == 101)
							{
								return back()->with('error', Config::get('constants.WebMessageCode.119'));
							}
							else
							{
								$inv_resData = array_merge($inv_res_code,json_decode($inv_responce,true));
								if($inv_resData['error'] != '')
								{
									return back()->with('error', Config::get('constants.WebMessageCode.119'));
								}
								else
								{	
										$inv_res_code = $inv_resData['id'];
										
										$obj_inv = new InvitationClass;
										$obj_inv->class_id = $class_id;
										$obj_inv->teacher_id = $teacher_id;
										$obj_inv->g_code = $inv_res_code;
										$obj_inv->g_responce = $inv_responce;
										$obj_inv->is_accept = 0;
										$obj_inv->save();
								}
							} 
						
					//}
					
					return redirect()->route('classes.add')->with('success',Config::get('constants.WebMessageCode.125'));
				}
				
			}
			
			
        } 
		// $pin = Helper::getRandomPin();
        //return view('admin.teacher.add',compact('pin'));  
		
		$data['subject'] = StudentSubject::orderBy('subject_name', 'ASC')->pluck('subject_name', 'id');
		//$data['teacher'] = Teacher::pluck('email', 'id');
		$data['teacher'] = DB::table('tbl_techers')->select('id', DB::raw("CONCAT(first_name,' ',last_name) AS full_name"))->get()->pluck('full_name', 'id');
		$data['teacher']->prepend('Select Teacher','');
		$data['subject']->prepend('Select Subject','');
		
		$days = array(
								''=>'Select Days',
								'Monday'=>'Monday',
								'Tuesday'=>'Tuesday',
								'Wednesday'=>'Wednesday',
								'Thrusday'=>'Thrusday',
								'Friday'=>'Friday',
								'Saturday'=>'Saturday'
							);
		return view('admin.class.add',compact('data',$data))->with('days',$days);
    }
	
	
  /*   public function editTeacher(Request $request, $id)
    {
        
        if($request->isMethod('post')) {
            $request->validate([ 
              'fname' => 'required|max:100|alpha_num',
              'lname' => 'required|max:100|alpha_num',
              'email' => 'required|email|ends_with:montbit.tech|max:100|unique:tbl_techers,email,'.$id,
              'phone' => 'required|numeric|digits:10',
            ],[
				'fname.alpha_num'=>'The First name may only contain letters and numbers.',
				'lname.alpha_num'=>'The Last name may only contain letters and numbers.',
				
			]);
			
			
			$data = array( "name"=> array(
							"familyName"=> $request->fname,
							"givenName"=> $request->lname,
							"fullName"=> $request->fname.' '.$request->lname
						  ),
						  "password"=> $request->phone,
						  "primaryEmail"=> $request->email,
						  "recoveryEmail"=> "elearn.admin@montbit.tech"
						);	
			$data = json_encode($data);
				
			$userKey = $request->user_gid;	// for update user in google user 
			
			$token = CommonHelper::varify_Admintoken(); // verify admin token 
			if($userKey){
				$responce = CommonHelper::update_user($token,$data,$userKey);  // access Google api Update user
			}else{ $responce = 101; }
			
			if($responce == 101)
			{
				return back()->with('error', Config::get('constants.WebMessageCode.119'));
			}
			else
			{
				$resData = json_decode($responce,true);
				if($resData['error'])
				{
					return redirect()->route('admin.dashboard')->with('error',Config::get('constants.WebMessageCode.119'));
				}
				else
				{
					$teacher = Teacher::find($id);
					$teacher->first_name = $request->fname;
					$teacher->last_name = $request->lname;
					$teacher->email = $request->email;
					$teacher->phone = $request->phone;
					$teacher->g_response = $responce;
					//$user->password = Hash::make($request->pin);
					$teacher->save();
					return redirect()->route('admin.dashboard')->with('success',Config::get('constants.WebMessageCode.101'));
				}
			}
        }
        $id = decrypt($id);        
        $teacher = Teacher::find($id);
        return view('admin.teacher.edit',compact('teacher'));
    }
    public function deleteTeacher(Request $request,$id)
    {
		$id = decrypt($id);  
		$user = Teacher::find($id);
		
		 $userKey = $user->g_user_id;	// for update user in google user 
			
		$token = CommonHelper::varify_Admintoken(); // verify admin token 
		
		$responce = CommonHelper::user_delete($token,$userKey);  // access Google api Delete user
		if($responce == 101)
			{
				return back()->with('error', Config::get('constants.WebMessageCode.119'));
			}
			else
			{
				$user->delete();
				return redirect()->route('admin.dashboard')->with('success',Config::get('constants.WebMessageCode.102'));      
			}
    }  */

}
