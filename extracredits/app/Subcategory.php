<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = array('name', 'slug');
    
    public function subject() {
        return $this->belongsTo('App\Subject');
    }
    
    public function topic() {
        return $this->hasMany('App\Topic');
    }
}
