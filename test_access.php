<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$u = App\Models\User::where('role', 'admin_bps')->first();
$panel = Filament\Facades\Filament::getPanel('dinas');
echo json_encode([
    'user' => $u->email,
    'canAccess' => $u->canAccessPanel($panel),
    'tenants' => count($u->getTenants($panel))
]);
