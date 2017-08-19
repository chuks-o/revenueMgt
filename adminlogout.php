<?php
    session_start();
    unset($_SESSION['adminemail']);
    unset($_SESSION['adminsurname']);
    unset($_SESSION['adminfirstname']);

    session_destroy();

    header("location:adminlogin.php");
?>
