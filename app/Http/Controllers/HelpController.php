<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
//use Auth;
use Validator;

use App\Teacher;

class HelpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //return Auth::guard('admin');
    }

    /**
     * Listing help.
     *
     * @return list view
     */

    public function helpList(Request $request){
    	$help_tickets = \App\SupportHelp::where('read_status',0)->update(['read_status' => 1]);
    	$support_help = \App\SupportHelp::all();
    	return view('admin.help.list',compact('support_help'))->with('i',0);
    }

  /*   public function ajaxHelpList(Request $request){
    	$support_help = \App\SupportHelp::with('class','teacher','subject')->where('read_status',0)->orderBy('id','desc')->first();
    	if($support_help){
	    	$support_help->read_status = 1;
	    	$support_help->save();
	    		if($support_help->class_join_link){
	    			$link = '<a href="'.$support_help->class_join_link.'" target="_blank">Join Live</a>';
	    		}else{
	    			$link = '';
	    		}
	    		if($support_help->teacher){
	    			$teacher = $support_help->teacher->name;
	    		}else{
	    			$teacher = '';
	    		}
	    		if($support_help->class){
	    			$class = $support_help->class->class_name;
	    			$section = $support_help->class->section_name;
	    		}else{
	    			$class = '';
	    			$section = '';
	    		}
                $subject='';
                $subject = $support_help->subject->subject_name;
				echo json_encode(array($support_help->id, $teacher, ($support_help->help_type == 2)?$class:'', ($support_help->help_type == 2)?$section:'',$subject,$support_help->description,$link));
	    	}else{
    			echo json_encode(false);
    		}
    }

    public function generateHelpTicket(Request $request){
    	if(Request()->post() || Request()->ajax()){
    		$support_help = new \App\SupportHelp;
            switch ($request->help_type) {
                case '1':
		        try{
    	    		$support_help->teacher_id = $request->teacher;
    	    		$support_help->description = $request->desc;
    	    		$support_help->help_type = $request->help_type;
    	    		$support_help->class_id = 0;
    	    		$support_help->read_status = 0;
    	    		$support_help->class_join_link ='';
    	    		if($support_help->save()){
                            $this->teacherHelpMSG($support_help->teacher_id);
                        }
    	    		echo json_encode(array('status'=>'success','message'=> Config::get('constants.WebMessageCode.111')));
        		}catch(\Exception $e){
        			echo json_encode(array('status'=>'error','message'=> Config::get('constants.WebMessageCode.121')));
        		}
                break;
                case '2':
                try{
                    $support_help->teacher_id = \Auth::user()->id;
                    $support_help->description = isset($request->description)?$request->description:'';
                    $support_help->help_type = $request->help_type;
                    $support_help->class_id = $request->teacher_class;
                    $support_help->subject_id = $request->subject;
                    $support_help->read_status = 0;
                    $support_help->class_join_link = isset($request->joinlive)?$request->joinlive:'';
                    if($support_help->save()){
                        $this->teacherHelpMSG($support_help->teacher_id);
                    }
                    if($support_help){
                        Helper::sendHelpSmstoSupport($support_help);
                    }
                    echo json_encode(array('status'=>'success','message'=> Config::get('constants.WebMessageCode.111')));
                }catch(\Exception $e){
                    echo json_encode(array('status'=>'error','message'=> Config::get('constants.WebMessageCode.121')));
                }
                break;
                
                default:
                    break;
            }

    	}
    }
    public function teacherHelpMSG($teacher_id = 0){
        $apiKey     = env( 'TEXTLOCAL_APIKEY' );
        $txt_sender = env( 'TEXTLOCAL_SENDER' );
        $support_number = env( 'SUPPORT_NUMBER' );
        $sender = urlencode($txt_sender);

        $getRow = \App\User::find($teacher_id);
        $name = $getRow->name;
        $email = $getRow->email;

        if($support_number && $email){
            $message = 'Teacher: '. ucwords($name). '('.$email.') need help';

            if(strlen($support_number) <= 10){
                $number = '91'.$support_number;
            }else{
                $number = $support_number;
            } 

            $data = array('apikey' => $apiKey, 'numbers' => $number, "sender" => $sender, "message" => $message);

            // Send the POST request with cURL
            $ch = curl_init('https://api.textlocal.in/send/');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            // Process your response here
            $result = json_decode($response);

            if($result->status == 'success'){
                return true;
            }else{
                return false;
            }

        }
    } */
}
