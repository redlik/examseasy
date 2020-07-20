<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = array('title', 'link', 'thumbnail', 'description');

    public function subject() {
        return $this->belongsTo('App\Subject');
    }
    public function level() {
        return $this->belongsTo('App\Level');
    }

    public function user_unlocked() {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
