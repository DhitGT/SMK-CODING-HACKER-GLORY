<?php
    include '../function.php';
    // midware {
    checkLogin("../login");
    $user_Roles = mysqli_fetch_assoc(getUserByEmail($_SESSION['login']))['role'];
    if(!getRoleIsChecked($user_Roles,"can_view_stats")){
        header('location:../index.php');
    }
    // midware }

    $sql = "SELECT YEAR(view_date) AS date, CAST(SUM(views) AS SIGNED) AS data FROM user_views GROUP BY YEAR(view_date)";
    echo fetchAllData($sql);
?>