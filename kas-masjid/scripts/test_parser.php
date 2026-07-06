<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\MoneyParser;

$examples = [
    '70000.00',
    'Rp 70.000',
    '70.000',
    '70,000.00',
    '70.000,00',
    '1.234.567,89',
    '1,234,567.89',
];

foreach ($examples as $ex) {
    $parsed = MoneyParser::parse($ex);
    echo "Input: {$ex} => parsed: " . var_export($parsed, true) . "\n";
}
