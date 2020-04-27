<?php
include '../configs/conFactory.php';


$query = "insert into `syy_employee` 
(`syy_first_name`,`syy_phone`,`syy_assign_id`,`syy_given_role`,
`syy_o_birthday`,`syy_a_birthday`,`syy_username`,`syy_password`,
`syy_role`) VALUES ('".$_POST['name']."',
'".$_POST['phone']."',
'".$_POST['empid']."',
'".$_POST['role']."',
'".$_POST['bdate']."',
'".$_POST['abdate']."',
'".$_POST['empid']."',
'".$_POST['pass']."',
'4')";


$db->query($query);
header('Location:operation.php#tab_tab-primary-3');




?>