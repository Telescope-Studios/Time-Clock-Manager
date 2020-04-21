<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Employee extends Model
{
     protected $collection = 'employee_collection';
     //protected $primaryKey = 'id';
     protected $connection = 'mongodb';

     protected $fillable = ['firstname', 'lastname', 'slug', 'active', 'avatar', 'dates', 'job'];
     protected $dates = ['created_at', 'updated_at'];

    public function dates()
    {
        return $this->embedsMany(Date::class);
    }

    public function job()
    {
        return $this->embedsOne(Job::class);
    }

     public function getRouteKeyName(){
    	return 'slug';
    }
}
