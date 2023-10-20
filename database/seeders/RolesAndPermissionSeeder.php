<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Misc  how the permission is fetched???
        $miscPermission=Permission::create(['name'=>'N/A']);

        //User Model
        $userPermission1=Permission::create(['name'=>'create: user']);
        $userPermission2=Permission::create(['name'=>'read: user']);
        $userPermission3=Permission::create(['name'=>'update: user']);
        $userPermission4=Permission::create(['name'=>'delete: user']);

        //Role Model
        $rolePermission1=Permission::create(['name'=>'create: role']);
        $rolePermission2=Permission::create(['name'=>'read: role']);
        $rolePermission3=Permission::create(['name'=>'update: role']);
        $rolePermission4=Permission::create(['name'=>'delete: role']);

        //Permission Model
        $permission1=Permission::create(['name'=>'create: permission']);
        $permission2=Permission::create(['name'=>'read: permission']);
        $permission3=Permission::create(['name'=>'update: permission']);
        $permission4=Permission::create(['name'=>'delete: permission']);

        //Admins
        $adminPermission2=Permission::create(['name'=>'read: permission']);
        $adminPermission1=Permission::create(['name'=>'update: permission']);

        //Create roles
        $userRole=Role:: create(['name'=>'user'])->syncPermissions([
            $miscPermission,
        ]);

        $superAdminRole=Role:: create(['name'=>'super-admin'])->syncPermissions([
            $userPermission1,
            $miscPermission,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission2,
            $adminPermission1,
            $userPermission1,
        ]);

        $adminRole=Role:: create(['name'=>'admin'])->syncPermissions([
            $userPermission1,
            $miscPermission,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $permission1,
            $permission2,
            $permission3,
            $permission4,
            $adminPermission2,
            $adminPermission1,
            $userPermission1,
        ]);

        $moderatorRole=Role:: create(['name'=>'moderator'])->syncPermissions([
            $userPermission2,
            $rolePermission2,
            $permission2,
            $adminPermission1,
        ]);

        $developerRole=Role:: create(['name'=>'developer'])->syncPermissions([
            $adminPermission1,
        ]);

        User::create([
            'name'=>'super admin',
            'is_admin'=>1,
            'email'=>'super@admin.com',
            'email_varified_at'=>now(),
            'password'=>Hash::make('password'),
            'remember_token'=> Str::random(10),
        ])->assignRole($superAdminRole);

        User::create([
            'name'=>'admin',
            'is_admin'=>1,
            'email'=>'admin@admin.com',
            'email_varified_at'=>now(),
            'password'=>Hash::make('password'),
            'remember_token'=> Str::random(10),
        ])->assignRole($adminRole);

        User::create([
            'name'=>'moderator',
            'is_admin'=>1,
            'email'=>'moderator@admin.com',
            'email_varified_at'=>now(),
            'password'=>Hash::make('password'),
            'remember_token'=> Str::random(10),
        ])->assignRole($moderatorRole);

        User::create([
            'name'=>'developer',
            'is_admin'=>1,
            'email'=>'developer@admin.com',
            'email_varified_at'=>now(),
            'password'=>Hash::make('password'),
            'remember_token'=> Str::random(10),
        ])->assignRole($developerRole);

        for($i=1;$i<50;$i++){
            User::create([
                'name'=>'test '.$i,
                'is_admin'=>0,
                'email'=>'test ' .$i.'@test.com',
                'email_varified_at'=>now(),
                'password'=>Hash::make('password'),
                'remember_token'=> Str::random(10),
            ])->assignRole($userRole);
        }
    }
}
