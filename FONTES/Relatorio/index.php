<?php

require_once __DIR__ . '/../vendor/autoload.php';

ob_start();
include_once __DIR__ . '/src/view/ViewPDO-Obj.php';
$html = ob_get_clean();

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHtml($html);
$mpdf->SetFooter('{DATE j/m/y H:i}||Pagina {PAGENO}/{nb}');
$mpdf->Output();
