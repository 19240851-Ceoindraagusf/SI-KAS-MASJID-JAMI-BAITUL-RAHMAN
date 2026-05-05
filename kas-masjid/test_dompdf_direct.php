<?php

require_once __DIR__ . '/vendor/autoload.php';

try {
    echo 'Testing DomPDF class (direct)...' . PHP_EOL;
    $dompdf = new \Dompdf\Dompdf();
    
    $html = '<h1>Test PDF</h1><p>This is a test PDF from DomPDF directly.</p>';
    
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    
    echo 'PDF generated successfully!' . PHP_EOL;
    echo 'Output size: ' . strlen($dompdf->output()) . ' bytes' . PHP_EOL;
    
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
    echo 'File: ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;
}
?>
