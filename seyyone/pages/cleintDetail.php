<?php
require '../class/php-excel.php';
include '../configs/conFactory.php';
if (isset($_POST["export_line"])) {
    $filename = 'Export_excel_' . $_POST['dateLine3'].'_'.$_POST['dateLine4'] . '.xls';
    $esql =  "SELECT
 a.syy_folder,
 a.syy_audioname,
 a.syy_mt,
 a.syy_eid,
 a.syy_ocid,
 b.syy_grade as mt_grade,
 b.syy_qc_grade as ed_grade ,
 a.syy_length,
 a.syy_lc 
FROM `syy_linecount` a , syy_task b  where
a.syy_audioname = b.syy_filename 
and a.syy_date between '" . $_POST['dateLine3'] . "' AND '" . $_POST['dateLine4'] . "'
and b.syy_grade is not null";
    
    $rec = $db->query($esql)->fetchAll();

     $data = array(
         1 => array ('Client Name', 'File Name','MT','ED','QC','MT Grade','ED Grade','Length','Line Count'),
     );

     // generate file (constructor parameters are optional)
     $xls = new Excel_XML('UTF-8', false, 'Client Line Count');
     $xls->addArray($data);
     $xls->addArray($rec);
     $xls->generateXML($filename);
}
?>