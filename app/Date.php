<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Date extends Model
{

	protected $fillable = ['name', 'job', 'completed', 'timestamps'];

    public function timestamps()
    {
        return $this->embedsMany(Timestamp::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function job()
    {
        return $this->embedsOne(Job::class);
    }
}
