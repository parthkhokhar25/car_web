<?php
    ob_start();
    session_start();
    unset($_SESSION['em']);
    unset($_SESSION['pwd']);
    header("location:login.php");
    session_destroy();
?>