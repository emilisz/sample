<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use Illuminate\Http\Request;
use Session;

class EmployeeController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth')->except('index','show'); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company, Request $request)
    {
        // dd($request->id);
        $company = Company::find($request->id);
        return view('employees.create', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Employee $employee, Request $request)
    {
        $validated = request()->validate([
            'company'=> 'required',
           'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);
       $employee = $employee->addEmployee($validated);
       Session::flash('message', "Employee created");
        return redirect('/companies/'.$request->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company,Employee $employee)
    {
        return view('employees.edit',compact('employee','company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Company $company, Employee $employee)
    {
        $validated = request()->validate([
            'company'=> 'required',
           'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|min:5',
            'phone' => 'required|max:12',
        ]);
       $employee = $employee->updateEmployee($validated);
       Session::flash('message', "Employee edited successfully");
        return redirect('/companies/'.$company->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, Employee $employee)
    {
        $employee->delete();
        Session::flash('message', "Employee deleted");
        return redirect()->back();
    }
}
