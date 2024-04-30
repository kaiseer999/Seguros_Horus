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
    $rol1 =Role::create(['name'=>'Admin']);
    $rol2=Role::create(['name'=>'Seguros']);
    $rol3= Role::create(['name'=>'Afiliaciones']);


        
    }
}
