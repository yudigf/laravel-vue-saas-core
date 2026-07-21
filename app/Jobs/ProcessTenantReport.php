<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log; // <-- Jangan lupa import Log

class ProcessTenantReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tenantId;

    /**
     * Create a new job instance.
     */
    public function __construct($tenantId)
    {
        $this->tenantId = $tenantId;
    }

    /**
     * Execute the job.
     * Segala kode di dalam blok ini akan dieksekusi oleh pekerja (worker) di belakang layar
     */
    public function handle(): void
    {
        // Simulasi proses berat (misalnya sedang melakukan Generate PDF ribuan halaman)
        sleep(3);

        // Catat ke dalam file log Laravel (storage/logs/laravel.log)
        Log::info("✅ Laporan BERHASIL diproses secara background (Redis Queue) untuk Tenant ID: {$this->tenantId}");
    }
}
