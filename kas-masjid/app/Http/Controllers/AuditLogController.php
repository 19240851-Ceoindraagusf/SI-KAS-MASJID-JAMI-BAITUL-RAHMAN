<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $action = $request->input('action');

        $logs = AuditLog::with('user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('description', 'like', "%{$search}%")
                        ->orWhereHas('user', fn ($q) => $q->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($action, fn ($query) => $query->where('action', $action))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $actions = AuditLog::select('action')->distinct()->orderBy('action')->pluck('action');

        return view('audit_logs.index', compact('logs', 'actions', 'search', 'action'));
    }
}
