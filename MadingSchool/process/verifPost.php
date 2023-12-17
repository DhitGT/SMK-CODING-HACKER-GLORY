<?php 
include '../function.php';
    checkLogin("../login");

    $id = $_POST['postId'];
    $selectedFilter = $_POST['selectedFilter'];
    $sql = "UPDATE `posts` SET `is_allowed` = '1' WHERE `posts`.`id` = '$id' ";
    if(mysqli_query(conn(),$sql)){
        header("location:../dashboard/index.php?filter=$selectedFilter#$id");
    }

?>