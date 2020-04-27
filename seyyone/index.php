<?php

session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    session_destroy();
    header('Location: pages/login.php');
    exit();
}
else {
    header('Location:  pages/home.php');
}

?>