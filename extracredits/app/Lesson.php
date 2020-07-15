<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = array('title', 'link', 'thumbnail', 'description');

    public function has_subject() {
        return $this->hasOne('App\Subject');
    }
    public function has_level() {
        return $this->hasOne('App\Level');
    }

    public function user_unlocked() {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
