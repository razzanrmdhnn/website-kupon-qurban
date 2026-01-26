<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$kupon = App\Models\Kupon::first();

if ($kupon) {
    echo "Kupon ID: " . $kupon->id . PHP_EOL;
    echo "Kode Unik: " . $kupon->kode_unik . PHP_EOL;
    echo "QR Code Length: " . strlen($kupon->qr_code) . PHP_EOL;
    echo "QR Code First 300 chars:" . PHP_EOL;
    echo substr($kupon->qr_code, 0, 300) . PHP_EOL;
} else {
    echo "No kupon found" . PHP_EOL;
}
