<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Timestamp extends Model
{
    public function date()
    {
        return $this->belongsTo(Date::class);
    }
}
