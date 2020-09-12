<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function subcategory() {
        return $this->hasMany('App\Subcategory');
    }

    public function countSubcategories() {
        return $this->hasMany('App\Subcategory')->count();
    }
    
    public function lesson() {
        return $this->hasMany('App\Lesson');
    }
}
