<?php 
    session_start();
    include "../function.php";
    checkLogin("../login");
    
    $postId = $_POST['id'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $category = $_POST['category'];
    $tanggal = $_POST['tanggal'];
    $userId = getUserIdByEmail($_SESSION['login']);
    $sql = "UPDATE `posts` SET `judul` = '$judul', `isi` = '$isi', `deploy_date` = '$tanggal', `is_allowed` = '0', `category` = '$category' WHERE `posts`.`id` = '$postId'";
    mysqli_query(conn(),$sql);
    
   

    header('location:../index.php');

?>