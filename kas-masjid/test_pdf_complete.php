<?php

require_once __DIR__ . '/vendor/autoload.php';

// Test if we can instantiate Dompdf
try {
    echo "========== DomPDF Test ==========\n";
    echo "Step 1: Checking if Dompdf class can be loaded...\n";
    
    $dompdf = new \Dompdf\Dompdf();
    echo "✓ Dompdf class instantiated successfully!\n\n";
    
    echo "Step 2: Loading HTML content...\n";
    $html = '<html><head><meta charset="UTF-8"></head><body>';
    $html .= '<h1>Test Laporan PDF</h1>';
    $html .= '<p>Ini adalah test PDF yang dibuat dengan Dompdf.</p>';
    $html .= '<table border="1">';
    $html .= '<tr><th>No</th><th>Item</th><th>Harga</th></tr>';
    $html .= '<tr><td>1</td><td>Item 1</td><td>Rp 100.000</td></tr>';
    $html .= '<tr><td>2</td><td>Item 2</td><td>Rp 200.000</td></tr>';
    $html .= '</table>';
    $html .= '</body></html>';
    
    $dompdf->loadHtml($html);
    echo "✓ HTML loaded successfully!\n\n";
    
    echo "Step 3: Setting paper size...\n";
    $dompdf->setPaper('A4', 'portrait');
    echo "✓ Paper size set!\n\n";
    
    echo "Step 4: Rendering PDF...\n";
    $dompdf->render();
    echo "✓ PDF rendered successfully!\n\n";
    
    echo "Step 5: Getting PDF output...\n";
    $pdfOutput = $dompdf->output();
    echo "✓ PDF output obtained!\n";
    echo "   PDF size: " . strlen($pdfOutput) . " bytes\n\n";
    
    echo "========== SUCCESS ==========\n";
    echo "PDF generation test completed successfully!\n";
    echo "The PDF export feature should now work in the application.\n";
    
} catch (\Throwable $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n\n";
    echo "Stack Trace:\n";
    echo $e->getTraceAsString() . "\n";
    exit(1);
}

?>
