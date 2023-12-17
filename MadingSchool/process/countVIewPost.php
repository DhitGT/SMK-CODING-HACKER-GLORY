<?php 
    include '../function.php';
    $postId = isset($_GET['id'])?$_GET['id']:'';


    if($postId != ''){
        $sqlGet = "SELECT * FROM posts_interaction WHERE id_post = '$postId'";
        $postData = mysqli_fetch_assoc(mysqli_query(conn(),$sqlGet));
        $newViews = $postData['views_total'] + 1;

        $sqlUpdate = "UPDATE `posts_interaction` SET `views_total` = '$newViews' WHERE `posts_interaction`.`id_post` = '$postId'";

        mysqli_query(conn(),$sqlUpdate);

    }
?>