<?php
namespace App\Http\Helpers;
use Google_Client;
use Session;
use App\ClassTopic;

class CustomHelper
{
    
/*    public function __construct()
    {

        parent::__construct();
        
    }*/
	
	public static function addOrdinalNumberSuffix($num) {
	    if (!in_array(($num % 100),array(11,12,13))){
	      switch ($num % 10) {
	        // Handle 1st, 2nd, 3rd
	        case 1:  return $num.'st';
	        case 2:  return $num.'nd';
	        case 3:  return $num.'rd';
	      }
	    }
	    return $num.'th';
	}
    public static function get_user_from_token($id_token)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.googleapis.com/oauth2/v1/tokeninfo?id_token=$id_token",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
        
    }
     public static function set_token_admin()
    {
        
       $client = new Google_Client();
       $client->setAuthConfigFile('../credentials.json');
       $client->addScope('https://www.googleapis.com/auth/classroom.courses');
       $client->addScope('https://www.googleapis.com/auth/classroom.coursework.students');
       $client->addScope('https://www.googleapis.com/auth/classroom.rosters');
       $client->addScope('https://www.googleapis.com/auth/admin.directory.user');
       $client->addScope('https://www.googleapis.com/auth/userinfo.email');
       $client->addScope('https://www.googleapis.com/auth/classroom.topics');
     
       $client->setRedirectUri('http://290px.com/elearn/public/admin/login');

        $auth_url = $client->createAuthUrl();
      
        return $auth_url;
      
    } 
       
        
    public static function get_token_admin($code)
    {

        $client = new Google_Client();
        $client->setAuthConfigFile('../credentials.json');
        $client->addScope('https://www.googleapis.com/auth/classroom.courses');
        $client->addScope('https://www.googleapis.com/auth/classroom.coursework.students');
        $client->addScope('https://www.googleapis.com/auth/classroom.rosters');
        $client->addScope('https://www.googleapis.com/auth/admin.directory.user');
        $client->addScope('https://www.googleapis.com/auth/userinfo.email');
		 $client->addScope('https://www.googleapis.com/auth/classroom.topics');
        
       $client->authenticate($code);

        Session::put('access_token',$client->getAccessToken());
        return true;//redirect()->route('/');
    }
 
    // For Teacher get/set  auth token
    public static function set_token_teacher()
    {
        
       $client = new Google_Client();
       $client->setAuthConfigFile('../credentials_teacher.json');
       $client->addScope('https://www.googleapis.com/auth/classroom.courses');
       $client->addScope('https://www.googleapis.com/auth/classroom.coursework.students');
       $client->addScope('https://www.googleapis.com/auth/classroom.rosters');
       $client->addScope('https://www.googleapis.com/auth/admin.directory.user');
       $client->addScope('https://www.googleapis.com/auth/userinfo.email');
       $client->addScope('https://www.googleapis.com/auth/classroom.topics');
       
       $client->setRedirectUri('http://290px.com/elearn/public/teacher/login');

        $auth_url = $client->createAuthUrl();
      
        return $auth_url;
      
    } 
       
        
    public static function get_token_teacher($code)
    {

        $c = new Google_Client();
        $c->setAuthConfigFile('../credentials_teacher.json');


       /*  $data = file_get_contents('../credentials_teacher.json');
         echo  $data;
        exit;  */
        $c->addScope('https://www.googleapis.com/auth/classroom.courses');
        $c->addScope('https://www.googleapis.com/auth/classroom.coursework.students');
        $c->addScope('https://www.googleapis.com/auth/classroom.rosters');
        $c->addScope('https://www.googleapis.com/auth/admin.directory.user');
        $c->addScope('https://www.googleapis.com/auth/userinfo.email');
        $c->addScope('https://www.googleapis.com/auth/classroom.topics');
        
       $c->authenticate($code);


        Session::put('access_token_teacher',$c->getAccessToken());
        return true;//redirect()->route('/');
    } 


	public static function getTopics($class_id)
	{
		return ClassTopic::where(['class_id'=>$class_id])->get();
	}


}


?>
