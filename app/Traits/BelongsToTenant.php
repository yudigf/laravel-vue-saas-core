<?php

namespace App\Traits;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToTenant
{
    /**
     * Boot the trait. Di sini kita menanamkan keamanan otomatis.
     */
    public static function bootBelongsToTenant()
    {
        // 1. Global Scope: Mencegah user melihat data milik tenant lain saat query SELECT
        static::addGlobalScope('tenant_scope', function (Builder $builder) {
            // Gunakan hasUser() daripada check() untuk menghindari infinite loop saat query tabel User
            if (auth()->hasUser() && auth()->user()->role !== 'super_admin') {
                $builder->where($builder->getModel()->getTable() . '.tenant_id', auth()->user()->tenant_id);
            }
        });

        // 2. Hook Creating: Otomatis mengisi tenant_id saat menyimpan data baru (INSERT)
        static::creating(function (Model $model) {
            \Log::info("creating hook fired for " . get_class($model));
            \Log::info("auth()->check(): " . (auth()->check() ? 'true' : 'false'));
            if (auth()->check()) {
                \Log::info("User role: " . auth()->user()->role);
                \Log::info("User tenant_id: " . auth()->user()->tenant_id);
            }
            
            // Gunakan check() di sini karena aman dari infinite loop (hanya saat insert)
            if (auth()->check() && auth()->user()->role !== 'super_admin') {
                // Otomatis menempelkan tenant_id sesuai dengan perusahaan si user
                $model->tenant_id = auth()->user()->tenant_id;
                \Log::info("tenant_id set to: " . $model->tenant_id);
            }
        });
    }

    /**
     * Otomatis mendaftarkan relasi belongsTo ke Tenant
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
