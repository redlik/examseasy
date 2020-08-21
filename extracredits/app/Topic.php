<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = array('name', 'slug');
    
    public function lesson() {
        return $this->hasMany('App\Lesson');
    }

    public function subcategory() {
        return $this->belongsTo('App\Subcategory');
    }
}
