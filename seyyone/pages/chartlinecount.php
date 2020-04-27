<?php
header('Content-Type: application/json');
include '../configs/conFactory.php';





$sqlQuery = "SELECT syy_folder,sum(syy_lc) as lc FROM `syy_linecount`  GROUP BY syy_folder";

$row_rr = $db->query($sqlQuery)->fetchAll();
$data = array();
foreach ($row_rr as $dataarr) {

    $data[] = $dataarr;
}



echo json_encode($data);


?>