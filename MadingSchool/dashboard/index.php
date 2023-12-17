<?php 
    session_start();
    include "../function.php";
    // midware {
    checkLogin("../login");
    $user_Roles = mysqli_fetch_assoc(getUserByEmail($_SESSION['login']))['role'];
    if($user_Roles != 'admin'){
        header('location:../index.php');
    }
    // midware }

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
    $page = isset($_SESSION['page'])? $_SESSION['page'] : 1;

    $searchTerm = isset($_POST['search'])? $_POST['search'] : '';
    $selectedFilter = isset( $_POST['filter'])? $_POST['filter']: (isset($_GET['filter'])? $_GET['filter'] : 'all-admin');
    $_SESSION['filter'] = $selectedFilter;
    
    $posts = getFilterPosts($selectedFilter,$searchTerm,$page);

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
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="../jQuery-Plugin-For-Animated-Stackable-Toast-Messages-Toast/src/jquery.toast.css" rel="stylesheet" type="text/css">

</head>

<body>
    <!-- navbar -->
    <?php include "../components/navbar.php" ?>
    <!-- navbar end -->
    <div class="container mx-auto">
        <section id='post'>
            <div class="pt-5">
                <form action="" id="filterForm" method="post">
                    <div class="flex gap-4 justify-center">
                        <input type="text" name="search"
                            class="rounded p-1 my-auto h-[50%] border-2 border-gray-700 w-[20%] focus:w-[40%] duration-300"
                            placeholder="Search ">
                        <button type="submit" class="hover:scale-90 duration-100"><img class="w-5 md:w-8"
                                src="../../MadingSchool/resource/icon/search-2-line.svg" alt="search icon"></button>

                        <div class="flex rounded bg-gray-200 px-1 md:px-2">
                            <img src="../../MadingSchool/resource/icon/filter-line.svg" alt="filter icon"
                                class="w-5 md:w-8">
                            <select name="filter" id="filter"
                                class="bg-gray-200 px-1 w-fit md:px-3 hover:cursor-pointer">
                                <option name="filter" value="all-admin" class="bg-gray-200 p-2 rounded" <?php
                                if(isset($_POST['filter']) && $_POST['filter']=='siswa') echo 'selected' ?>>All</option>
                                <option name="filter" value="siswa" class="bg-gray-200 p-2 rounded" <?php
                                if(isset($_POST['filter']) && $_POST['filter']=='siswa') echo 'selected' ?>>Siswa</option>
                                <option name="filter" value="osis" class="bg-gray-200 p-2 rounded" <?php
                                if(isset($_POST['filter']) && $_POST['filter']=='osis') echo 'selected' ?>>Osis</option>
                                <option name="filter" value="ketua eskul" class="bg-gray-200 p-2 rounded" <?php
                                if(isset($_POST['filter']) && $_POST['filter']=='ketua eskul') echo 'selected' ?>>Ketua Eskul</option>
                                <option name="filter" value="guru" class="bg-gray-200 p-2 rounded" <?php
                                if(isset($_POST['filter']) && $_POST['filter']=='guru') echo 'selected' ?>>Guru</option>
                                <option name="filter" value="verified" class="bg-gray-200 p-2 rounded" <?php
                                if(isset($_POST['filter']) && $_POST['filter']=='verified') echo 'selected' ?>>Verified</option>
                                <option name="filter" value="unverified" class="bg-gray-200 p-2 rounded" <?php
                                if(isset($_POST['filter']) && $_POST['filter']=='unverified') echo 'selected' ?>>Un verified</option>
                            </select>
                        </div>

                    </div>
                </form>
            </div>
            
            <div
                class="post-wrapper flex flex-col gap-6 items-center mt-5 bg-slate-300 p-2 justify-center py-20">
                <?php foreach ($posts as $data): ?>
                    <div id="post-card-<?php echo $data['id'] ?>" class="post-card bg-white md:w-3/4 w-[90%] rounded p-4 shadow-xl">
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
                    <div class="flex gap-2 mt-2 justify-center items-center text-xs md:text-base">
                        <div>
                            <a href="../view.php?id=<?php echo $data['id'] ?>" class="btn w-fit hover:w-3/4 mx-auto text-center mt-4  p-2 rounded duration-700 ease-in-out">Baca
                                Selengkapnya
                            </a>
                        </div>
                            <div>
                                <?php if(!$data['is_allowed']): ?>
                                <form method="post" action="../process/verifPost.php">
                                    <input type="hidden" name="postId" value="<?php echo $data['id']; ?>">
                                    <input type="hidden" name="selectedFilter" value="<?php echo $selectedFilter ?>">
                                    <button type="submit" class="btn bg-green-600 p-2 rounded" name="verifSubmit">Allow
                                        Post</button>
                                </form>
                                <?php endif ?>
                            </div>
                            <div>
                                <div class="py-2 ">
                                    <button class="hover:rotate-12 transition-all duration-200 py-1 px-2 rounded" onclick="deletePost(<?php echo $data['id'] ?>)"><img class="w-6 md:w-8" src="../resource/icon/delete-bin-6-line.svg" alt="delete bin svg"></button>
                                </div>
                            </div>
                    </div>
                    <div class="flex gap-2 items-center border-t-2 mt-2 pt-2 border-t-gray-400">
                        <div>
                            <img src="../resource/icon/heart-line.svg" alt="heart line icon" class="w-6">
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
                <?php include '../components/changePage.php' ?>
                
            </div>
        </section>
    </div>
    <?php include '../components/footer.php' ?>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="../jQuery-Plugin-For-Animated-Stackable-Toast-Messages-Toast/src/jquery.toast.js"></script>
    
    <script>
        var csrfToken = '<?php echo $csrfToken; ?>';
        function handleFilterOnChange() {
            const filterElem = document.getElementById("filter")

            filterElem.addEventListener("change", function () {
                let selected = filterElem.value

                const filterForm = document.getElementById("filterForm");
                filterForm.submit()
            })
        }

        function deletePost(postId) {
        // AJAX request to delete post
            $.ajax({
                type: 'POST',
                url: '../process/deletePost.php',
                data: { postId: postId, csrf_token: csrfToken },
                headers: { 'X-CSRF-Token': csrfToken },
                success: function(response) {
                    var cardToDelete = $('#post-card-' + postId);

                    // Hide the row
                    cardToDelete.hide();
                    $.toast({
                        heading: 'Success',
                        text: 'Post berhasil di hapus',
                        position: 'top-right',
                        showHideTransition: 'fade',
                        icon: 'success'
                    })
                },
                error: function(error) {
                    // Handle the error response
                   $.toast({
                        heading: 'fail',
                        text: 'Post gagal di hapus',
                        position: 'top-right',
                        showHideTransition: 'fade',
                        icon: 'danger'
                    })
                }
            });
        }

        handleFilterOnChange()


    </script>
</body>

</html>