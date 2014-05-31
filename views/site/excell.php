<?php
/** Error reporting */
error_reporting(E_ALL);

/** Include path **/
ini_set('include_path', ini_get('include_path').';../Classes/');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Alejandro Núñez Domínguez");
$objPHPExcel->getProperties()->setLastModifiedBy("Alejandro Núñez Domínguez");
$objPHPExcel->getProperties()->setTitle("Test");
$objPHPExcel->getProperties()->setSubject("pruebas con phpEXCELL");
$objPHPExcel->getProperties()->setDescription("Generado usando clases php.");

// Add some data
echo date('H:i:s') . " Añadir algunos datos.\n";
$objPHPExcel->setActiveSheetIndex(0);
 //Se recorre la consulta y se van introduciendo los datos en una cadena html.
for ($i=0; $i < count($pers_dep) ; $i++) { 
   $nombre_personal = $pers_dep[$i]['nombre_personal'];
   $nombre_dep = $pers_dep[$i]['nombre_dep'];
   $objPHPExcel->getActiveSheet()->SetCellValue('A'.($i + 1), $nombre_personal);
   $objPHPExcel->getActiveSheet()->SetCellValue('B'.($i + 1), $nombre_dep);
}


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');

		
// Save Excel 2007 file
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
