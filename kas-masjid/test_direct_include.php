<?php

// Include Dompdf directly without autoloader
require_once __DIR__ . '/vendor/dompdf/dompdf/src/Dompdf.php';

try {
    echo 'Testing DomPDF with direct include...' . PHP_EOL;
    $dompdf = new \Dompdf\Dompdf();
    
    $html = '<h1>Test PDF</h1><p>This is a test PDF with direct include.</p>';
    
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    echo 'PDF generated successfully!' . PHP_EOL;
    echo 'Output size: ' . strlen($dompdf->output()) . ' bytes' . PHP_EOL;
    
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
    echo 'File: ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;
    echo 'Trace:' . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
}
?>
