<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; // <-- Wajib di-import untuk fitur Redis

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Kita mengambil nomor halaman (page) untuk membuat kunci cache yang dinamis
        $page = $request->get('page', 1);
        $cacheKey = 'users_list_page_' . $page;

        // Logika Redis Caching:
        if (auth()->user()->role === 'super_admin') {
            // Super admin menggunakan cache standar (60 menit)
            $users = Cache::remember($cacheKey . '_superadmin', 60 * 60, function () {
                return User::with('tenant')->paginate(10);
            });
        } else {
            // Tenant menggunakan "Cache Tags" yang eksklusif (Hanya didukung oleh Redis)
            $tenantId = auth()->user()->tenant_id;

            $users = Cache::tags(['tenant_' . $tenantId])->remember($cacheKey, 60 * 60, function () {
                return User::with('tenant')->paginate(10);
            });
        }

        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }
}
