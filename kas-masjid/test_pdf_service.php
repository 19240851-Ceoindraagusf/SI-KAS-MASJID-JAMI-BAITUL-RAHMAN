<?php

require_once __DIR__ . '/vendor/autoload.php';

// Test PdfService
try {
    echo "========== Testing PdfService ==========\n";
    
    // Load the PdfService
    require_once __DIR__ . '/app/Services/PdfService.php';
    
    echo "Step 1: Creating PdfService instance...\n";
    $pdfService = new \App\Services\PdfService();
    echo "✓ PdfService instantiated!\n\n";
    
    echo "Step 2: Loading HTML and rendering...\n";
    $html = '<html><head><meta charset="UTF-8"></head><body>';
    $html .= '<h2>Laporan Uji Coba</h2>';
    $html .= '<p>Testing dengan PdfService class.</p>';
    $html .= '<p>Tanggal: ' . date('d/m/Y H:i:s') . '</p>';
    $html .= '</body></html>';
    
    $pdfService->loadHtml($html)
               ->setPaper('A4', 'portrait')
               ->render();
    echo "✓ HTML loaded and rendered!\n\n";
    
    echo "Step 3: Getting PDF output...\n";
    $output = $pdfService->output();
    echo "✓ PDF output received!\n";
    echo "   PDF size: " . strlen($output) . " bytes\n\n";
    
    echo "========== SUCCESS ==========\n";
    echo "PdfService is working correctly!\n";
    echo "Export PDF feature is ready to use.\n";
    
} catch (\Throwable $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n\n";
    echo "Stack Trace:\n";
    echo $e->getTraceAsString() . "\n";
    exit(1);
}

?>
