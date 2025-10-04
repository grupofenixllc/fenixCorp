<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un tenant de ejemplo
        $tenantId = DB::table('tenants')->insertGetId([
            'name'   => 'FenixCorp Demo',
            'domain' => 'demo.fenixcorp.com.ar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Roles básicos
        $roles = ['SuperAdmin', 'Admin', 'Secretaria', 'Vendedor', 'Cajero', 'Supervisor', 'Auditor'];
        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'tenant_id'  => $tenantId,
                'name'       => $role,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Usuario administrador
        $userId = DB::table('users')->insertGetId([
            'tenant_id' => $tenantId,
            'name'      => 'Super Administrador',
            'email'     => 'admin@demo.fenixcorp.com.ar',
            'password'  => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Asignar rol SuperAdmin
        $roleId = DB::table('roles')->where('name', 'SuperAdmin')->first()->id;
        DB::table('role_user')->insert([
            'role_id'    => $roleId,
            'user_id'    => $userId,
            'tenant_id'  => $tenantId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}