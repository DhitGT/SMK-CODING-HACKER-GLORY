<?php
    include '../function.php';
    // midware {
    checkLogin("../login");
    $user_Roles = mysqli_fetch_assoc(getUserByEmail($_SESSION['login']))['role'];
    if(!getRoleIsChecked($user_Roles,"can_view_stats")){
        header('location:../index.php');
    }
    // midware }

    $sql = "SELECT view_date as date, CAST(SUM(views) AS SIGNED) AS data FROM user_views GROUP BY view_date";
    echo fetchAllData($sql);
?>