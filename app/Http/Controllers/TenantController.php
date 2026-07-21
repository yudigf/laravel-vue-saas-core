<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class TenantController extends Controller
{
    public function index()
    {
        // Ambil data tenant beserta jumlah user yang terdaftar
        $tenants = Tenant::withCount('users')->latest()->paginate(10);
        
        return Inertia::render('Tenants/Index', [
            'tenants' => $tenants
        ]);
    }

    public function create()
    {
        return Inertia::render('Tenants/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tenants,name',
        ]);

        // Otomatis membuat slug dari nama
        $validated['slug'] = Str::slug($validated['name']);

        Tenant::create($validated);

        return redirect()->route('admin.tenants.index')
            ->with('message', 'Toko baru berhasil ditambahkan!');
    }
}
