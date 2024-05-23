<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([

            'name'=>'Prueba',
            'email'=>'test@test.com',
            'password'=>bcrypt('perro12s')

        ])->assingRole('Admin');


        User::factory(9)->create();
    }
}
