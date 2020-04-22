<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeReport extends Model
{
    protected $fillable = ['employee', 'from', 'to', 'hours'];

    public function employee()
    {
        return $this->embedsOne(Employee::class);
    }
}
