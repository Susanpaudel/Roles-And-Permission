<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
   
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $permissions=[
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'blog-list',
            'blog-create',
            'blog-edit',
            'blog-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
        ];
        foreach($permissions as $permission){
            Permission::create([
              'name'=>$permission,
            ]);
        }

        $super_admin=\App\Models\User::create([
            'name' => 'Susan',
            'email' => 'superadmin@gmail.com',
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        $admin=\App\Models\User::create([
            'name' => 'Susan II',
            'email' => 'admin@gmail.com',
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        $role_superadmin=Role::create(['name' => 'SuperAdmin']);
        $role_admin=Role::create(['name' => 'Admin']);

        $get_permission=Permission::pluck('id','id')->all();
        $role_superadmin->syncPermissions($get_permission);

        $super_admin->assignRole([$role_superadmin->id]);
        $admin->assignRole([$role_admin->id]);
    }
}
