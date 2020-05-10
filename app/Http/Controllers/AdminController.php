<?php

namespace App\Http\Controllers;
use App\Http\Helpers\CustomHelper;
use Illuminate\Http\Request;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Google_Client;
use Session;
use App\Admin;
use App\Teacher;
//use Validator;


class AdminController extends Controller
{
 // use AuthenticatesUsers;
  //protected $redirectTo = '/dashboard';
    
  public function __construct()
  {
    //$this->middleware('guest')->except('logout');
   // $client = new Google_Client();
    //$client->setAuthConfig('../credentials.json');

  }

/*  public function guard()
  {
   return Auth::guard('admin');
  } */
 

 /*  public function showAdminLoginForm(){
   
    return view('admin.login');
  } */

  public function admin_login_post(Request $request){
    /* $validator = Validator::make($request->all(), [ 
      'email' => 'required|email',
      'password' => 'required'
    ]); 
    if($validator->fails()) {
      return back()->withErrors($validator);
    }
    else{
        $credentials = $request->only('email', 'password');
    //dd($credentials);
        if (Auth::guard('admin')->attempt($credentials)) {
          return redirect(route('admin.helplist'));
        }else{
          return back()->with('error', 'Invalid email or password');
        }
    }
	 */
    //return redirect(route('admin.dashboard'));

    $session_token = Session::get('access_token');
    if (isset($session_token['access_token']) && $session_token['access_token'])
      {
            $res = $this->verify_email_DB();
			if($res == 101 )
		   {
				 return back()->with('error', Config::get('constants.WebMessageCode.118'));
				 $this->logout();
			} 
			else
			{
				return redirect()->route('admin.dashboard');
			} 

      }
      else
      {
          $auth_url = CustomHelper::set_token_admin();
         
          return redirect($auth_url);
      }


  }
  public function admin_login_get()
  {
    if (!isset($_GET['code'])) 
    {
        $auth_url = CustomHelper::set_token_admin();
       
        return redirect($auth_url);
    }
    else
    {
        $code = $_GET['code'];
        CustomHelper::get_token_admin($code);

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
			 //$teacher = Teacher::all();
			//return view('admin.dashboard',compact('teacher'))->with('i', 0);
			return redirect()->route('admin.dashboard');
		} 
        //print_r($responce); 
		//echo $responce['email']; 
       

    }
  }
  public function adminDashboard(Request $request)
  {
	 $teacher = Teacher::all();
	 
    return view('admin.dashboard',compact('teacher'))->with('i', 0);
  //   return view('admin.dashboard');
  }

  public function logout(Request $request) {
    //Auth::guard('admin')->logout();

   // $session_token = Session::get('access_token');
     ///print_r($session_token);
    Session::forget('access_token');
    Session::forget('admin_session');
    return redirect(url('/'));
  }
	
 public function adminProfile(Request $request){
   // $admin = Auth::guard('admin')->user();
   $admin_id = Session::get('admin_session');
    if (Request()->post()) {
     $request->validate([
          'fname' => 'required',
          'lname' => 'required',
         // 'email' => 'required',
        ]);
     if($request->input('phone_no')){
        $request->validate([
            'phone_no' => 'numeric|digits:10',
          ]);
     }
	 
      $obj = Admin::find($admin_id['admin_id']);
      $obj->first_name = $request->input('fname');
      $obj->last_name = $request->input('lname');
      $obj->phone = $request->input('phone_no');
     // $obj->email = $request->input('email');
      $obj->save();
	  return back()->with('success', Config::get('constants.WebMessageCode.124'));
    }
    $admin = Admin::find($admin_id['admin_id']);
    $data = ['first_name'=>$admin->first_name,'last_name'=>$admin->last_name,'email'=>$admin->email,'phone_no'=>$admin->phone];
    return view('admin.profile',$data);
  }	
 
 
  public function verify_email_DB()
  {

    $session_token = Session::get('access_token');
      $responce = CustomHelper::get_user_from_token($session_token['id_token']);  
      $responce = json_decode($responce,true);
      $credentials = $responce['email'];;
      
    
      $admin = Admin::where('email',$credentials)->first();;
	  
		
       if (!empty($admin)) { 
			Session::put('admin_session',array('admin_id' => $admin['id'],'admin_email' =>$admin['email']));
            return 100;
       }else{
            return 101;
          } 
  }


}
