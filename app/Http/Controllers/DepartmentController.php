<?php

namespace App\Http\Controllers;

use App\Department;
use App\Delegation;
use App\Company;
use Validator;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{

    /**
     * Display a listing of the users received.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_search(Request $request)
    {
        $departments = Department::whereIn('id', $request->ids)->get();

        return view('departments.index', compact('departments'));
    }

    public function index_department_search($id)
    {
        $departments = Department::where('id', $id)->get();

        return view('departments.index', compact('departments'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_administrator(Department $department)
    {
        $departments = Auth::user()->departments()->paginate(5);

        return view('departments.index', compact('departments'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_users_department(Department $department)
    {
        $users = $department->users()->get();

        return view('users.index', compact('users', 'department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_department_company(Company $company)
    {
        return view('departments.create', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_department_delegation(Delegation $delegation)
    {
        return view('departments.create', compact('delegation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Department $department)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
        ]);

        if (request('email')){
            $this->validate(request(), [
                'email' => 'string|email|max:191',
            ]);

            $department->email = request('email');
        }

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $department->name = request('name');
        $department->email = request('email');

        if(isset($request->company_id)){
            $department->company_id = request('company_id');
        }
        if(isset($request->delegation_id)){
            $department->delegation_id = request('delegation_id');
        }
                
        $department->save();

        return back()->with('status', 'Department created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',

        ]);

        $department->name = request('name');

        if (request('email')) {
            $this->validate(request(), [
                'email' => 'string|email|max:191',
            ]);

            $department->email = request('email');
        }

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $department->save();

        return back()->with('status', 'Updated department data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return back()->with('status', 'Department deleted');
    }
}
