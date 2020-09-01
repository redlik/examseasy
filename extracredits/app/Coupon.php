<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = array('code', 'type', 'value', 'enabled', 'limited', 'limit_of_uses', 'expiry');
    
    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }

    public function discount($total)
    {
        if ($this->type == 'fixed') {
            return $this->value;
        } elseif ($this->type == 'percent') {
            return round(($this->percent_off / 100) * $total);
        } else {
            return 0;
        }
    }
}
