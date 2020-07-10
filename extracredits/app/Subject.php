<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function subject_of() {
        return $this->belongsTo('App\Lesson');
    }
}
