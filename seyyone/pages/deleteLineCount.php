<?php
include '../configs/conFactory.php';
if ($_POST['resetlc']!=''){
    
    
    $deleteLc=$db->query("delete from  syy_linecount where str_to_date(syy_date, '%m/%d/%Y')
            between str_to_date('".$_POST['resetlc']."', '%m/%d/%Y')
            and str_to_date('".$_POST['resetlc1']."', '%m/%d/%Y')");

     
    if ($deleteLc->affectedRows()>0){
        $msg="Sucessfully deleted the records of dates between from ".$_POST['resetlc']." to " .$_POST['resetlc1'];
    }else{
        $msg="No records found of dates between from ".$_POST['resetlc']." to " .$_POST['resetlc1'];
    }
    header('Location:operation.php?msg='.$msg.'#tab_tab-primary-6');
}

?>