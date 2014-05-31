<?php
//Cabecera especificando el tipo de transmisión (JSON)
	header('Content-type: application/json charset=utf-8');
	header('Access-Control-Allow-Origin: *');
    include('vendor/mpdf/mpdf/mpdf.php');

//Se obtienen por post las etiquetas img para pasarlas a pdf.
    $html = $_POST['html'];
    $mpdf = new mPDF;
    $mpdf->WriteHTML($html);
    $mpdf->Output("fichero.pdf");
    echo $html;
        
?>