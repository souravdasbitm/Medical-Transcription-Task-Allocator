<?php
require ('../class/excel_reader2.php');
require ('../class/SpreadsheetReader.php');
include '../configs/conFactory.php';

$query = "insert into `syy_task` (`syy_filename`,`syy_length`,`syy_curr_mt`,`syy_curr_ed`,`syy_curr_oc`,`syy_client`,`syy_folder`,`syy_n`,`syy_st`,`syy_min`,`syy_report_type`,`syy_split_order`,`syy_prev_mt`,`syy_prev_ed`,`syy_prev_oc`,`syy_upload_date`) VALUES ";


$file_name = $_FILES['taskfile']['name'];
$file_tmp = $_FILES['taskfile']['tmp_name'];

$temp = explode(".", $file_name);
$newfilename = date('dmYHis') . '_allotment.' . end($temp);
move_uploaded_file($file_tmp, "../uploaded_file/" . $newfilename);
$tsk_file_name = "../uploaded_file/" . $newfilename;
try {
    $Spreadsheet = new SpreadsheetReader($tsk_file_name);
    $Spreadsheet->ChangeSheet(0);
    foreach ($Spreadsheet as $Key => $Row) {
        if ($Key != 1) {
            
            if ($Row[1] != '') {
                
                $updateFileQ = "select * from `syy_task` where `syy_filename`= '" . $Row[1] . "' and syy_upload_date='" . $Row[16] . "'";
                //$updateP=$db->query($updateFileQ)->fetchAll();
                $updateP=$db->query($updateFileQ)->fetchArray();
				
                if($Row[3]!=$updateP['syy_curr_mt'] && $updateP['syy_status']==''){
                    $db->query("update syy_task set syy_curr_mt='".$Row[3]."' where syy_filename='".$Row[1]."'");
                }
                elseif($Row[4]!=$updateP['syy_curr_ed'] && $updateP['syy_status']==''){
                    $db->query("update syy_task set syy_curr_ed='".$Row[4]."' where syy_filename='".$Row[1]."'");
                }elseif($Row[5]!=$updateP['syy_curr_oc'] && $updateP['syy_status']==''){
                    $db->query("update syy_task set syy_curr_oc='".$Row[5]."' where syy_filename='".$Row[1]."'");
                }  
                $db->query("DELETE FROM `syy_task` where `syy_filename`= '" . $Row[1] . "' and syy_upload_date='" . $Row[16] . "' and syy_status is null");
                
				if($updateP['syy_status']==''){
				    $query .= "(";
                    foreach (array_slice($Row, 1) as $val) {
                        $ros = $db->escapeChar($val);
                        $query .= "'" . $ros . "',";
                    }
                    $query = substr($query, 0, - 1);
                    $query .= "),";
				}

               


            }
        }
    }
} catch (Exception $E) {
    echo $E->getMessage();
}

$query = substr($query, 0, - 1);
//echo $query;
//exit;
$insert = $db->query($query);
// echo $insert->affectedRows();
header('Location:operation.php?msg=success#tab_tab-primary-1');
// Zip the file and upload it using current date time

?>