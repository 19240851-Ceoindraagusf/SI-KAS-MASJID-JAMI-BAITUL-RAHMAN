<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserApprovalController extends Controller
{
    /**
     * Display list of pending user approvals.
     */
    public function index(): View
    {
        $pendingUsers = User::where('status', 'pending')
            ->where('role', 'bendahara')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.user-approvals.index', compact('pendingUsers'));
    }

    /**
     * Show details of a pending user for approval.
     */
    public function show(User $user): View
    {
        if ($user->status !== 'pending') {
            abort(404);
        }

        return view('admin.user-approvals.show', compact('user'));
    }

    /**
     * Approve a pending user.
     */
    public function approve(User $user): RedirectResponse
    {
        if ($user->status !== 'pending') {
            return redirect()->route('admin.user-approvals.index')
                ->with('error', 'User ini sudah diproses sebelumnya.');
        }

        $user->approve(auth()->id());

        // Log audit
        \App\Services\AuditLogger::record(
            action: 'user_approved',
            description: "Admin menyetujui pendaftaran bendahara: {$user->name}",
            auditable: $user,
            oldValues: ['status' => 'pending'],
            newValues: ['status' => 'approved']
        );

        return redirect()->route('admin.user-approvals.index')
            ->with('success', "User {$user->name} telah disetujui.");
    }

    /**
     * Reject a pending user.
     */
    public function reject(User $user): RedirectResponse
    {
        if ($user->status !== 'pending') {
            return redirect()->route('admin.user-approvals.index')
                ->with('error', 'User ini sudah diproses sebelumnya.');
        }

        $userName = $user->name;
        $userEmail = $user->email;

        $user->reject();

        // Log audit
        \App\Services\AuditLogger::record(
            action: 'user_rejected',
            description: "Admin menolak pendaftaran bendahara: {$userName} ({$userEmail})",
            auditable: null
        );

        return redirect()->route('admin.user-approvals.index')
            ->with('success', "Pendaftaran user {$userName} telah ditolak dan dihapus.");
    }
}
