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
    }
}
