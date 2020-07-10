<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function level_of() {
        return $this->belongsTo('App\Lesson');
    }
}
