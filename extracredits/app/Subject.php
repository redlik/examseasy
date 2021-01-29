<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function subcategory() {
        return $this->hasMany('App\Subcategory');
    }

    public function categories()
    {
        return $this->hasMany('App\Subcategory')->orderBy('order_position', 'asc');
    }

    public function topics()
    {
        return $this->hasManyThrough(Topic::class, Subcategory::class);
    }

    public function countSubcategories() {
        return $this->hasMany('App\Subcategory')->count();
    }

    public function lesson() {
        return $this->hasMany('App\Lesson');
    }
}
