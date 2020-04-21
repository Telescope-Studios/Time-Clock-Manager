<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Date extends Model
{

	protected $fillable = ['checkin', 'checkout'];
    //protected $dates = ['checkin', 'checkout'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
