<?php 
session_start();
include '../function.php';
checkLogin("../login");
    $postId = $_POST['id'];
    $userId = isset($_SESSION['login']) ? mysqli_fetch_assoc(getUserByEmail($_SESSION['login']))['id'] : 0;
    $postInteracData = getPostsInteracByPostId($postId);
    $likeUpdate;
    
    
    if(!checkIsLiked($userId, $postId)){
        $sqlUserFav = "INSERT INTO users_fav VALUES ('','$userId','$postId')";
        mysqli_query(conn(),$sqlUserFav);
        $like_image = checkIsLiked($userId, $postId) ? '/MadingSchool/resource/icon/heart-fill.svg' : '/MadingSchool/resource/icon/heart-line.svg';
        $likeUpdate = $postInteracData['likes_total']+1;
        
        header('Content-Type: application/json');
        echo json_encode([
            'likes_total' => $likeUpdate,
            'like_image' => $like_image
        ]);
    }else{
        $like_image = !checkIsLiked($userId, $postId) ? '/MadingSchool/resource/icon/heart-fill.svg' : '/MadingSchool/resource/icon/heart-line.svg';
        $likeUpdate = $postInteracData['likes_total']-1;
        $deleteUserFav = "DELETE FROM `users_fav` WHERE `users_fav`.`id_liked_post` = '$postId' AND `users_fav`.`id_user` = '$userId' ";
        mysqli_query(conn(),$deleteUserFav);
        header('Content-Type: application/json');
        echo json_encode([
            'likes_total' => $likeUpdate,
            'like_image' => $like_image
        ]);
    }
    $sqlInteraction = "UPDATE `posts_interaction` SET `likes_total` = '$likeUpdate' WHERE id_post = '$postId'";
    mysqli_query(conn(),$sqlInteraction);
    

?>