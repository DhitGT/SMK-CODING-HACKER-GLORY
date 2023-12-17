<?php 
    session_start();
    include "../function.php";
    checkLogin("../login");
    

    $judul = $_POST['judul'];
    $isi = strval($_POST['isi']);
    $category = $_POST['category'];
    $tanggal = $_POST['tanggal'];
    $userId = isset($_SESSION['login']) ? mysqli_fetch_assoc(getUserByEmail($_SESSION['login']))['id'] : 0;
    $sql = "INSERT INTO posts VALUES('','$judul','$isi','$userId','$tanggal','','$category')";
    mysqli_query(conn(),$sql);
    
   

    header('location:/MadingSchool');

?>