<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('admin');

        User::create([
            'name'=>'Estudiante',
            'email'=>'estudiante@estudiante.com',
            'password'=>bcrypt('12345678')
        ])->assignRole('estudiante');

        User::create([
            'name'=>'Coordinador',
            'email'=>'coordinador@coordinador.com',
            'password'=>bcrypt('12345678')
        ])->assignRole('coordinador');
    }
}
