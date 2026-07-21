<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Super Admin (Tanpa Tenant)
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'tenant_id' => null,
        ]);

        // 2. Buat 1 Data Tenant Dummy
        $tenant = Tenant::create([
            'name' => 'Toko Bangunan Maju Jaya',
            'slug' => 'toko-bangunan-maju-jaya',
        ]);

        // 3. Buat Akun Tenant Admin (Terikat ke Tenant di atas)
        User::factory()->create([
            'name' => 'Admin Maju Jaya',
            'email' => 'admin@majujaya.com',
            'password' => Hash::make('password'),
            'role' => 'tenant_admin',
            'tenant_id' => $tenant->id,
        ]);
    }
}
