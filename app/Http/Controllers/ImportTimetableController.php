<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;
use Auth;
use Validator;
use App\Http\Helpers\CommonHelper;
use App\Teacher;
use App\StudentClass;
use App\StudentSubject;
use App\ClassTiming;
use App\InvitationClass;

class ImportTimetableController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
       // return Auth::guard('admin');
    }

    /**
     * Show the application dashboard.|min:8
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
   
    public function timeTableImport(Request $request)
    {
		$g_class_id = '';
		$g_teacher_id = '';
		$class_name = '';
		$section_name = '';
        if($request->isMethod('post'))
        {
            $request->validate([
                'file' => 'required'
            ]);
            $extensions = array("csv","xlsx");
            $file_validate = strtolower($request->file('file')->getClientOriginalExtension());
            if (!in_array($file_validate, $extensions)) {
                return back()->with('error', sprintf(Config::get('constants.WebMessageCode.103'), implode(",", $extensions)));
            }
            $file = $request->file('file');
            $destinationPath = public_path('timetable-excels');
            $filename = $file->getClientOriginalName();
            $file->move($destinationPath,$filename);
            $path = $destinationPath.'/'.$filename;

            $headerMissing = array();
            $supplierAdded = 0;
            $ipAdded = 0;
            $collection = (new FastExcel)->import($path);
               
        
            if(!isset($collection[0])){
                return back()->with('error',Config::get('constants.WebMessageCode.104'));
             }
             $teacher_subjects = array();
             $teacher_classes = array();
         
			$token = CommonHelper::varify_Admintoken(); // verify admin token 
			
            foreach ($collection as $key => $reader)
            {

                
                $reader_keys = array_keys($reader);
                $reader_values = array_values($reader);  
                //$class_id = 0;
                if($key == 0){
                    $class_section_str = isset($reader_keys[0])?trim($reader_keys[0]):'';
                    $class_section_spliited_arr = explode(",",$class_section_str);
                   // echo "<pre>";print_r($class_section_spliited_arr);exit;
                    $class_str = isset($class_section_spliited_arr[0])?trim($class_section_spliited_arr[0]):'';
                    $section_str =isset($class_section_spliited_arr[1])?trim($class_section_spliited_arr[1]):'';
                    $class_name = '';
                    if($class_str != ''){
                        $class_spliited_arr = explode(":",$class_str);                        
                        $class_name = isset($class_spliited_arr[1])?$class_spliited_arr[1]:'';
                    }
                    $section_name = '';
                    if($section_str != ''){
                        $section_spliited_arr = explode(":",$section_str);
                        $section_name = isset($section_spliited_arr[1])?$section_spliited_arr[1]:'';
                    }
                     if($class_name =='' && $section_name=='')
                    {
						return back()->with('error',Config::get('constants.WebMessageCode.120'));  
                    }
                }
				else
                {
                   
                    $day = $reader_values[0];
                   
                    if(isset($reader['p1'])){
                        $periodstr_arr[] = $reader['p1'];
                    }
                    if(isset($reader['p2'])){
                        $periodstr_arr[] = $reader['p2'];
                    }
                    if(isset($reader['p3'])){
                        $periodstr_arr[] = $reader['p3'];
                    }
                    if(isset($reader['p4'])){
                        $periodstr_arr[] = $reader['p4'];
                    }
                    if(isset($reader['p5'])){
                        $periodstr_arr[] = $reader['p5'];
                    }
                    if(isset($reader['p6'])){
                        $periodstr_arr[] = $reader['p6'];
                    }
                    if(isset($reader['p7'])){
                        $periodstr_arr[] = $reader['p7'];
                    }
                    if(isset($reader['p8'])){
                        $periodstr_arr[] = $reader['p8'];
                    }
                    if(isset($reader['p9'])){
                        $periodstr_arr[] = $reader['p9'];
                    }
                    if(isset($reader['p10'])){
                        $periodstr_arr[] = $reader['p10'];
                    }
                    if(isset($reader['p11'])){
                        $periodstr_arr[] = $reader['p11'];
                    }
                    if(isset($reader['p12'])){
                        $periodstr_arr[] = $reader['p12'];
                    }   
                                    
                    if(count($periodstr_arr)>0){
                        foreach($periodstr_arr as $period){
                            $period_str_arr = explode(",",$period);
                            $from = isset($period_str_arr[0])?trim($period_str_arr[0]):'';
                            $student_subject = isset($period_str_arr[1])?trim($period_str_arr[1]):'';
                            $teacher = isset($period_str_arr[2])?trim($period_str_arr[2]):'';
                            $to = isset($period_str_arr[3])?trim($period_str_arr[3]):'';

							
							 //Adding or updating Subject
                            $studentSubjectExist = StudentSubject::where('subject_name',$student_subject)->first();
                            if($studentSubjectExist){
                              $studentSubjectDetail = $studentSubjectExist;
                            }else{
                              $studentSubjectDetail = new StudentSubject;
                            }
                            $studentSubjectDetail->subject_name = $student_subject;
                            $studentSubjectDetail->save();
							 $subject_id = $studentSubjectDetail->id;
							
							
						
						// Check Class exits or not 	
						$studentClassExist = StudentClass::where('class_name',$class_name)->where('section_name',$section_name)->where('subject_id',$subject_id)->first();
                        if($studentClassExist){
                          $studentClassDetail = $studentClassExist;
						  $class_id = $studentClassDetail->id;
						  $g_class_id = $studentClassDetail->g_class_id;
						  
                        }else{
								
								$studentClassDetail = new StudentClass;
                         
                         // Google Create class api
								$data = array( 
								  "name"=> $class_name.' '.$student_subject,
								  "section"=> $section_name,
								  "descriptionHeading"=> "",
								  "description"=> "",
								  "room"=> "",
								  "ownerId"=> "me",
								  "courseState"=> "PROVISIONED"

								);	
								$data = json_encode($data);
								
								$responce = CommonHelper::create_class($token,$data); // access Google api craete Cource
								if($responce == 101)
								{
									return back()->with('error', Config::get('constants.WebMessageCode.119'));
								}
								else
								{
									$resData = json_decode($responce,true);
									
									$g_class_id = $resData['id'];
									
									$studentClassDetail->class_name = $class_name;
									$studentClassDetail->section_name = $section_name;
									$studentClassDetail->subject_id = $subject_id;
									$studentClassDetail->g_class_id = $g_class_id;
									$studentClassDetail->g_link = $resData['alternateLink'];
									$studentClassDetail->g_response = $responce;
									$studentClassDetail->save();
									$class_id = $studentClassDetail->id;
								}
							}
							
							
                        		
                            if(strtolower($teacher) != 'na'){
                                //Adding teacher
                                $teacherExist = Teacher::where('phone',$teacher)->first();
                                if($teacherExist){
                                    $user = $teacherExist;
                                }else{
                                       return back()->with('error',Config::get('constants.WebMessageCode.126'));                               
                                }
                               
                              //  $teacher_subjects[$user->id][$studentSubjectDetail->id] = $studentSubjectDetail->id;
                               // $teacher_classes[$user->id][$class_id] = $class_id;
							   
                                $teacher_id = $user->id;
								$g_teacher_id = $user->g_user_id; // Google USer ID
								
								// Invitation send to teacher for class 
								$invitation_class_dataexist = InvitationClass::where('class_id',$class_id)->where('teacher_id',$teacher_id)->first();
								if($invitation_class_dataexist)
								{
									$invitation_class_data = $invitation_class_dataexist;
									
								}else{
									$inv_data = array( 
											  "courseId"=> $g_class_id,
											  "role"=> "TEACHER",
											  "userId" => $g_teacher_id

											);	
									$inv_data = json_encode($inv_data);
									$inv_responce = CommonHelper::teacher_invitation_forClass($token,$inv_data); // access Google api craete Cource
									if($inv_responce == 101)
									{
										return back()->with('error', Config::get('constants.WebMessageCode.119'));
									}
									else
									{
										$inv_resData = json_decode($inv_responce,true);
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

						     }else{
                                $teacher_id = 0;
                            }
                            
                            
                             
                           
                            if($class_id>0 && $subject_id>0)
                            {
                                 //Adding or updating timetable
                                $day = date("l",strtotime($day));
                                $from = date("H:i:s",strtotime($from));
                                $studentTimingExist = ClassTiming::where('class_day',$day)->where('class_id',$class_id)->where('from_timing',$from)->first();
                                if($studentTimingExist){
                                  $studentTimingDetail = $studentTimingExist;
                                }else{
                                  $studentTimingDetail = new ClassTiming;
                                }
                                $lunch=0;
                                if($teacher_id==0){
                                    $lunch = 1;
                                }
                                $studentTimingDetail->class_id = $class_id;
                                $studentTimingDetail->subject_id = $subject_id;
                                $studentTimingDetail->teacher_id = $teacher_id;
                                $studentTimingDetail->class_day = $day;
                                $studentTimingDetail->from_timing = $from;
                                $studentTimingDetail->to_timing = date("H:i:s",strtotime($to));
                                $studentTimingDetail->is_lunch = $lunch;
                                $studentTimingDetail->save();
                            }else{
                                return back()->with('error',Config::get('constants.WebMessageCode.121'));
                            }
                        }
                    } 
                }
               
            }    
           /*  echo "<pre>";
            print_r($periodstr_arr);
            echo "</pre>";
            exit; */

           /*  if(count($teacher_subjects) > 0 ){
                foreach ($teacher_subjects as $teacher_id => $teachers) {
                    $subject_id_values = array_values($teachers);                   
                    $subjet_id_str = implode(',',$subject_id_values);
                    $userDetail = Teacher::find($teacher_id);
                    $userDetail->subject_ids = $subjet_id_str;
                    $userDetail->save();
                }                
            }
            if(count($teacher_classes) > 0 ){
                foreach ($teacher_classes as $teacher_id => $teachers) {
                    $subject_id_values = array_values($teachers);                   
                    $subjet_id_str = implode(',',$subject_id_values);
                    $userDetail = Teacher::find($teacher_id);
                    $userDetail->class_ids = $subjet_id_str;
                    $userDetail->save();
                }                
            }  */          
            @unlink($path);
            return redirect()->route('list.timetable')->with('success',Config::get('constants.WebMessageCode.122'));
        }
        return view('admin.timetable.import');
    }

    public function listTimetable()
    {
      $timetables = ClassTiming::join('tbl_techers', 'tbl_techers.id', '=', 'tbl_class_timings.teacher_id')->get();
      //echo "<pre>";print_r($timetables);exit;
      //$timetables = array();
      //return view('admin.timetable.index');
      return view('admin.timetable.index',compact('timetables'));
    }

	public function sampleDownload(Request $request)
	{
		$path = public_path('timetable-excels').'/Sample-TimeTable-format.csv';
		
        return response()->download($path);
	}
	
	
    /*Import no of students in a class*/
    public function importClassStudentNumber(Request $request){
        $student_class = \App\StudentClass::all();
        if(Request()->post()){
            try{
                $request->validate([
                    'file' => 'required',
                    'class' => 'required'
                ]);
                $extensions = array("csv","xlsx");
                $file_validate = strtolower($request->file('file')->getClientOriginalExtension());
                if (!in_array($file_validate, $extensions)) {
                    return back()->with('error', sprintf(Config::get('constants.WebMessageCode.103'), implode(",", $extensions)));
                }
                $file = $request->file('file');
                $destinationPath = public_path('studentnumber-excels');
                $filename = $file->getClientOriginalName();
                $file->move($destinationPath,$filename);
                $path = $destinationPath.'/'.$filename;

                $headerMissing = array();
                $supplierAdded = 0;
                $ipAdded = 0;
                $collection = (new FastExcel)->import($path);
                if(!isset($collection[0])){
                    return back()->with('error',Config::get('constants.WebMessageCode.104'));
                 }
                 $numbers = array();
                foreach($collection as $key => $reader){
                    if(!ctype_digit(array_values($reader)[0])){
                        continue;
                    }
                    $numbers[] = array_values($reader);
                }
                    if(count($numbers) > 0){
                        $mobile_numbers = implode(',',array_unique(array_merge(...$numbers)));
                        $studentClass = \App\StudentClass::where('id',$request->class)->update(['student_numbers' => $mobile_numbers]);
                    }else{
                        return back()->with('error',Config::get('constants.WebMessageCode.104'));
                    }
                    return back()->with('success',Config::get('constants.WebMessageCode.112'));
                }catch(\Exception $e){
                    return back()->with('error',Config::get('constants.WebMessageCode.121'));
                }
                @unlink($path);
        }
        return view('admin.class.import_student',compact('student_class'));
    }

}
