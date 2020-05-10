<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;
//use Auth;
use Validator;
use App\Http\Helpers\CommonHelper;
use App\Teacher;
class TeacherController extends Controller
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
    public function addTeacher(Request $request)
    {
         if($request->isMethod('post')) {
            $request->validate([ 
              'fname' => 'required|max:100|regex:/^[a-zA-Z0-9 ]*$/',
             // 'lname' => 'required|max:100|alpha_num',
              'email' => 'required|email|ends_with:montbit.tech|max:100|unique:tbl_techers',
              'phone' => 'required|numeric|digits:10',
             // 'pin' => 'required|min:4|unique:tbl_techers',
            ],[
				'fname.regex'=>'The name must be letters and numbers.',
				//'lname.alpha_num'=>'The Last name may only contain letters and numbers.',
				
			]);
			
			$data = array( "name"=> array(
							"familyName"=> $request->fname,
							"givenName"=> "",
							"fullName"=> $request->fname,//.' '.$request->lname
						  ),
						  "password"=> $request->phone,
						  "primaryEmail"=> $request->email,
						  "recoveryEmail" => "elearn.admin@montbit.tech"
						);	
			$data = json_encode($data);
				
			$token = CommonHelper::varify_Admintoken(); // verify admin token 
			
			$responce = CommonHelper::create_new_user($token,$data);  // access Google api craete user
			$resData = array('error'=> '');
			
			
			if($responce == 101)
			{
				return back()->with('error', Config::get('constants.WebMessageCode.119'));
			}
			else
			{
				$resData = array_merge($resData,json_decode($responce,true));
				 if($resData['error'])
				{
					return redirect()->route('admin.dashboard')->with('error',Config::get('constants.WebMessageCode.119'));
				}
				else
				{ 
					$teacher = new Teacher;
					$teacher->name = $request->fname;
					//$teacher->last_name = $request->lname;
					$teacher->email = $request->email;
					$teacher->phone = $request->phone;
					$teacher->g_user_id = $resData['id'];
					$teacher->g_customer_id = $resData['customerId'];
					$teacher->g_response = $responce;
				   // $teacher->password = Hash::make($request->pin);
					$teacher->save();
					return redirect()->route('admin.dashboard')->with('success',Config::get('constants.WebMessageCode.100'));
				}
				
			}
			
			
        }
		// $pin = Helper::getRandomPin();
        //return view('admin.teacher.add',compact('pin')); 
		return view('admin.teacher.add');
    }
     public function editTeacher(Request $request, $id)
    {
        
        if($request->isMethod('post')) {
            $request->validate([ 
              'fname' => 'required|max:100|regex:/^[a-zA-Z0-9 ]*$/',
             // 'lname' => 'required|max:100|alpha_num',
              'email' => 'required|email|ends_with:montbit.tech|max:100|unique:tbl_techers,email,'.$id,
              'phone' => 'required|numeric|digits:10',
            ],[
				'fname.regex'=>'The name must be letters and numbers.',
				//'lname.alpha_num'=>'The Last name may only contain letters and numbers.',
				
			]);
			
			
			$data = array( "name"=> array(
							"familyName"=> $request->fname,
							"givenName"=> '',
							"fullName"=> $request->fname,//.' '.$request->lname
						  ),
						 // "password"=> $request->phone,
						  "primaryEmail"=> $request->email,
						  "recoveryEmail"=> "elearn.admin@montbit.tech"
						);	
			$data = json_encode($data);
				
			$userKey = $request->user_gid;	// for update user in google user 
			
			$token = CommonHelper::varify_Admintoken(); // verify admin token 
			if($userKey){
				$responce = CommonHelper::update_user($token,$data,$userKey);  // access Google api Update user
			}else{ $responce = 101; }
			
			$resData = array('error'=> '');	
			if($responce == 101)
			{
				return back()->with('error', Config::get('constants.WebMessageCode.119'));
			}
			else
			{
				$resData = array_merge($resData,json_decode($responce,true));
				//$resData = json_decode($responce,true);
				 if($resData['error'])
				{
					return redirect()->route('admin.dashboard')->with('error',Config::get('constants.WebMessageCode.119'));
				}
				else
				{ 
					$teacher = Teacher::find($id);
					$teacher->name = $request->fname;
					//$teacher->last_name = $request->lname;
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
    } 

}
