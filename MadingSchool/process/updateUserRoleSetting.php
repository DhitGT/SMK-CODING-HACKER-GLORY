<?php 
    session_start();
    include '../function.php';
    checkLogin("../login");
    $roleId = isset($_POST['roleId']) ? intval($_POST['roleId']) : 0;
    $roleRow = isset($_POST['roleRow']) ? $_POST['roleRow'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify CSRF token
    if (!empty($_POST['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {

        $sql = "UPDATE `role_settings` SET `$roleRow` = NOT `$roleRow` WHERE `role_settings`.`id` = '$roleId'";
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