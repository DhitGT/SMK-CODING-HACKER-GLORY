<?php 
    include "function.php";
    include 'process/countView.php';

        session_start();
    $postId = isset($_GET['id'])? $_GET['id']:'';
    $email = isset($_SESSION['login'])? $_SESSION['login']: 'guest';
    $user_Roles = mysqli_fetch_assoc(getUserByEmail($email))['role'];
    if($user_Roles != 'admin'){
        $data = getViewPostById($postId);
    }else{
        $data = getViewPostByIdAdmin($postId); 
        
    }
    if(!$data){
        header('location:/madingschool/');
    }

    countPostView($postId);
    $userId = isset($_SESSION['login']) ? mysqli_fetch_assoc(getUserByEmail($_SESSION['login']))['id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <!-- remixicon link -->
    <link href="
https://cdn.jsdelivr.net/npm/remixicon@3.7.0/fonts/remixicon.min.css
" rel="stylesheet">
    <!-- tailwind link -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="jQuery-Plugin-For-Animated-Stackable-Toast-Messages-Toast/src/jquery.toast.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- navbar -->
    <?php include "components/navbar.php" ?>
    <!-- navbar end -->
    <div class="container mx-auto  ">
        <section id='post'>
            <div id="<?php echo $data['id'] ?>" class="post-card mx-auto bg-white md:w-3/4 w-full rounded p-4 shadow-2xl">
                    <h3 class="text-xl text-center font-medium">
                        <?php echo htmlspecialchars($data['judul']) ?>
                    </h3>
                    <div class="flex flex-col items-center justify-center w-full text-base sm:text-base text-xs">
                        <div class="flex flex-col-reverse w-full gap-2 justify-center items-center md:flex-row">
                            <div class="flex justify-center w-fit p-1 ">
                                <p>By : <?php echo $data['nama'] ?></p>
                            </div>
                            <div class="flex gap-2">
                                <div
                                    class="badge text-xs <?php echo setBadgeColor($data['role']) ?> h-auto p-1 px-3 rounded">
                                    <?php echo $data['role'] ?>
                                </div>
                                <p>||</p>
                                <div
                                    class="badge text-xs <?php echo setBadgeColor($data['category']) ?> h-auto p-1 w-fit px-3 rounded">
                                    <?php echo $data['category'] ?>
                                </div>
                            </div>
                        </div>
                        <p>
                            <?= formatDatetime($data['deploy_date'] )?>
                        </p>
                    </div>
                    <div class="md:p-8  mt-2 p-2 border-t-2 border-t-gray-500 text-clip max-w-screen overflow-x-hidden">
                        <?php echo ($data['isi']) ?>
                    </div>
                   
                    <div class="flex gap-2 items-center border-t-2 mt-2 pt-2 border-t-gray-400">
                        <div>
                            <button <?php $postId=$data['id']; echo "id='Like-btn-$postId'" ?> onclick="likePost(
                                <?php echo $postId ?>)" class="transition-all duration-600 active:scale-150">
                                <img src="<?php echo checkIsLiked($userId, $postId) ? 'resource/icon/heart-fill.svg' : 'resource/icon/heart-line.svg';?>"
                                id="like-img-<?php echo $data['id'] ?>" alt="heart line" class="w-9">
                            </button>
                        </div>
                        <p id="like-count-<?php echo $data['id'] ?>">
                            <?php echo getPostsInteracByPostId($data['id'])['likes_total'] ?> Likes
                        </p>
                        <div class="ms-auto flex gap-2">
                            <img class="w-5" src="resource/icon/eye-line.svg";
                            <p id="like-count-<?php echo $data['id'] ?>">
                                <?php echo getPostsInteracByPostId($data['id'])['views_total'] ?>x viewed
                            </p>
                        </div>
                    </div>

                </div>
        </section>
    </div>
       <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="jQuery-Plugin-For-Animated-Stackable-Toast-Messages-Toast/src/jquery.toast.js"></script>
    <?php include 'components/footer.php' ?>
    <script>
        const userId = "<?php echo $userId?>";

        function likePost(post_id) {
            if (userId == 0) {
                $.toast({
                        heading: 'Info',
                        text: 'anda harus login terlebih dahulu',
                        position: 'bottom-left',
                        showHideTransition: 'fade',
                        icon: 'info'
                    })
            } else {
                // Make an AJAX request to likePost.php

                var xhr = new XMLHttpRequest();
                xhr.open('POST', `process/setLike.php`, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        let result = JSON.parse(xhr.responseText);
                        // Update the number of likes on the page
                        document.getElementById('like-count-' + post_id).textContent = result.likes_total + " Likes "  ;
                        document.getElementById('like-img-' + post_id).src = result.like_image;
                    }
                }
                xhr.send('id=' + post_id);
            }
        }

    </script>
</body>
</html>