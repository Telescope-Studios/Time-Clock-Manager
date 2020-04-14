<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Job extends Model
{
    protected $collection = 'job_collection';
     //protected $primaryKey = 'id';
    protected $connection = 'mongodb';

    protected $fillable = ['name', 'description', 'rate'];
}
