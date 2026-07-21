<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Debt;
use Inertia\Inertia;

class DebtController extends Controller
{
    public function index()
    {
        // Berkat Global Scope, query ini otomatis hanya mengambil kasbon dari toko/tenant yang sedang login!
        $debts = Debt::with('contractor')->paginate(10);

        return Inertia::render('Debts/Index', [
            'debts' => $debts
        ]);
    }

    public function create()
    {
        // Ambil semua mandor (Otomatis terisolasi per tenant berkat BelongsToTenant)
        $contractors = \App\Models\Contractor::all();

        return Inertia::render('Debts/Create', [
            'contractors' => $contractors
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contractor_id' => 'required|exists:contractors,id',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'description' => 'required|string',
        ]);

        // Untuk memastikan konsistensi, ambil tenant_id dari mandor yang dipilih.
        // Ini sangat berguna jika yang login adalah super_admin, sehingga tenant_id tidak kosong.
        $contractor = \App\Models\Contractor::findOrFail($validated['contractor_id']);
        $validated['tenant_id'] = $contractor->tenant_id;

        // Menyimpan data kasbon. (tenant_id otomatis diset dari contractor!)
        Debt::create($validated);

        return redirect()->route('debts.index')->with('message', 'Kasbon berhasil dicatat!');
    }
}
