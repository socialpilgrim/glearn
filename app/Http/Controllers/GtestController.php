<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Classroom;
use Google_Service_Classroom_Course;
use Exception;
use Google_Service_Sheets;
use Google_Service_Drive;
use Session;
use Google_Service_Classroom_Teacher;
use Helper;

class GtestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        echo "Success";
    }

    public function create_class()
    {
        $client = new Google_Client();
        $client->setAuthConfig('../credentials.json');

      /*   $data = file_get_contents('../credentials.json');
         echo  $data;
        exit; */
      //  $client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
       // $client->addScope('https://www.googleapis.com/auth/classroom.courses');
        $session_token = Session::get('access_token');

      //Session::forget('access_token');
        
       /*  echo "<pre>";
        print_r($session_token);
        echo "</pre>";
        exit;  */

        if (isset($session_token['access_token']) && $session_token['access_token']) {
         
        $client->setAccessToken($session_token['access_token']);
		$service = new Google_Service_Classroom($client); 
       // $client->addScope($session_token['scope']);


         /*  $drive = new Google_Service_Drive($client);
          $files = $drive->files->listFiles(array())->getItems();
          echo json_encode($files); */
          
           $service = new Google_Service_Classroom($client);  
          $course = new Google_Service_Classroom_Course(array(
            'name' => '101 Grade Biology',
            'section' => 'Period 1',
            'descriptionHeading' => 'Welcome to 10th Grade Biology',
            'description' => 'We\'ll be learning about about the structure of living ' .
                             'creatures from a combination of textbooks, guest ' .
                             'lectures, and lab work. Expect to be excited!',
            'room' => '301',
            'ownerId' => '103666456079001911888',
			
            'courseState' => 'PROVISIONED'
          ));
          $course = $service->courses->create($course);
             echo $course->id ." => ".$course->name; 
			 
			/*  $courseId = '95715084659';
			$teacherEmail = 'test@montbit.tech';
			$teacher = new Google_Service_Classroom_Teacher(array(
			  'userId' => $teacherEmail
			));
			try {
			  $teacher = $service->courses_teachers->create($courseId, $teacher);
			  print_r("User '%s' was added as a teacher to the course with ID '%s'.\n",
				  $teacher->profile->name->fullName, $courseId);
			} catch (Google_Service_Exception $e) {
			  if ($e->getCode() == 409) {
				print_r("User '%s' is already a member of this course.\n", $teacherEmail);
			  } else {
				throw $e;
			  }
			} */
			 
			 


       
        } else {
          //$redirect_uri = 'http://127.0.0.1:8000/get_token';
         // header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));

            $res = Helper::get_token_forClass();
                
            return redirect()->route('admin.dashboard');

        }
          
    }

    public function get_token(Request $request)
    {
        
        $client = new Google_Client();
        $client->setAuthConfigFile('../credentials.json');
        $client->setRedirectUri('http://localhost:8000/dashboard');
        
       $client->addScope('https://www.googleapis.com/auth/classroom.courses');
       $client->addScope('https://www.googleapis.com/auth/classroom.coursework.students');
       $client->addScope('https://www.googleapis.com/auth/classroom.rosters');
        //$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);

        if (! isset($_GET['code'])) 
        {
            $auth_url = $client->createAuthUrl();
            //echo filter_var($auth_url, FILTER_SANITIZE_URL);
            return redirect($auth_url);
           //header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
        } 
        else 
        {

            $client->authenticate($_GET['code']);

          /*   echo '<pre>';  
            print_r($client);//->getAccessToken());
            echo '</pre>';  
            exit; */

            Session::put('access_token',$client->getAccessToken());
           // echo Session::get('access_token');
           // exit;
            //$redirect_uri = 'http://127.0.0.1:8000';
            //header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
            return redirect()->route('/');
        }
    }

    public function get_course()
    {
        $pageToken = NULL;
        $courses = array();
        $client = new Google_Client();
       
        do {
        $params = array(
            'pageSize' => 100,
            'pageToken' => $pageToken
        );

        $session_token = Session::get('access_token');
        $client->setAccessToken($session_token['access_token']);
        $service = new Google_Service_Classroom($client);  
        $response = $service->courses->listCourses($params);
        $courses = array_merge($courses, $response->courses);
        $pageToken = $response->nextPageToken;
        } while (!empty($pageToken));

        if (count($courses) == 0) {
        print "No courses found.\n";
        } else {
        print "Courses:\n";
        foreach ($courses as $course) {
            printf("%s (%s)\n", $course->name, $course->id);
        }
        }
    }

    public function create_teacher()
    {
            $courseId = '95258942413';
            $teacherEmail = 'socialpilgrim@gmail.com';
            $client = new Google_Client();
            $session_token = Session::get('access_token');
            $client->setAccessToken($session_token['access_token']);
            $service = new Google_Service_Classroom($client);  

            $teacher = new Google_Service_Classroom_Teacher(array(
            'userId' => $teacherEmail
            ));
            try {
            $teacher = $service->courses_teachers->create($courseId, $teacher);
            printf("User '%s' was added as a teacher to the course with ID '%s'.\n",
                $teacher->profile->name->fullName, $courseId);
            } catch (Google_Service_Exception $e) {
            if ($e->getCode() == 409) {
                printf("User '%s' is already a member of this course.\n", $teacherEmail);
            } else {
                throw $e;
            }
            }
    }
	
	public function create_user()
	{
		$session_token = Session::get('access_token');
		$token = $session_token['access_token'];
		
		$data = array( "name"=> array(
							"familyName"=> "test3",
							"givenName"=> "user3",
							"fullName"=> "test user 3"
						  ),
						  "password"=> "12345678",
						  "primaryEmail"=> "patel@montbit.tech"
						);	
				$data = json_encode($data);
		

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

				curl_close($curl);
				echo $response;

	}

    public function set_course()
    {

        
        $client = new Google_Client();

		$service = new Google_Service_Classroom($client);

       /* echo '<pre>';    
        print_r($service);
        echo '</pre>'; */

        $course = new Google_Service_Classroom_Course(array(
            'name' => '10th Grade Biology',
            'section' => 'Period 2',
            'descriptionHeading' => 'Welcome to 10th Grade Biology',
            'description' => 'We\'ll be learning about about the structure of living ' .
                             'creatures from a combination of textbooks, guest ' .
                             'lectures, and lab work. Expect to be excited!',
            'room' => '301',
            'ownerId' => 'me',
            'courseState' => 'PROVISIONED'
          ));
          $course = $service->courses->create($course);
          echo $course->id ." => ".$course->name;
          // print_r("Course created: %s (%s)\n", $course->name, $course->id);

        
    }
	public function test_user_permission(Request $request)
	{
		
		$id = $request->get('id');
		$session_token = Session::get('access_token');
		$token = $session_token['access_token'];
		$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://classroom.googleapis.com/v1/userProfiles/$id",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			    CURLOPT_HTTPHEADER => array(
					"Authorization: Bearer $token"
				  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			
			echo $response;
	}
	
	
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function quickstart()
    {
        
      
            $client = new Google_Client();
           // $client->setAuthConfig(__DIR__.'\credentials.json');
           // $client->setApplicationName('Quickstart');
          //  $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);
            
            echo '<pre>'; 
            print_r($client);
            echo '</pre>';
    }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
