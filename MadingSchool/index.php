
<?php 
    include "function.php";
    session_start();
    // checkLogin("/MadingSchool/login/");
    include 'process/countView.php';
    
    $_SESSION['page'] = isset($_SESSION['page'])?$_SESSION['page']:1;

    $searchTerm = isset($_POST['search'])? $_POST['search'] : '';
    if(isset($_POST['handleDecrease'])){
        if($_SESSION['page'] > 1){
            $_SESSION['page'] = $_SESSION['page'] -1;
        }
    }
    if(isset($_POST['handleIncrease'])){
        $_SESSION['page'] = $_SESSION['page'] +1;
    }
    $page = $_SESSION['page'];


    $selectedFilter = isset( $_POST['filter'])? $_POST['filter']: (isset($_GET['filter'])? $_GET['filter'] : 'all');
    $_SESSION['filter'] = $selectedFilter;

    $posts = getFilterPosts($selectedFilter,$searchTerm,$page);
    isset($_SESSION['info'])? $_SESSION['info'] = '' : '';

    $query = "SELECT NOW() as current_datetime";
    $result = mysqli_query(conn(), $query);
    $row = mysqli_fetch_assoc($result);

    $email = isset($_SESSION['login'])? $_SESSION['login']: 'guest';
    $user_Roles = mysqli_fetch_assoc(getUserByEmail($email))['role'];
    $userId = getUserIdByEmail($email);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
    <div class="container mx-auto">
        <section id='post'>
            <?php include 'components/search.php' ?>
            <div
                class="post-wrapper flex flex-col gap-6 items-center bg-gray-200 mt-7 rounded-xl p-2 justify-center py-20 text-xs md:text-base">

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
                        <a href="view.php?id=<?php echo $data['id'] ?>" class="btn w-fit hover:w-3/4 mx-auto text-center mt-4 bg-gray-200 p-2 rounded duration-700 ease-in-out">Baca
                            Selengkapnya
                        </a>
                    </div>
                    <div class="flex gap-2 items-center border-t-2 mt-2 pt-2 border-t-gray-400">
                        <div>
                            <button <?php $postId=$data['id']; echo "id='Like-btn-$postId'" ?> onclick="likePost(
                                <?php echo $postId ?>,<?php echo $userId ?>)" class="transition-all duration-600 active:scale-150">
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
                <?php endforeach ?>
                <?php include 'components/changePage.php' ?>

            </div>
        </section>
    </div>
    <?php include 'components/footer.php' ?>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="jQuery-Plugin-For-Animated-Stackable-Toast-Messages-Toast/src/jquery.toast.js"></script>

    <script>
        function handleFilterOnChange() {
            const filterElem = document.getElementById("filter")
            
            filterElem.addEventListener("change", function () {
                let selected = filterElem.value
                
                const filterForm = document.getElementById("filterForm");
                filterForm.submit()
            })
        }
        
        handleFilterOnChange()
        
        function likePost(post_id,uid) {
            if (uid == 0) {
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