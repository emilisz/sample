<?php

namespace App;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'first_name','email','logo','website'
    ];
     /**
     * add new company.
     */
    public function addCompany($company)
    {
       return $this->create($company);
    }
    public function updateCompany($company)
    {
       return $this->update($company);
    }

    public function saveLogo($company,$request)
    {
          $image = $request->file('logo');
        $name = time().'.'.$image->getClientOriginalExtension();
        $company = Company::find($this->id);
        $company->logo = $name;
        $company->save();

        $path = $image->storeAs(
            'public/logos', $name
        );
       
         
    }
     /**
     * Get the employees for the company.
     */
    public function employees()
    {
        return $this->hasMany('App\Employee','company');
    }
}
