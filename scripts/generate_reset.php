<?php
// One-off script to generate and print a password-reset URL for a user.
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;

$email = $argv[1] ?? 'retailer@aeps.com';
$userModel = App\Models\User::where('email', $email)->first();
if (! $userModel) {
    echo "User not found: {$email}\n";
    exit(1);
}

$token = Password::broker()->createToken($userModel);
$resetUrl = url(route('password.reset', ['token' => $token, 'email' => $userModel->email], false));

// Log and print
Log::info('Generated password reset URL for ' . $userModel->email . ': ' . $resetUrl);
echo "Reset URL for {$email}:\n" . $resetUrl . "\n";
