<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Report extends Model
{
    protected $collection = 'report_collection';
    protected $connection = 'mongodb';

    protected $fillable = ['from', 'to', 'job'];

    public function job()
    {
        return $this->embedsOne(Job::class);
    }
}
