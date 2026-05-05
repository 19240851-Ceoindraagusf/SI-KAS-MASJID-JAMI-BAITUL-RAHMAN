<?php

return [

    /*
    |--------------------------------------------------------------------------
    | DomPDF Configuration
    |--------------------------------------------------------------------------
    |
    | Configure DomPDF options here
    |
    */

    'mode'                  => env('DOMPDF_MODE', 'utf-8'),
    'defines'               => [
        'DOMPDF_TEMP_DIR'       => storage_path('temp'),
        'DOMPDF_FONT_DIR'       => storage_path('fonts'),
        'DOMPDF_FONT_CACHE'     => storage_path('fonts'),
        'DOMPDF_UNICODE'        => true,
    ],
    'convert_entities'      => true,
    'options'               => [
        'commands'          => [
            'local'  => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf'), // For UNIX
            // 'local'  => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf'), // For Windows
        ],
        'ignoreWarnings'    => false,
        'enable_remote'     => false,
        'debugKeepTemp'     => env('APP_DEBUG', false),
        'debugPdfVersion'   => env('APP_DEBUG', false),
    ],

    /*
    |--------------------------------------------------------------------------
    | Font Configuration
    |--------------------------------------------------------------------------
    |
    | Add custom fonts here
    |
    */

    'public_path'           => null,

    /*
    |--------------------------------------------------------------------------
    | Orientation Configuration
    |--------------------------------------------------------------------------
    |
    | Configure default paper size and orientation
    |
    */

    'format'                => 'A4',
    'orientation'           => 'portrait',

];
