<?php
//Cabecera especificando el tipo de transmisión (JSON)
	header('Content-type: application/json charset=utf-8');
	header('Access-Control-Allow-Origin: *');
    use mPDF;

    $html = $_POST['html'];
    $mpdf = new mPDF;
    $mpdf->WriteHTML($html);
    $mpdf->Output();
    exit;
    
        
?>