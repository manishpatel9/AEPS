<?php
// Backfill missing ticket_id values for support_tickets
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

echo "Starting backfill of support_tickets.ticket_id...\n";
$rows = DB::table('support_tickets')->whereNull('ticket_id')->get();
$count = 0;
foreach ($rows as $r) {
    do {
        $ticket = 'TKT' . strtoupper(Str::random(8));
    } while (DB::table('support_tickets')->where('ticket_id', $ticket)->exists());

    DB::table('support_tickets')->where('id', $r->id)->update(['ticket_id' => $ticket]);
    $count++;
}

echo "Backfilled $count tickets.\n";
