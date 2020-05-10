<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportHelp extends Model
{
	protected $table = 'lms_support_helps';

    public function class() {
        return $this->hasOne('App\StudentClass','id','class_id');
    }

    public function teacher() {
        return $this->hasOne('App\Teacher','id','teacher_id');
    }

    public function subject() {
        return $this->hasOne('App\StudentSubject','id','subject_id');
    }
}
