<?php

namespace App\Http\Controllers;

use App\Company;
use App\Mail\CompanyCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;
use Session;
use Illuminate\Support\Facades\Mail;

class CompanyController extends Controller
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
        $allCompanies = Company::all();
        return view('companies.index', compact('allCompanies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Company $company, Request $request)
    {

        $validated = request()->validate([
            'first_name' => 'required',
            'email' => 'required',
            'website' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
        ]);
       $company->addCompany($validated)->saveLogo($company,$request);
       Mail::to($request->user())->send(new CompanyCreated($company));
       Session::flash('message', "Company created");
        return redirect('/companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company = Company::find($company->id);
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Company $company, Request $request)
    {
         $validated = request()->validate([
            'first_name' => 'required',
            'email' => 'required',
            'website' => 'required',
        ]);

         $company->updateCompany($validated);

        if ($request->hasFile('logo')) {
            Storage::delete('public/logos/'.$company->logo);
            $company->saveLogo($company,$request);
        }
       Session::flash('message', "Company updated");
        return redirect('/companies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        Storage::delete('public/logos/'.$company->logo);
        $company->delete();
        Session::flash('message', "Company deleted");
        return redirect('/companies');
    }
}
