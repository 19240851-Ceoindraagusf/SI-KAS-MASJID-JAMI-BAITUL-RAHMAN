<?php

require_once __DIR__ . '/vendor/autoload.php';

try {
    // Test if Pdf class exists
    echo 'Testing Pdf class...' . PHP_EOL;
    $pdfClass = 'Barryvdh\DomPDF\Facade\Pdf';
    
    if (class_exists($pdfClass)) {
        echo 'Pdf class found!' . PHP_EOL;
    } else {
        echo 'Pdf class NOT found!' . PHP_EOL;
        
        // Try to check service provider
        echo 'Checking ServiceProvider...' . PHP_EOL;
        $providerClass = 'Barryvdh\DomPDF\ServiceProvider';
        if (class_exists($providerClass)) {
            echo 'ServiceProvider class found!' . PHP_EOL;
        } else {
            echo 'ServiceProvider class NOT found!' . PHP_EOL;
        }
    }
    
    // Test generating a simple PDF
    echo 'Testing PDF generation with simple HTML...' . PHP_EOL;
    $html = '<h1>Test PDF</h1><p>This is a test PDF.</p>';
    
    // Use Dompdf directly
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    echo 'PDF generated successfully!' . PHP_EOL;
    
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
    echo 'File: ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;
}
