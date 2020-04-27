<?php
include '../configs/conFactory.php';
if ($_POST['resetdate']!=''){
    
    $resetRecords=$db->query("delete from  syy_task where `syy_upload_date`='".$_POST['resetdate']."'");
     
    if ($resetRecords->affectedRows()>0){
        $msg="Sucessfully deleted the records of date ".$_POST['resetdate'];
    }else{
        $msg="No records found of date ".$_POST['resetdate'];
    }
    header('Location:operation.php?msg='.$msg.'#tab_tab-primary-4');
}

if ($_POST['deleteFile']!=''){
    
    $resetRecords=$db->query("delete from  syy_task where `syy_filename`='".$_POST['deleteFile']."'");
    
    if ($resetRecords->affectedRows()>0){
        $msg="Sucessfully deleted the records of file ".$_POST['deleteFile'];
    }else{
        $msg="No records found of file ".$_POST['deleteFile'];
    }
    header('Location:operation.php?msg='.$msg.'#tab_tab-primary-5');
}
?>