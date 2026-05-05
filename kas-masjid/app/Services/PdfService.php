<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    private Dompdf $dompdf;

    public function __construct()
    {
        $options = new Options();
        $options->set([
            'enablePhp' => false,
            'enableJavascript' => false,
            'defaultPaperSize' => 'A4',
            'defaultPaperOrientation' => 'portrait',
            'dpi' => 96,
        ]);

        $this->dompdf = new Dompdf($options);
    }

    public function loadHtml(string $html): self
    {
        $this->dompdf->loadHtml($html);
        return $this;
    }

    public function setPaper(string $paper, string $orientation = 'portrait'): self
    {
        $this->dompdf->setPaper($paper, $orientation);
        return $this;
    }

    public function render(): self
    {
        $this->dompdf->render();
        return $this;
    }

    public function output(): string
    {
        return $this->dompdf->output();
    }

    public function download(string $filename): string
    {
        return $this->output();
    }

    public function getDompdf(): Dompdf
    {
        return $this->dompdf;
    }
}
