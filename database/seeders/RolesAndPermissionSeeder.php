<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
        $voterPermission1=Permission::create(['name'=>'create: voter']);
        $voterPermission2=Permission::create(['name'=>'read: voter']);
        $voterPermission3=Permission::create(['name'=>'update: voter']);
        $voterPermission4=Permission::create(['name'=>'delete: voter']);

        $aecPermission1=Permission::create(['name'=>'create: aec']);
        $aecPermission2=Permission::create(['name'=>'read: aec']);
        $aecPermission3=Permission::create(['name'=>'update: aec']);
        $aecPermission4=Permission::create(['name'=>'delete: aec']);

        $partyPermission1=Permission::create(['name'=>'create: party']);
        $partyPermission2=Permission::create(['name'=>'read: party']);
        $partyPermission3=Permission::create(['name'=>'update: party']);
        $partyPermission4=Permission::create(['name'=>'delete: party']);

        $candidatePermission1=Permission::create(['name'=>'create: candidate']);
        $candidatePermission2=Permission::create(['name'=>'read: candidate']);
        $candidatePermission3=Permission::create(['name'=>'update: candidate']);
        $candidatePermission4=Permission::create(['name'=>'delete: candidate']);

        $electionPermission1=Permission::create(['name'=>'create: election']);
        $electionPermission2=Permission::create(['name'=>'read: election']);
        $electionPermission3=Permission::create(['name'=>'update: election']);
        $electionPermission4=Permission::create(['name'=>'delete: election']);

        $votePermission1=Permission::create(['name'=>'create: vote']);
        $votePermission2=Permission::create(['name'=>'read: vote']);

        // Create roles
        $voterRole=Role:: create(['name'=>'voter'])->syncPermissions([
            $votePermission1,
        ]);

        $superAdminRole=Role:: create(['name'=>'super-admin'])->syncPermissions([
            $voterPermission1,
            $voterPermission2,
            $voterPermission3,
            $voterPermission4,
            $aecPermission1,
            $aecPermission2,
            $aecPermission3,
            $aecPermission4,
        ]);

        $aecCommisionerRole=Role:: create(['name'=>'admin'])->syncPermissions([
            $partyPermission1,
            $partyPermission2,
            $partyPermission3,
            $partyPermission4,
            $electionPermission1,
            $electionPermission2,
            $electionPermission3,
            $electionPermission4,
            $candidatePermission1,
            $candidatePermission2,
            $candidatePermission3,
            $candidatePermission4,
            $votePermission2,
        ]);

        User::updateOrCreate([
            'name'=>'super admin',
            'is_admin'=>1,
            'email'=>'super@admin.com',
            'password'=>Hash::make('password'),
            'remember_token'=> Str::random(10),
        ],[])->assignRole($superAdminRole);

        User::updateOrCreate([
            'name'=>'aec commissioner',
            'is_admin'=>1,
            'email'=>'aec-commissioner@admin.com',
            'password'=>Hash::make('password'),
            'remember_token'=> Str::random(10),
        ],[])->assignRole($aecCommisionerRole);

        for($i=1;$i<50;$i++){
            User::updateOrCreate([
                'name'=>'voter'.$i,
                'is_admin'=>0,
                'email'=>'voter ' .$i.'@gmail.com',
                'password'=>Hash::make('password'),
                'remember_token'=> Str::random(10),
            ],[])->assignRole($voterRole);
        }
    }
}
