<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('admin:backfill-requests {--pending=* : User IDs or emails to mark as requested} {--dry-run}', function () {
    $dryRun = (bool) $this->option('dry-run');
    $now = now();

    $adminUpdates = 0;
    $adminUsers = User::query()
        ->where('is_admin', true)
        ->where(function ($query) {
            $query->whereNull('admin_requested_at')->orWhereNull('admin_approved_at');
        })
        ->get();

    foreach ($adminUsers as $admin) {
        $payload = [
            'admin_requested_at' => $admin->admin_requested_at ?? ($admin->created_at ?? $now),
            'admin_approved_at' => $admin->admin_approved_at ?? ($admin->created_at ?? $now),
        ];

        if (! $dryRun) {
            $admin->forceFill($payload)->save();
        }

        $adminUpdates++;
    }

    $pendingUpdates = 0;
    $pendingIdentifiers = collect($this->option('pending'))->filter();

    foreach ($pendingIdentifiers as $identifier) {
        $pendingUser = is_numeric($identifier)
            ? User::find((int) $identifier)
            : User::where('email', $identifier)->first();

        if (! $pendingUser) {
            $this->warn("User {$identifier} not found.");
            continue;
        }

        $timestamp = $pendingUser->created_at ?? $now;

        if (! $dryRun) {
            $pendingUser->forceFill([
                'admin_requested_at' => $pendingUser->admin_requested_at ?? $timestamp,
            ])->save();
        }

        $pendingUpdates++;
    }

    $this->info("Backfill summary: {$adminUpdates} admin account(s) updated, {$pendingUpdates} pending applicant(s) marked." . ($dryRun ? ' (dry run)' : ''));
})->purpose('Backfill admin request metadata for legacy accounts and applicants.');
