<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'company','first_name','last_name','email','phone'
    ];
     /**
     * add new employee.
     */
    public function addEmployee($employee)
    {
       return $this->create($employee);
    }

    /**
     * updateEmployee
     * @param  [type] $employee [description]
     * @return [type]           [description]
     */
    public function updateEmployee($employee)
    {
       return $this->update($employee);
    }

    public function company()
    {
    return $this->belongsTo('App\Company', 'company');
    }
}
