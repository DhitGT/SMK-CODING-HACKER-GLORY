<?php
function conn(){
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_madingschool";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
return $conn;


}

//register
function createUser($name,$email,$password){
    $hashPw = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO users VALUES('','$name','$email','$hashPw','siswa','')";
    if(mysqli_query(conn(),$sql)){ 
        return true;
    }else{ 
        return false;
    };
}

function checkLogin($location){
    if (session_status() == PHP_SESSION_NONE) {
     session_start();
    }
    if(!isset($_SESSION['login'])){
        header("location:$location");
        exit;
    }
}


//end register


//All Posts Function 
function getAllPost(){
    $sql = "SELECT * FROM posts ORDER BY id DESC";
    return mysqli_query(conn(),$sql);
}

function getPostById($id){
    $sql = "SELECT * FROM posts WHERE id = '$id'";
    return mysqli_fetch_assoc(mysqli_query(conn(),$sql));
}
function getPostByUserId($id){
    $sql = "SELECT posts.*, users.role, users.nama FROM posts INNER JOIN users  ON posts.user_id = users.id WHERE user_id = '$id'";
    return (mysqli_query(conn(),$sql));
}
function getPostByUserIdAndPostId($id,$postId){
    $sql = "SELECT * FROM posts WHERE user_id = '$id' AND posts.id = '$postId'";
    return mysqli_fetch_assoc(mysqli_query(conn(),$sql));
}
function getViewPostById($id){
    $sql = "SELECT posts.*, users.role, users.nama FROM posts INNER JOIN users ON posts.user_id = users.id WHERE is_allowed = true AND NOW() >= deploy_date AND posts.id = '$id' ";

    return mysqli_fetch_assoc(mysqli_query(conn(),$sql));
}
function getViewPostByIdAdmin($id){
    $sql = "SELECT posts.*, users.role, users.nama FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = '$id' ";

    return mysqli_fetch_assoc(mysqli_query(conn(),$sql));
}

function getPostOrderBy($order,$by){
    $sql = "SELECT * FROM posts INNER JOIN posts_interaction ON posts.id = posts_interaction.id_post ORDER BY `$by` $order LIMIT 5";
    return mysqli_query(conn(),$sql);
}

function getUnVerifPost(){
    $sql = "SELECT * FROM posts WHERE is_allowed = false ORDER BY id DESC";
    return mysqli_query(conn(),$sql);
}
function getVerifPost(){
    $sql = "SELECT * FROM posts WHERE is_allowed = true ORDER BY id DESC";
    return mysqli_query(conn(),$sql);
}
function getReadyPosts(){
     $sql = "SELECT posts.*, users.role, users.nama FROM posts INNER JOIN users  ON posts.user_id = users.id WHERE is_allowed = true AND NOW() >= deploy_date ORDER BY id DESC";
    return mysqli_query(conn(),$sql);
}

function getFavPosts($filter,$searchTerm,$current_page){
    $userId = mysqli_fetch_assoc(getUserByEmail($_SESSION['login']))['id'];

    $sql = '';
    if($filter != 'all'){
        $sql .= getFavSqlByRole($filter);
    }else{
        $sql = "SELECT posts.*, 
        users.role, 
        users.nama,
        users_fav.id_user as user_fav_id_user, 
        users_fav.id_liked_post  FROM posts INNER JOIN users ON posts.user_id = users.id INNER JOIN 
        users_fav ON posts.id = users_fav.id_liked_post WHERE users_fav.id_user = '$userId' ";
        $sql .= opAndRelease();
    }
    $sql .= sqlSearchPost($searchTerm);
    $sql .= sqlOrderBy("id","ASC");
    $sql .= sqlLimit($current_page);
    return mysqli_query(conn(),$sql);
}

function getTotalFavPost($userId){
    $sql = "SELECT * FROM users_fav WHERE id_user = '$userId'";
    return mysqli_num_rows(mysqli_query(conn(),$sql));
}

function getFilterPosts($filter,$searchTerm,$current_page){
    
    $sql = '';

    switch($filter){
        //get verivied post 
        case 'verified':
            $sql = "SELECT posts.*, users.role, users.nama FROM posts INNER JOIN users ON posts.user_id = users.id WHERE is_allowed = true ";
            $sql .= sqlSearchPost($searchTerm);
            $sql .= sqlOrderBy("id","DESC");
            break;
        //get unverivied post 
        case 'unverified':
            $sql = "SELECT posts.*, users.role, users.nama FROM posts INNER JOIN users ON posts.user_id = users.id WHERE is_allowed = false ";
            $sql .= sqlSearchPost($searchTerm);
            $sql .= sqlOrderBy("id","DESC");
           break;
        //get release post 
        case 'release':
            $sql = "SELECT posts.*, users.role, users.nama FROM posts INNER JOIN users ON posts.user_id = users.id WHERE is_allowed = true AND NOW() >= deploy_date ";
            
            $sql .= sqlSearchPost($searchTerm);
            $sql .= sqlOrderBy("id","DESC");
            break;
            case "all-admin":
                $sql = "SELECT posts.*, users.role, users.nama FROM posts INNER JOIN users ON posts.user_id = users.id ";
                $sql .= sqlSearchPost($searchTerm);
                $sql .= sqlOrderBy("id","DESC");
                $sql .= sqlLimit($current_page);
            break;
            case "all":
                $sql = "SELECT posts.*, users.role, users.nama FROM posts INNER JOIN users ON posts.user_id = users.id ";
                $sql .= opAndRelease();
                $sql .= sqlSearchPost($searchTerm);
                $sql .= "ORDER BY CASE WHEN category = 'pengumuman penting' THEN 0 ELSE 1 END, id DESC";
                $sql .= sqlLimit($current_page);
            break;
            
        //handle all user role      
        
        default:
            $sql .= getSqlByRole($filter);
            $sql .= sqlSearchPost($searchTerm);
            $sql .= sqlOrderBy("id","ASC");
        break;
    }
    
    return mysqli_query(conn(),$sql);
}

function getFavSqlByRole($role){
    $userId = mysqli_fetch_assoc(getUserByEmail($_SESSION['login']))['id'];
    $sql = "SELECT 
    posts.*, 
    users.role, 
    users.nama,
    users_fav.id_user as user_fav_id_user, 
    users_fav.id_liked_post 
    FROM 
        posts 
    INNER JOIN 
        users ON posts.user_id = users.id
    INNER JOIN 
        users_fav ON posts.id = users_fav.id_liked_post
    WHERE 
    users.role = '$role' 
    AND users_fav.id_user = '$userId'"
;
    $sql .= opAndRelease();
             
    return $sql;
}

function getSqlByRole($role){
    // if(empty($role)){
    //     $sql = "SELECT posts.*, users.role, users.nama FROM posts INNER JOIN users ON posts.user_id = users.id ";
    // }else{
        $sql = "SELECT posts.*, users.role, users.nama FROM posts INNER JOIN users ON posts.user_id = users.id WHERE users.role = '$role' ";
        $sql .= opAndRelease();

    // }
             
    return $sql;
}



function sqlSearchPost($searchTerm){
    $sql = '';
    if (!empty($searchTerm)) {
        $sql .= "AND (posts.judul LIKE '%$searchTerm%' OR posts.isi LIKE '%$searchTerm%') ";
    }
    return $sql;
}
function sqlSearchUser($searchTerm){
    $sql = '';
    if (!empty($searchTerm)) {
        $sql .= "WHERE (users.nama LIKE '%$searchTerm%' OR users.email LIKE '%$searchTerm%' OR users.id LIKE '%$searchTerm%' OR users.role LIKE '%$searchTerm%') ";
    }
    return $sql;
}

function sqlOrderBy($by,$order){
$sql = "ORDER BY $by $order";
return $sql;
}

function getPostsInteracByPostId($id){
    $sql = "SELECT * FROM posts_interaction WHERE id_post = '$id'";
    return mysqli_fetch_assoc(mysqli_query(conn(),$sql));
}

function checkIsLiked($user_id,$post_id){
    $sql = "SELECT * FROM users_fav WHERE id_user = '$user_id' AND id_liked_post ='$post_id'";
    $result = mysqli_query(conn(), $sql);

    if ($result) {
        $row_count = mysqli_num_rows($result);
        return $row_count;
    }

}

//End Posts Function 
function getUserByEmail($email){
    $sql = "SELECT * FROM users WHERE email = '$email'";
    return mysqli_query(conn(),$sql);
}

function getUserIdByEmail($email){
    $sql = "SELECT users.id FROM users WHERE email = '$email'";
    return mysqli_fetch_assoc(mysqli_query(conn(),$sql))['id'];
}

function getAllUser($searchTerm,$current_page){
    $sql = '';
    $sql = "SELECT * FROM users ";
    $sql .= sqlSearchUser($searchTerm);
    $sql .= sqlOrderBy("id","ASC");
    $sql .= sqlLimit($current_page);


    return mysqli_query(conn(),$sql);
}

function opAndRelease(){
    $sql = " AND is_allowed = true AND NOW() >= deploy_date ";
    return $sql;
}

function sqlLimit($current_page){
    $records_per_page = 10;
        
    // Calculate the offset
    $offset = ($current_page - 1) * $records_per_page;

    // Execute the SQL query with the limit clause
    $sql = " LIMIT $offset, $records_per_page ";
    return $sql;
}

function setBadgeColor($role){
    switch($role){
        case "siswa":
            return "bg-blue-400";
        break;
        case "guru":
            return "bg-red-400";
        break;
        case "osis":    
            return "bg-yellow-400";
        break;
        case "ketua eskul":    
            return "bg-emerald-400";
        break;
        case "admin":
            return "bg-green-400";
        break;
        case "pengumuman":
            return "bg-green-500 text-white";
        break;
        case "pengumuman penting":
            return "bg-red-700 text-white";
        break;
        case "ekstrakurikuler":
            return "bg-blue-500 text-white";
        break;
        case "event":
            return "bg-indigo-300 text-white";
        break;
        case "lain lain":
            return "bg-gray-600 text-white";
        break;

    }
}

function fetchAllData($sql){
    header('Content-Type: application/json');

    $host = 'localhost';
    $db = 'db_madingschool';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $opt);

    $stmt = $pdo->query($sql);
    $data = $stmt->fetchAll();

    return json_encode($data);
}

function countPostView($postId){
    if($postId != ''){
        $sqlGet = "SELECT * FROM posts_interaction WHERE id_post = '$postId'";
        $postData = mysqli_fetch_assoc(mysqli_query(conn(),$sqlGet));
        $newViews = $postData['views_total'] + 1;

        $sqlUpdate = "UPDATE `posts_interaction` SET `views_total` = '$newViews' WHERE `posts_interaction`.`id_post` = '$postId'";

        mysqli_query(conn(),$sqlUpdate);

    }
} 

function isOptionSelected($role,$optionValue){
    if($role == $optionValue){
        return 'selected';
    }else{
        return '';
    }
}

function getRoleSettingsData(){
    $sql = "SELECT * FROM role_settings ";
    return mysqli_query(conn(),$sql);
}

function getRoleIsChecked($role, $roleRow){
    $sql = "SELECT `$roleRow` FROM role_settings WHERE role = '$role'";
    return mysqli_fetch_assoc(mysqli_query(conn(),$sql))["$roleRow"];

}

function setChecked($value){
    if($value){
        return  'checked';
    }else{
        return  '';
    }
}

function getRoleByEmail($email){
    $sql = "SELECT users.role FROM users WHERE users.email = '$email'";
    return mysqli_fetch_assoc(mysqli_query(conn(),$sql))['role'];
}

function setNavHidden($value){
    if($value){
        return 'hidden p-0 m-0 w-0 h-0';
    }else{
        return '';
    }
}

function formatDateTime($dateTimeString) {
    // Create a DateTime object
    $dateTime = new DateTime($dateTimeString);

    // Format the date and time
    $formattedDate = $dateTime->format('g:i A F j, Y');

    return $formattedDate;
}

