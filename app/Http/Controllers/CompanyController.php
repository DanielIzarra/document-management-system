<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use App\Delegation;
use App\Department;
use Validator;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(20);

        return view('companies.index', compact('companies'));
    }

    /**
     * Display a listing of the users received.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_search(Request $request)
    {
        $companies = Company::whereIn('id', $request->ids)->get();

        return view('companies.index', compact('companies'));
    }

    public function index_company_search($id)
    {
        $companies = Company::where('id', $id)->get();

        return view('companies.index', compact('companies'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_administrator()
    {
        $companies = Auth::user()->companies()->paginate(5);

        return view('companies.index', compact('companies'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_users_company(Company $company)
    {
        $users = $company->users()->get();

        return view('users.index', compact('users', 'company'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_delegations_company(Company $company)
    {
        $delegations = Delegation::where('company_id', '=', $company->id)->paginate(5);

        return view('delegations.index', compact('delegations', 'company'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_departments_company(Company $company)
    {
        $departments = Department::where('company_id', '=', $company->id)->paginate(5);

        return view('departments.index', compact('departments', 'company'));
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
     * @param  \App\Company  $company
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'denomination' => 'required|string|max:191',
            'cif' => 'required|string|max:191|unique:companies',
        ]);

        if (request('email')) {
            $this->validate(request(), [
                'email' => 'string|email|max:191',
            ]);

            $company->email = request('email');
        }

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $company->name = request('name');
        $company->denomination = request('denomination');
        $company->cif = request('cif');

        $company->save();

        return back()->with('status', 'Company created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
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
    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'denomination' => 'required|string|max:191',
            'cif' => 'required|string|max:191|unique:companies',
        ]);

        if (request('email')) {
            $this->validate(request(), [
                'email' => 'string|email|max:191',
            ]);

            $company->email = request('email');
        }

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $company->name = request('name');
        $company->denomination = request('denomination');
        $company->cif = request('cif');

        $company->save();

        return back()->with('status', 'Updated company data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return back()->with('status', 'Company deleted');
    }

    /**
     * Show the form for creating new user assigment(administrator) to companies or delegations.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function create_assign_companies(User $user)
    {
        $companies = Company::all();
        $checked_companies = $user->companies()->get();
        $delegations = Delegation::all();
        $checked_delegations = $user->delegations()->get();

        return view('companies.assign_admin', compact('user', 'companies', 'checked_companies', 
                    'delegations', 'checked_delegations'));
    }

    /**
     * Stores a newly created user assigment(administrator) to companies or delegations in storage.
     * 
     * @param  \App\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_assign_companies(Request $request, User $user)
    {
        $user->companies()->sync($request->get('companies'));        
        $user->delegations()->sync($request->get('delegations'));        

        return back()->with('status', 'Assigned companies or delegations');
    }
}
