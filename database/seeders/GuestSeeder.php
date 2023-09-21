<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Joanne Yap', 
            'email' => 'joanne@me.com',
            'password' => bcrypt('password')
        ]);
        
        $role = Role::create(['name' => 'Guest']);
         
        $permissions = Permission::whereIn('name', [
            'user-list',
            'user-create', 
            'role-list', 
            'product-list',
            'product-create',
            'product-edit'
        ])->get();
       
        $role->syncPermissions($permissions);
         
        $user->assignRole([$role->id]);
    }
}
