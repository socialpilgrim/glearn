<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
	
	protected $table = 'tbl_student_classes';
	
	protected $fillable = ['class_name','section_name','subject_id','g_class_id','g_link','g_response','student_numbers'];
	
	public function classtiming()
    {
        return $this->hasMany('App\ClassTiming');
    }
	 public function studentSubject()
    {
      return $this->hasOne('App\StudentSubject','id','subject_id');
    }
	public function InvitationClass()
    {
        return $this->hasMany('App\InvitationClass','class_id','id');
    }
	
	public function classwork()
    {
        return $this->hasMany('App\ClassWrok','class_id','id');
    }
	
	public function classtopic()
    {
        return $this->hasMany('App\ClassTopic','class_id','id');
    }
}

