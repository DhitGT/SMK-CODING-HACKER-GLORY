<?php 
    include "../function.php";
    checkLogin("../login");
    include '../process/countView.php';
    

    $searchTerm = isset($_POST['search'])? $_POST['search'] : '';
    $selectedFilter = isset( $_POST['filter'])? $_POST['filter']: (isset($_GET['filter'])? $_GET['filter'] : 'all');
    $curent_page = 1;
    $userId = getUserIdByEmail($_SESSION['login']);
    $userData = mysqli_fetch_assoc(getUserByEmail($_SESSION['login']));
    $posts = getPostByUserId($userId);
    $totalPost = mysqli_num_rows($posts);
    $totalFav = getTotalFavPost($userId);

    $query = "SELECT NOW() as current_datetime";
    $result = mysqli_query(conn(), $query);
    $row = mysqli_fetch_assoc($result);

    $csrfToken = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrfToken;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- remixicon link -->
    <link href="
https://cdn.jsdelivr.net/npm/remixicon@3.7.0/fonts/remixicon.min.css
" rel="stylesheet">
    <!-- tailwind link -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- j query -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="../jQuery-Plugin-For-Animated-Stackable-Toast-Messages-Toast/src/jquery.toast.css" rel="stylesheet" type="text/css">
  
</head>
<body>
    <!-- navbar -->
    <?php include "../components/navbar.php" ?>
    <!-- navbar end -->
    <div class="container mx-auto">
        <section id="profile">
            <div class="flex flex-col md:flex-row p-4 bg-gray-200 mt-12 rounded">
                <div class="bg-white mx-auto md:mx-0 flex items-center justify-center w-64 h-64 rounded-full">
                    <img src="../resource/icon/user-3-line.svg" alt="profile foto" class="w-44 ">
                </div>
                <div class="pt-5 md:ps-20 my-2 text-center md:text-left">
                    <p class="text-4xl font-bold"><?php echo $userData['nama'] ?></p>
                    <p class="text-2xl font-normal mt-2"><?php echo $userData['email'] ?></p>
                    <div class="flex gap-4 mt-12 text-lg">
                        <p>Favorite : <?php echo $totalFav ?></p>
                        <p id="total-post">Post : <?php echo $totalPost ?></p>
                    </div>
                    <div class="flex gap-4 mt-5">
                        <div class="badge p-2 <?php echo setBadgeColor($userData['role'] ) ?> rounded-xl px-12">
                            <?php echo $userData['role'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id='post'>
            <div class="post-wrapper flex flex-col gap-4 items-center bg-gray-200 mt-7  p-2 justify-center py-20">
                <?php if($totalPost != 0): ?>
                <?php foreach ($posts as $data): ?>
                <div id="<?php echo $data['id'] ?>" class="post-card bg-white md:w-3/4 w-[90%] border-2 border-gray-400 rounded p-4 shadow-2xl">
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
                    <div class="md:p-8 max-h-40 overflow-hidden p-2">
                        <?php echo ($data['isi']) ?>
                    </div>
                    <div class="flex gap-2 items-center">
                        <a href="../view.php?id=<?php echo $data['id'] ?>" class="btn w-fit hover:w-3/4 mx-auto text-center mt-4 bg-gray-200 p-2 rounded duration-700 ease-in-out">Baca
                            Selengkapnya
                        </a>
                        <a href="../posts/edit.php?id=<?php echo $data['id'] ?>" class="py-2 ">
                            <button class="hover:rotate-12 transition-all duration-200 py-1 px-2 rounded"><img class="w-6 md:w-8" src="../resource/icon/edit-line.svg" alt="edit svg"></button>
                        </a>
                        <div class="py-2 ">
                            <button class="hover:rotate-12 transition-all duration-200 py-1 px-2 rounded" onclick="deletePost(<?php echo $data['id'] ?>)"><img class="w-6 md:w-8" src="../resource/icon/delete-bin-6-line.svg" alt="delete bin svg"></button>
                        </div>
                    </div>
                    <div class="flex gap-2 items-center border-t-2 mt-2 pt-2 border-t-gray-400">
                        <div>
                            <button <?php $postId=$data['id']; echo "id='Like-btn-$postId'" ?> onclick="likePost(
                                <?php echo $postId ?>)" class="transition-all duration-600 active:scale-150">
                                <img src="<?php echo checkIsLiked($userId, $postId) ? '../resource/icon/heart-fill.svg' : '../resource/icon/heart-line.svg';?>"
                                id="like-img-<?php echo $data['id'] ?>" alt="heart line" class="w-9">
                            </button>
                        </div>
                        <p id="like-count-<?php echo $data['id'] ?>">
                            <?php echo getPostsInteracByPostId($data['id'])['likes_total'] ?> Likes
                        </p>
                        <div class="ms-auto flex gap-2">
                            <img class="w-5" src="../resource/icon/eye-line.svg";
                            <p id="like-count-<?php echo $data['id'] ?>">
                                <?php echo getPostsInteracByPostId($data['id'])['views_total'] ?>x viewed
                            </p>
                        </div>
                    </div>

                </div>
                <?php endforeach ?>
                <?php else:?>
                    <p>Tidak Ada Postingan</p>
                <?php endif?>

            </div>
        </section>
    </div>
    <?php include '../components/footer.php' ?>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="../jQuery-Plugin-For-Animated-Stackable-Toast-Messages-Toast/src/jquery.toast.js"></script>
    <script>
        const userId = "<?php echo $userId?>";
         var csrfToken = '<?php echo $csrfToken; ?>';
         var totalPost = <?php echo getTotalFavPost($userId)?>;
        function deletePost(postId) {
        // AJAX request to delete post
            $.ajax({
                type: 'POST',
                url: '../process/deletePost.php',
                data: { postId: postId, csrf_token: csrfToken },
                headers: { 'X-CSRF-Token': csrfToken },
                success: function(response) {
                    var cardToDelete = $('#post-card-' + postId);
                    var totalPostElem = $('#total-post');

                    // Hide the row
                    cardToDelete.hide();
                    totalPostElem.textContent = `Post : ${totalPost-1}`
                    $.toast({
                        heading: 'Success',
                        text: 'post berhasil dihapus',
                        position: 'top-right',
                        showHideTransition: 'fade',
                        icon: 'success'
                    })
                },
                error: function(error) {
                    // Handle the error response
                    console.error('Error deleting post:', error);
                }
            });
        }

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
                xhr.open('POST', `../process/setLike.php`, true);
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