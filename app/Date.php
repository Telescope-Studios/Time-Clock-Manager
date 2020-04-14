<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Date extends Model
{
    public function timestamps()
    {
        return $this->embedsMany(Timestamp::class);
    }

    public function user()
    {
        return $this->belongsTo(Employee::class);
    }
}
