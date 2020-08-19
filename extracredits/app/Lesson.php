<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = array('title', 'link', 'thumbnail', 'description');

    public function level() {
        return $this->belongsTo('App\Topic');
    }

    public function subcategory() {
        return $this->hasOneThrough('App\Subject', 'App\Subcategory');
    }

    public function user() {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
