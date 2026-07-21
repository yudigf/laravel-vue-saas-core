<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tenant;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache; // <-- Wajib di-import untuk fitur Redis

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Kita tidak lagi melakukan cache pada paginator karena sering memicu error unserialize (Incomplete Object)
        // di environment tertentu (terutama Redis). Pagination jauh lebih stabil jika di-query langsung.
        
        if (auth()->user()->role === 'super_admin') {
            $users = User::with('tenant')->paginate(10);
        } else {
            $tenantId = auth()->user()->tenant_id;
            $users = User::with('tenant')->where('tenant_id', $tenantId)->paginate(10);
        }

        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $tenants = [];
        if (auth()->user()->role === 'super_admin') {
            $tenants = Tenant::all();
        }

        return Inertia::render('Users/Create', [
            'tenants' => $tenants
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];

        // Jika super_admin, maka wajib milih role dan tenant_id
        if (auth()->user()->role === 'super_admin') {
            $rules['role'] = 'required|in:tenant_admin,tenant_staff';
            $rules['tenant_id'] = 'required|exists:tenants,id';
        }

        $validated = $request->validate($rules);

        $validated['password'] = Hash::make($validated['password']);

        // Jika bukan super_admin, otomatis set role sebagai tenant_staff 
        // (tenant_id akan otomatis diset oleh trait BelongsToTenant)
        if (auth()->user()->role !== 'super_admin') {
            $validated['role'] = 'tenant_staff';
        }

        User::create($validated);

        // Cache Invalidation sudah tidak diperlukan karena kita mengambil data secara langsung (real-time)

        return redirect()->route('users.index')->with('message', 'Pengguna berhasil ditambahkan!');
    }
}
