<?php
    session_start();
    unset($_SESSION['surname']);
    session_destroy();

    header("location:index.php");
?>
