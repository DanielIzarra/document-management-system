<?php

namespace App\Http\Controllers;

use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Traits;
use Validator;
use Redirect;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function index(Role $roles)
    {
        $roles = Role::paginate();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.create', compact('role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191|unique:roles',
            'slug' => 'required|string|max:191|unique:roles',
            'description' => 'nullable|string|max:100',
            'isroot' => 'required|boolean',
        ]);

        if($validator->fails()){
            return Redirect::Back()
                ->withInput()
                ->withErrors($validator);
        }

        $role = Role::create($request->all());

       /*
        * Sincroniza los permisos dados con el rol, 
        * para crear las entradas en la tabla permission_role
        */
        $role->permissions()->sync($request->get('permissions'));
        
        return back()->with('status', 'Role created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $checked_permissions = $role->permissions()->get();
        $isroot = $role->isroot;
        return view('roles.edit', compact('role', 'permissions', 'checked_permissions', 'isroot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'slug' => 'required|string|max:191',
            'description' => 'nullable|string|max:100',
            'isroot' => 'required|boolean'
        ]);

        if($validator->fails()) {
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
        
        /* 
        * 'name' y 'slug' deben de ser únicos en la base de datos, 
        * se controla la excepción 
        */        
        try {
            $role->update($request->all());
            $role->permissions()->sync($request->get('permissions'));
            return back()->with('status', 'Role updated');
        } catch(\Illuminate\Database\QueryException $ex) {
            $validator->getMessageBag()->add('name', 'Make sure there is no other role with this name');
            $validator->getMessageBag()->add('slug', 'Make sure there is no other role with this slug');
            return Redirect::back()
                ->withInput()
                ->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return back()->with('status', 'Role deleted');
    }
}
