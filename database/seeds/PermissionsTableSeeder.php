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
            'description'  => 'Crea un nuevo rol',
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
            'name'         => 'Crear usuario',
            'slug'         => 'create_users',
            'description'  => 'Crea un nuevo usuario',
            'isroot'       => '0',
        ]);

        Permission::create([
            'name'         => 'Ver usuarios del sistema',
            'slug'         => 'index_users',
            'description'  => 'Muestra una lista de todos los usuarios del sistema',
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
    }
}
