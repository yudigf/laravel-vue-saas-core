<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;

class TenantIsolationTest extends TestCase
{
    // Fungsi ini akan me-reset database di setiap sesi ujian agar selalu bersih
    use RefreshDatabase;

    /**
     * TEST 1: Tenant Isolation (Membuktikan Isolasi Data)
     */
    public function test_tenant_admin_hanya_bisa_melihat_user_dari_tokonya_sendiri(): void
    {
        // 1. PERSIAPAN DATA (Membangun 2 dunia yang terpisah)
        $tenantA = Tenant::create(['name' => 'Toko A', 'slug' => 'toko-a']);
        $tenantB = Tenant::create(['name' => 'Toko B', 'slug' => 'toko-b']);

        // Masukkan 1 User ke Toko A, dan 1 User ke Toko B
        $userA = User::factory()->create(['tenant_id' => $tenantA->id, 'role' => 'tenant_admin']);
        $userB = User::factory()->create(['tenant_id' => $tenantB->id, 'role' => 'tenant_admin']);

        // 2. AKSI (Simulasi Login sebagai orang dari Toko A)
        $this->actingAs($userA);

        // Coba kunjungi halaman Manajemen User
        $response = $this->get('/users');

        // 3. PEMBUKTIAN (Verifikasi)
        $response->assertStatus(200);

        // Pastikan robot mendeteksi bahwa tabel HANYA menampilkan 1 orang (yaitu User A),
        // dan User B sama sekali tidak ikut terbaca/bocor!
        $response->assertInertia(
            fn(Assert $page) => $page
                ->component('Users/Index')
                ->has('users.data', 1) // Hanya boleh ada 1 baris data di tabel
                ->where('users.data.0.id', $userA->id) // Baris data itu harus User A
        );
    }

    /**
     * TEST 2: RBAC Security (Membuktikan Keamanan Role Middleware)
     */
    public function test_tenant_staff_tidak_bisa_mengakses_halaman_super_admin(): void
    {
        // 1. Buat User biasa dengan kasta terendah (Staff)
        $staff = User::factory()->create(['role' => 'tenant_staff']);

        // 2. Login sebagai staff tersebut
        $this->actingAs($staff);

        // 3. Secara nakal mencoba memaksa masuk ke rute khusus Super Admin (/admin)
        $response = $this->get('/admin');

        // 4. Buktikan bahwa middleware CheckRole kita sukses MENENDANG user tersebut (Error 403 Forbidden)
        $response->assertStatus(403);
    }
}
