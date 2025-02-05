<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Administrador
        //Usuario
        
        $admin = Role::create(['name' => 'admin']);
        $usuario = Role::create(['name' => 'usuario']);

        //Permisos
        Permission::create(['name' => 'admin.index'])->syncRoles([$admin,$usuario]);
        Permission::create(['name' => 'usuarios.index'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.create'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.store'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.show'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.edit'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.update'])->syncRoles([$admin]);
        Permission::create(['name' => 'usuarios.destoy'])->syncRoles([$admin]);

        Permission::create(['name' => 'mi_unidad.index'])->syncRoles([$admin,$usuario]);
        Permission::create(['name' => 'mi_unidad.store'])->syncRoles([$admin,$usuario]);
        Permission::create(['name' => 'mi_unidad.carpeta'])->syncRoles([$admin,$usuario]);
        Permission::create(['name' => 'mi_unidad.carpeta.update_subcarpeta'])->syncRoles([$admin,$usuario]);
        Permission::create(['name' => 'mi_unidad.carpeta.update_subcarpeta_color'])->syncRoles([$admin,$usuario]);
        Permission::create(['name' => 'mi_unidad.carpeta.crear_subcarpeta'])->syncRoles([$admin,$usuario]);
        Permission::create(['name' => 'mi_unidad.update'])->syncRoles([$admin,$usuario]);
        Permission::create(['name' => 'mi_unidad.update_color'])->syncRoles([$admin,$usuario]);
        Permission::create(['name' => 'carpeta.destroy'])->syncRoles([$admin,$usuario]);

        Permission::create(['name' => 'mi_unidad.archivo.upload'])->syncRoles([$admin,$usuario]);
        Permission::create(['name' => 'mi_unidad.archivo.eliminar_archivo'])->syncRoles([$admin,$usuario]);
        Permission::create(['name' => 'mi_unidad.archivo.privado_a_publico'])->syncRoles([$admin,$usuario]);
        Permission::create(['name' => 'mi_unidad.archivo.publico_a_privado'])->syncRoles([$admin,$usuario]);
        Permission::create(['name' => 'mostrar.archivo.privados'])->syncRoles([$admin,$usuario]);

        
    }
}
