<?php
include '../configs/conFactory.php';



$accounts = $db->query('SELECT * FROM syy_roles')->fetchAll();

foreach ($accounts as $account) {
    echo $account['syy_role'] . '<br>';
}

$db->close();
?>