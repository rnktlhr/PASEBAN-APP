<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = Illuminate\Http\Request::create('/dinas/login', 'POST', [
    'data' => [
        'email' => 'admin@bps.go.id',
        'password' => 'password',
        'remember' => false,
    ]
]);
// Filament login is Livewire, so we can't easily fake it this way.
// Let's just try to call auth attempt
$attempt = auth()->attempt(['email' => 'admin@bps.go.id', 'password' => 'password']);
echo "Attempt: " . ($attempt ? 'success' : 'failed') . "\n";

$u = auth()->user();
if ($u) {
    echo "User: " . $u->email . "\n";
    $panel = Filament\Facades\Filament::getPanel('dinas');
    echo "Can access panel: " . ($u->canAccessPanel($panel) ? 'yes' : 'no') . "\n";
}
