<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    public function subject() {
        return $this->belongsTo('App\Subject');
    }
    public function lesson() {
        return $this->hasMany('App\Lesson');
    }
}
