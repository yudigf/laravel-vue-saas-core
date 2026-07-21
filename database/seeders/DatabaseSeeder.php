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

        // 4. Buat Data Mandor Dummy
        $contractor1 = \App\Models\Contractor::create([
            'tenant_id' => $tenant->id,
            'name' => 'Pak Joko (Mandor Proyek A)',
            'phone' => '081234567890'
        ]);

        $contractor2 = \App\Models\Contractor::create([
            'tenant_id' => $tenant->id,
            'name' => 'Pak Budi (Tukang Harian)',
            'phone' => '089876543210'
        ]);

        // 5. Buat Data Kasbon Dummy
        \App\Models\Debt::create([
            'tenant_id' => $tenant->id,
            'contractor_id' => $contractor1->id,
            'amount' => 5000000,
            'due_date' => now()->addDays(7),
            'status' => 'unpaid',
            'description' => 'Pinjaman untuk beli Semen 50 Sak dan Pasir 2 Kol Bak.'
        ]);

        \App\Models\Debt::create([
            'tenant_id' => $tenant->id,
            'contractor_id' => $contractor1->id,
            'amount' => 1500000,
            'due_date' => now()->addDays(14),
            'status' => 'partial',
            'description' => 'Pinjaman untuk bayar gaji tukang mingguan.'
        ]);

        \App\Models\Debt::create([
            'tenant_id' => $tenant->id,
            'contractor_id' => $contractor2->id,
            'amount' => 300000,
            'due_date' => now()->addDays(3),
            'status' => 'unpaid',
            'description' => 'Kasbon rokok dan makan siang.'
        ]);
    }
}
