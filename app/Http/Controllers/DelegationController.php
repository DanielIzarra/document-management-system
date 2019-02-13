<?php

namespace App\Http\Controllers;

use App\Delegation;
use App\Company;
use Validator;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DelegationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Company $company)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Auth::user()->companies()->get();

        return view('delegations.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Delegation $delegation)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191|unique:delegations',
        ]);

        if (request('email')) {
            $this->validate(request(), [
                'email' => 'string|email|max:191',
            ]);

            $delegation->email = request('email');
        }

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $delegation->name = request('name');
        $delegation->company_id = request('company');

        $delegation->save();

        return back()->with('status', 'Delegation created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Delegation  $delegation
     * @return \Illuminate\Http\Response
     */
    public function show(Delegation $delegation)
    {
        return view('delegations.show', compact('delegation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Delegation  $delegation
     * @return \Illuminate\Http\Response
     */
    public function edit(Delegation $delegation)
    {
        return view('delegations.edit', compact('delegation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Delegation  $delegation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delegation $delegation)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191|unique:delegations',

        ]);

        $delegation->name = request('name');

        if (request('email')) {
            $this->validate(request(), [
                'email' => 'string|email|max:191',
            ]);

            $delegation->email = request('email');
        }

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $delegation->save();

        return back()->with('status', 'Updated delegation data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Delegation  $delegation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delegation $delegation)
    {
        $delegation->delete();

        return back()->with('status', 'Delegation deleted');
    }
}
