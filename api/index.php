<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

foreach ([
    '/tmp/storage',
    '/tmp/storage/framework',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
] as $path) {
    if (! is_dir($path)) {
        @mkdir($path, 0777, true);
    }
}

try {
    require __DIR__ . '/../public/index.php';
} catch (Throwable $e) {
    file_put_contents('php://stderr', "\n=== LARAVEL FATAL ERROR ===\n");
    file_put_contents('php://stderr', $e->getMessage() . "\n");
    file_put_contents('php://stderr', $e->getFile() . ':' . $e->getLine() . "\n");
    file_put_contents('php://stderr', $e->getTraceAsString() . "\n");

    http_response_code(500);

    echo '<pre>';
    echo htmlspecialchars($e->getMessage()) . "\n\n";
    echo htmlspecialchars($e->getFile() . ':' . $e->getLine()) . "\n\n";
    echo htmlspecialchars($e->getTraceAsString());
    echo '</pre>';

    exit;
}