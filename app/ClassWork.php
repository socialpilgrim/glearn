<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassWork extends Model
{
  protected $table = 'tbl_classwork';
	
	protected $fillable = ['class_id','g_live_link','g_class_id','classwork_type','g_topic_id','g_points','g_status','g_action','g_title','g_due_date','teacher_id','subject_id'];
    
	
	 public function studentClass()
    {
      return $this->belongsTo('App\StudentClass','class_id','id');
    }
    public function teacher()
    {
      return $this->belongsTo('App\Teacher','teacher_id','id');
    }
	 public function timetable()
    {
      return $this->belongsTo('App\ClassTiming','timetable_id','id');
    }
	
}