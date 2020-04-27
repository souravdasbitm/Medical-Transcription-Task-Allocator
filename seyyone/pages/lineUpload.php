<?php
require ('../class/excel_reader2.php');
require ('../class/SpreadsheetReader.php');
include '../configs/conFactory.php';


$query = "insert into `syy_linecount` (`syy_audioname`,`syy_length`,`syy_mt`,`syy_eid`,`syy_ocid`,`syy_client`,`syy_folder`,`syy_docname`,`syy_lc`,`syy_date`,`syy_split`,`syy_splitperminute`,`syy_lenthperminute`) VALUES ";


$file_name = $_FILES['linefile']['name'];
$file_tmp =$_FILES['linefile']['tmp_name'];

$temp = explode(".", $file_name);
$newfilename = date('dmYHis') . '_linecount.' . end($temp);
move_uploaded_file($file_tmp,"../uploaded_file/".$newfilename);
$tsk_file_name="../uploaded_file/".$newfilename;
try {
    $Spreadsheet = new SpreadsheetReader($tsk_file_name);
    $Spreadsheet->ChangeSheet(0);
    foreach ($Spreadsheet as $Key => $Row) {
        if ($Key != 1) {
          
            if ($Row[1]!=''){
                $selFileDate="select * from syy_linecount where syy_audioname='".$Row[1]."' and syy_date='".$Row[10]."'";
                $countRowFirst = $db->query($selFileDate)->numRows();
                if($countRowFirst>0){
                    $db->query("DELETE FROM `syy_linecount` where `syy_audioname`= '" . $Row[1] . "' and 'syy_date='".$Row[10]."'");
                    
                }
                    $query .= "(";
                    foreach (array_slice($Row, 1) as $val) {
                        
                        $ros=$db->escapeChar($val);
                        $query .= "'" . $ros . "',";
                        
                    }
                    $query = substr($query, 0, - 1);
                    $query .= "),";
                
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
//echo $insert->affectedRows();
header('Location:operation.php?msg1=success#tab_tab-primary-2');
//Zip the file and upload it using current date time



?>
