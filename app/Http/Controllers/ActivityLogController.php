<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Inertia\Inertia;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Ambil data activity log terbaru
        $logs = Activity::with('causer')->latest()->paginate(15);
        
        return Inertia::render('ActivityLog/Index', [
            'logs' => $logs
        ]);
    }
}
