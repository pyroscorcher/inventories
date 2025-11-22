<?php

use Dompdf\Dompdf;

function load_pdf($html, $filename = 'laporan.pdf')
{
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream($filename, ["Attachment" => true]);
}
