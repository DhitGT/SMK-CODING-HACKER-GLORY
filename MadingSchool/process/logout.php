<?php 
    session_start();
    require '../function.php';

    checkLogin('../login.php');

    $_SESSION['login'] = '';
    session_unset();
    session_destroy();
    header('location:../login/');


?>