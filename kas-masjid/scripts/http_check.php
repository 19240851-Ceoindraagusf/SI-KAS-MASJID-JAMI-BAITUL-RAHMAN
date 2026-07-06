<?php
$urls = [
    'http://127.0.0.1:8000/',
    'http://127.0.0.1:8000/kas_masuk',
    'http://127.0.0.1:8000/kas_keluar',
];

foreach ($urls as $url) {
    $opts = [
        'http' => [
            'method' => 'GET',
            'ignore_errors' => true,
            'timeout' => 5,
        ],
    ];
    $context = stream_context_create($opts);
    $body = @file_get_contents($url, false, $context);
    $headers = isset($http_response_header) ? $http_response_header : [];

    $status = $headers[0] ?? 'No response';
    $len = is_string($body) ? strlen($body) : 0;

    echo "URL: $url\n";
    echo "Status: $status\n";
    echo "Headers:\n";
    foreach (array_slice($headers, 0, 10) as $h) {
        echo "  $h\n";
    }
    echo "Body length: $len\n";
    echo str_repeat('-', 60) . "\n";
}
