<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = array('stripeToken', 'name_on_card', 'credit_topup', 'amount', 'email', 'phone', 'address', 'city', 'county', 'country');

    public function user() {
        return $this->belongsTo('App\User');
    }
}
