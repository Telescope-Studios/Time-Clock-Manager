<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Job extends Model
{
    protected $collection = 'job_collection';
     //protected $primaryKey = 'id';
    protected $connection = 'mongodb';

    protected $fillable = ['name', 'description'];

    public function date()
    {
        return $this->belongsTo(Date::class);
    }

    public function job()
    {
        return $this->belongsTo(Employee::class);
    }
}
