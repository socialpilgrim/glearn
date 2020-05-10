<?php
namespace App\Http\Helpers;
use Google_Client;
use Session;

use Google_Service_Classroom;
use Google_Service_Classroom_Course;

class CommonHelper
{
    
    public function __construct()
    {

        parent::__construct();
        
    }
	
	
	
	public static function varify_Admintoken()
	{
		$session_token = Session::get('access_token');
		if(isset($session_token['access_token']) && $session_token['access_token'])
		{
				$token = $session_token['access_token'];
				return $token;
		}
		else
		{
			 return redirect(url('/'));//->route('/');
		}
	}
	
    public static function create_new_user($token,$data)
    {
						
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://www.googleapis.com/admin/directory/v1/users",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS =>$data,
			  CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer $token",
				"Content-Type: application/json"
			  ),
			));

			$response = curl_exec($curl);
			if($response === false){
				return 101;
			} 	
			
			return $response;	
			
			curl_close($curl);
	      
    }
	public static function update_user($token,$data,$userKey)
	{
				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://www.googleapis.com/admin/directory/v1/users/$userKey",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "PUT",
				  CURLOPT_POSTFIELDS =>$data,
				  CURLOPT_HTTPHEADER => array(
					"Authorization: Bearer $token",
					"Content-Type: application/json"
				  ),
				));

				$response = curl_exec($curl);
				if($response === false)
				{
					return 101;
				}
				curl_close($curl);
				return $response;
	}
	public static function user_delete($token,$userKey)
	{
		$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://www.googleapis.com/admin/directory/v1/users/$userKey",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "DELETE",
			  CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer $token"
			  ),
			));

			$response = curl_exec($curl);
			if($response === false)
				{
					return 101;
				}
			curl_close($curl);
			return $response;

	}
    
	public static function create_class($token,$data)
	{

				$curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://classroom.googleapis.com/v1/courses",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$data,
				  CURLOPT_HTTPHEADER => array(
					"Authorization: Bearer $token",
					"Content-Type: application/json"
				  ),
				));

				$response = curl_exec($curl);
				if($response === false)
				{
					return 101;
				}
			curl_close($curl);
			return $response;

	}
	
	public static function teacher_invitation_forClass($token,$inv_data)
	{
		$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://classroom.googleapis.com/v1/invitations",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS =>$inv_data,
			  CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer $token",
				"Content-Type: application/json"
			  ),
			));

			$response = curl_exec($curl);
				if($response === false)
				{
					return 101;
				}
			curl_close($curl);
			return $response;

	}
	
	
	
	// used in teacher module
	
	public static function varify_Teachertoken()
	{
		$session_token = Session::get('access_token_teacher');
		if(isset($session_token['access_token']) && $session_token['access_token'])
		{
				$token = $session_token['access_token'];
				return $token;
		}
		else
		{
			 return redirect(url('/'));//->route('/');
		}
	}
	public static function create_topic($token,$g_class_id,$data)
	{
		$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://classroom.googleapis.com/v1/courses/$g_class_id/topics",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS =>$data,
			  CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer $token",
				"Content-Type: application/json"
			  ),
			));

			$response = curl_exec($curl);
				if($response === false)
				{
					return 101;
				}
			curl_close($curl);
			return $response;
	}
	public static function create_courcework($token,$g_class_id,$data)
	{
		$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://classroom.googleapis.com/v1/courses/$g_class_id/courseWork",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS =>$data,
			  CURLOPT_HTTPHEADER => array(
				"Authorization: Bearer $token",
				"Content-Type: application/json"
			  ),
			));

			$response = curl_exec($curl);
			if($response === false)
				{
					return 101;
				}
			curl_close($curl);
			return $response;
	}


}


?>