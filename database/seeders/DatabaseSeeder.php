<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([RoleSeeder::class]);

        User::create([
            'cedula'=>100000,
            'nombre'=>'Administrador',
            'apellido'=>'Principal',
            'rol'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('12345678'),
            'borrado'=>false,
        ])->assignRole('admin');;
        
        User::create([
            'cedula'=>12345678,
            'nombre'=>'Usuario',
            'apellido'=>'prueba',
            'rol'=>'usuario',
            'email'=>'usuario@admin.com',
            'password'=>Hash::make('12345678'),
            'borrado'=>false,
        ])->assignRole('usuario');;
    }
}
