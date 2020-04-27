<?php
include '../configs/conFactory.php';
session_start();

$bld_qry='SELECT * FROM syy_employee where syy_username=\''.$_POST['username'].'\' and syy_password=\''.$_POST['password'].'\'';
$role_qry='select syy_role from syy_roles where syy_role_id like 
(SELECT syy_role FROM syy_employee where syy_username=\''.$_POST['username'].'\' and syy_password=\''.$_POST['password'].'\')';
$nrow=$db->query($bld_qry)->numRows();
$empdt=$db->query($bld_qry)->fetchAll();
$sess_role=$db->query($role_qry)->fetchAll();
$sess_name=$db->query($bld_qry)->fetchAll();

if($nrow<1){
    session_destroy();
    header('Location: login.php?auth=failed');  
    exit;
}else {
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['name'] = $_POST['username'];
    $_SESSION['role'] = $sess_role[0]['syy_role'];
    $_SESSION['actualname'] = $sess_name[0]['syy_first_name'];
    $_SESSION['id']=$empdt[0][syy_assign_id];
    header('Location: home.php');
}

$db->close();

?>