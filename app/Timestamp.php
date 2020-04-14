<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Timestamp extends Model
{

	protected $fillable = ['status', 'time'];

    public function date()
    {
        return $this->belongsTo(Date::class);
    }
}
