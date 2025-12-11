<?php
$projectRoot = dirname(__DIR__);
require $projectRoot . '/vendor/autoload.php';
$app = require_once $projectRoot . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Create or update admin user
$user = \App\Models\User::updateOrCreate(
    ['email' => 'admin@example.com'],
    [
        'name' => 'Admin',
        'password' => \Illuminate\Support\Facades\Hash::make('hanyaadminygtau')
    ]
);

echo "Admin user created/updated. ID: {$user->id}, Email: {$user->email}\n";
