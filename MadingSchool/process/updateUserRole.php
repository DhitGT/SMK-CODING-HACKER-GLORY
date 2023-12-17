<?php 
    session_start();
    include '../function.php';
    checkLogin("../login");
    $userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;
    $newRole = isset($_POST['newRole']) ? $_POST['newRole'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {

        $sql = "UPDATE `users` SET `role` = '$newRole' WHERE `users`.`id` = '$userId'";
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