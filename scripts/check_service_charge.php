<?php
// scripts/check_service_charge.php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\ServiceCharge;

$action = $argv[1] ?? 'show';
$service = $argv[2] ?? 'cash_withdrawal';

if ($action === 'show') {
    $c = ServiceCharge::where('service_type', $service)->first();
    echo json_encode($c ? $c->toArray() : ['not_found' => true]);
    exit(0);
}

if ($action === 'update') {
    $payload = [
        'commission_type' => 'percent',
        'business_partner' => 5.0,
        'master_distributor' => 3.0,
        'distributor' => 2.0,
        'agent' => 1.0,
        'amount' => 0,
        'percentage' => 5.0,
        'min_amount' => 0,
        'max_amount' => 0,
        'status' => 'active',
    ];

    $c = ServiceCharge::updateOrCreate(['service_type' => $service], array_merge(['service_type' => $service], $payload));
    echo json_encode($c->toArray());
    exit(0);
}

echo json_encode(['error' => 'unknown action']);
