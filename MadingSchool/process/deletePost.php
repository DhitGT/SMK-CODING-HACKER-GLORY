<?php 
    session_start();
    include '../function.php';
    // midware {
    checkLogin("../login");
    $user_Roles = mysqli_fetch_assoc(getUserByEmail($_SESSION['login']))['role'];
    if(!getRoleIsChecked($user_Roles,"can_delete_posts")){
        header('location:../index.php');
    }
    // midware }

    $postId = isset($_POST['postId']) ? intval($_POST['postId']) : 0;
    $userId = getUserIdByEmail($_SESSION['login']);
    $userRole = getRoleByEmail($_SESSION['login']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        if($userRole != 'admin'){
            $sql = "DELETE FROM posts WHERE `posts`.`id` = '$postId' AND `posts`.`user_id` = '$userId'";
        }else{
            $sql = "DELETE FROM posts WHERE `posts`.`id` = '$postId' ";
        }
        $result = mysqli_query(conn(),$sql);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Role changed successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error changing role']);
        }
    } else {
        // Handle other HTTP methods if necessary
        http_response_code(405); // Method Not Allowed
        echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    }
}
?>