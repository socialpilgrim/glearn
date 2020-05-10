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
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


class ImportStudentsController extends Controller
{
     public function listStudents()
    {
      $lists = \DB::select('select s.name, s.email, s.phone, s.notify, c.class_name, c.section_name from tbl_students s left join tbl_student_classes c on c.id = s.class_id');
      //echo "<pre>";print_r($timetables);exit;
      //$timetables = array();
      //return view('admin.timetable.index');
      return view('admin.numbers.index',compact('lists'));
    }

	public function sampleStudentsDownload(Request $request)
	{
		$path = public_path('student-excels').'/Sample-Students-format.csv';
		
        return response()->download($path);
	}
	
	
    /*Import no of students in a class*/
    public function importClassStudentNumber(Request $request){
        $student_class = \App\StudentClass::all();
		
		
		
        if(Request()->post()){
            try{
                $request->validate([
                    'file' => 'required'
                 //   'class' => 'required'
                ]);
				
                $extensions = array("csv","xlsx");
                $file_validate = strtolower($request->file('file')->getClientOriginalExtension());
				
                if (!in_array($file_validate, $extensions)) {
                    return back()->with('error', sprintf(Config::get('constants.WebMessageCode.103'), implode(",", $extensions)));
                }
				
                $file = $request->file('file');
                $destinationPath = public_path('student-excels');
				
                $filename = $file->getClientOriginalName();
		
                $file->move($destinationPath,$filename);
				
                $path = $destinationPath.'/'.$filename;

                $headerMissing = array();
                $supplierAdded = 0;
                $i = 1;
                $collection = (new FastExcel)->import($path);
				
					if(!isset($collection[0])){
						return back()->with('error',Config::get('constants.WebMessageCode.104'));
					 }
					 $numbers = array();
					 
					Log::info('Filename processing - ' . $filename);
					foreach($collection as $key => $reader)
					{
										
						if($reader["name"] == "" || $reader["class"] == "" || $reader["section"] == "")
							Log::error('Student details missing : ROW - ' . $i);
						
						elseif($reader["phone"] == "" && $reader["email"] == "" && $reader["notify"] == "yes" )
							Log::error('Student details missing for notification : ROW - ' . $i);
						else
						{
							$studentClassExist=\DB::select('select id from tbl_classes where class_name="'.$reader["class"].'" and section_name="'.$reader["section"].'"');
						
						//$studentClassExist = StudentClass::where('class_name',$reader["class"])->where('section_name',$reader["section"])->first();
						
							if($studentClassExist)
							{
		//dd($studentClassExist[0]->id);							//$studentClassDetail = $studentClassExist;
								$class_id = $studentClassExist[0]->id;

								$s = \DB::table('tbl_students')->insert([
									['name' => $reader["name"], 'class_id' => $class_id, 'email' => $reader["email"],'phone' => $reader["phone"], 'notify' => $reader["notify"]]
								]);
								
								Log::error('Class not found : ROW - ' . $i);
							}
							else
								Log::error(Config::get('constants.WebMessageCode.130') ." : ROW - " . $i);
						}
						$i += 1;
					}
					Log::info('File processing done ');
					
                    return back()->with('success','Student details processed, check log file for errors!!');

                }catch(\Exception $e){
                    return back()->with('error',Config::get('constants.WebMessageCode.121'));
                }
                @unlink($path);
        }
        return view('admin.numbers.import',compact('student_class'));
    }
}