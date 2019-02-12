<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use Validator;
use Redirect;
use Caffeinated\Shinobi\Traits;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $users = User::paginate(20);

        return view('users.index', compact('users')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allroles = Role::all();
        $companies = Auth::user()->companies()->get();        

        return view('users.create', compact('allroles', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $user->name = request('name');
        $user->email = request('email');
        $user->password = Hash::make(request('password'));
        
        $user->save();

        $user->companies()->sync($request->get('companies'));
        $user->roles()->sync($request->get('roles'));

        return back()->with('status', 'User created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $permissions = Permission::all();
        $checked_permissions = $user->permissions()->get();
        $roles = Role::all();
        $checked_roles = $user->roles()->get();
        $companies = Auth::user()->companies()->get();
        $checked_companies = $user->companies()->get();       

        return view('users.edit', compact('user', 'permissions', 'checked_permissions', 
                    'roles', 'checked_roles', 'companies', 'checked_companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
        ]);

        $user->name = request('name');

        if (request('password')) {
            $this->validate(request(), [
                'password' => 'string|min:6|confirmed|max:191',
            ]);

            $user->password = Hash::make(request('password'));
        }

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }

        $user->save();

        $user->companies()->sync($request->get('companies'));
        $user->permissions()->sync($request->get('permissions'));
        $user->roles()->sync($request->get('roles'));

        return back()->with('status', 'Profile updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('status', 'User deleted');
    }
}
