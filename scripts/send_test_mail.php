<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

$to = $argv[1] ?? 'manish@xpaylite.com';
try {
    Mail::raw('Test message from local AEPS app at ' . now(), function ($m) use ($to) {
        $m->to($to)->subject('AEPS test email');
    });
    echo "Mail send attempted to {$to} — check inbox/spam.\n";
} catch (\Throwable $ex) {
    echo "Mail send failed: " . $ex->getMessage() . "\n";
    Log::error('Test mail failed: ' . $ex->getMessage());
}
