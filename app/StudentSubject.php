<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
   protected $table = 'tbl_student_subjects';
  
   protected $fillable = ['subject_name'];
	
	public function classtiming()
    {
        return $this->hasMany('App\ClassTiming');
    }
	public function studentClass()
    {
      return $this->belongsTo('App\StudentClass','subject_id','id');
    }
}