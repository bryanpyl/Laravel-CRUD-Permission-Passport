<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Jasmin', 
            'email' => 'jasmin@me.com',
            'password' => bcrypt('password')
        ]);
        
        $role = Role::create(['name' => 'Manager']);
         
        $permissions = Permission::whereIn('name', [
            'user-list', 
            'role-list', 
            'product-list',
            'product-create',
            'product-edit',
            'product-delete'
        ])->get();
       
        $role->syncPermissions($permissions);
         
        $user->assignRole([$role->id]);
    }
}
