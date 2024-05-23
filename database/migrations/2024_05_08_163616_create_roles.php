<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       $role1 = Role::create(['name'=>'admin']);
       $role2 = Role::create(['name'=>'seguros']);
       $role3 = Role::create(['name'=>'afiliaciones']);

       $user= User::find(1);
       $user2= User::find(2);
       $user3=User::find(3);
       $user4= User::find(4);
       $user5=User::find(5);
       $user5=User::find(5);

       $user->assignRole($role1);
       $user2->assignRole($role1);
       $user3->assignRole($role1);
       $user4->assignRole($role2);
       $user5->assignRole($role3);






    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
