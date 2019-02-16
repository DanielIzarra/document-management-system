<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'         => 'Crear rol',
            'slug'         => 'create_roles',
            'description'  => 'Permite crear un nuevo rol',
            'isroot'       => '1',
        ]);

        Permission::create([
            'name'         => 'Ver roles',
            'slug'         => 'index_roles',
            'description'  => 'Muestra una lista de los roles',
            'isroot'       => '1',
        ]);

        Permission::create([
            'name'         => 'Editar rol',
            'slug'         => 'edit_roles',
            'description'  => 'Permite editar la información de un rol',
            'isroot'       => '1',
        ]);

        Permission::create([
            'name'         => 'Eliminar rol',
            'slug'         => 'destroy_roles',
            'description'  => 'Permite eliminar un rol',
            'isroot'       => '1',
        ]);

        Permission::create([
            'name'         => 'Crear usuario de empresa',
            'slug'         => 'create_user_company',
            'description'  => 'Permite crear un nuevo usuario en la empresa',
            'isroot'       => '0',
        ]);
        Permission::create([
            'name'         => 'Crear usuario de sucursal',
            'slug'         => 'create_user_delegation',
            'description'  => 'Permite crear un nuevo usuario en la sucursal',
            'isroot'       => '0',
        ]);
        Permission::create([
            'name'         => 'Crear usuario de departamento',
            'slug'         => 'create_user_department',
            'description'  => 'Permite crear un nuevo usuario en el departamento',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Ver usuarios del sistema',
            'slug'         => 'index_users',
            'description'  => 'Muestra todos los usuarios del sistema',
            'isroot'       => '1',
        ]);     

        Permission::create([
            'name'         => 'Ver perfil de usuario',
            'slug'         => 'show_users',
            'description'  => 'Permite ver la información del perfil de un usuario',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Editar perfil de usuario',
            'slug'         => 'edit_users',
            'description'  => 'Permite editar la información del perfil de un usuario',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Eliminar usuario',
            'slug'         => 'destroy_users',
            'description'  => 'Permite eliminar un usuario',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Crear empresa',
            'slug'         => 'create_companies',
            'description'  => 'Permite crear una nueva empresa',
            'isroot'       => '1',
        ]);

        Permission::create([
            'name'         => 'Ver empresas del sistema',
            'slug'         => 'index_companies',
            'description'  => 'Muestra todas las empresas del sistema',
            'isroot'       => '1',
        ]);

        Permission::create([
            'name'         => 'Ver empresas administradas',
            'slug'         => 'index_admin_companies',
            'description'  => 'Muestra las empresas administradas por un usuario',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Ver usuarios de una empresa',
            'slug'         => 'index_users_company',
            'description'  => 'Muestra los usuarios de una empresa',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Ver sucursales de una empresa',
            'slug'         => 'index_delegations_company',
            'description'  => 'Muestra todas las sucursales de una empresa',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Ver departamentos de una empresa',
            'slug'         => 'index_departments_company',
            'description'  => 'Muestra todos los departamentos de una empresa',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Ver información de la empresa',
            'slug'         => 'show_companies',
            'description'  => 'Permite ver la información de una empresa',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Editar información de la empresa',
            'slug'         => 'edit_companies',
            'description'  => 'Permite editar la información de la empresa',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Eliminar empresa',
            'slug'         => 'destroy_companies',
            'description'  => 'Permite eliminar una empresa',
            'isroot'       => '1',
        ]);

        Permission::create([
            'name'         => 'Asignar/desasignar administrador a empresa',
            'slug'         => 'assign_admin_companies',
            'description'  => 'Permite la asignación de un administrador a una o varias empresas',
            'isroot'       => '1',
        ]);

        Permission::create([
            'name'         => 'Crear sucursal',
            'slug'         => 'create_delegations',
            'description'  => 'Permite crear una nueva sucursal',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Ver sucursales del sistema',
            'slug'         => 'index_delegations',
            'description'  => 'Muestra todas las sucursales del sistema',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Ver sucursales administradas',
            'slug'         => 'index_admin_delegations',
            'description'  => 'Muestra las sucursales administradas por un usuario',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Ver usuarios de una sucursal',
            'slug'         => 'index_users_delegation',
            'description'  => 'Muestra los usuarios de una sucursal',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Ver departamentos de una sucursal',
            'slug'         => 'index_departments_delegation',
            'description'  => 'Muestra todos los departamentos de una sucursal',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Ver información de la sucursal',
            'slug'         => 'show_delegations',
            'description'  => 'Permite ver la información de una sucursal',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Editar información de la sucursal',
            'slug'         => 'edit_delegations',
            'description'  => 'Permite editar la información de la sucursal',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Eliminar sucursal',
            'slug'         => 'destroy_delegations',
            'description'  => 'Permite eliminar una sucursal',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Asignar/desasignar administrador a sucursal',
            'slug'         => 'assign_admin_delegations',
            'description'  => 'Permite la asignación de un administrador a una o varias sucursales',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Crear departamento de empresa',
            'slug'         => 'create_department_company',
            'description'  => 'Permite crear un nuevo departamento en una empresa',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Crear departamento de sucursal',
            'slug'         => 'create_department_delegation',
            'description'  => 'Permite crear un nuevo departamento en una sucursal',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Ver departamentos administrados',
            'slug'         => 'index_admin_departments',
            'description'  => 'Muestra los departamentos administrados por un usuario',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Ver usuarios de un departamento',
            'slug'         => 'index_users_department',
            'description'  => 'Muestra los usuarios de un departamento',
            'isroot'       => '0',
        ]);  

        Permission::create([
            'name'         => 'Ver información del departamento',
            'slug'         => 'show_departments',
            'description'  => 'Permite ver la información de un departamento',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Editar información del departamento',
            'slug'         => 'edit_departments',
            'description'  => 'Permite editar la información del departamento',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Eliminar departamento',
            'slug'         => 'destroy_departments',
            'description'  => 'Permite eliminar un departamento',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Asignar/desasignar administrador a departamento',
            'slug'         => 'assign_admin_departments',
            'description'  => 'Permite la asignación de un administrador a uno o varios departamentos',
            'isroot'       => '0',
        ]);
    }
}
