<?php
require '../class/php-excel.php';
include '../configs/conFactory.php';
if (isset($_POST["export_line"])) {
    $filename = 'Export_excel_' . $_POST['dateLine1'].'_'.$_POST['dateLine2'] . '.xls';
    $esql = "SELECT syy_folder,sum(syy_lc) as len FROM `syy_linecount` where syy_date between '" . $_POST['dateLine1'] . "' AND '" . $_POST['dateLine2'] . "' GROUP BY syy_folder order by syy_folder asc";
    $rec = $db->query($esql)->fetchAll();

    $data = array(
        1 => array ('Client Name', 'Count Line'),
    );

    // generate file (constructor parameters are optional)
    $xls = new Excel_XML('UTF-8', false, 'Client Line Count');
    $xls->addArray($data);
    $xls->addArray($rec);
    $xls->generateXML($filename);
}
?>