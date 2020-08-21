<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = array('title', 'link', 'thumbnail', 'description');

    public function level() {
        return $this->belongsTo('App\Level');
    }

    public function subject() {
        return $this->belongsTo('App\Subject');
    }
    
    public function topic() {
        return $this->belongsTo('App\Topic');
    }

    public function subcategory() {
        return $this->hasOneThrough('App\Subcategory', 'App\Topic');
    }

    public function user() {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
