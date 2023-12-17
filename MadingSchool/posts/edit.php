<?php

    session_start();
    include "../function.php";
    checkLogin("../login");

    $postId = $_GET['id'];
    $userRole = getRoleByEmail($_SESSION['login']);
    $userId = getUserIdByEmail($_SESSION['login']);
    if(!getRoleIsChecked($userRole,'can_edit_posts') || getPostByUserIdAndPostId($userId,$postId)['id'] !=  $postId){
        header('location:../index.php');
    }
    $postData = getPostById($postId);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tiny.cloud/1/1vh79zsuthzr11yw9v9to8d2vdh565ob17lomk5ldjjot9sv/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

</head>
<body>
    <!-- navbar -->
    <?php include "../components/navbar.php" ?>
    <!-- navbar end -->
    <div class="container mx-auto">
        <div class="bg-red-500 p-3">
            <form action="../process/updatePost.php" method="POST" class="flex flex-col gap-4">
                <input type="hidden" name="id" value = "<?php echo $postData['id'] ?>">
                <div >
                    <input class="rounded" name="judul" type="text" placeholder="Judul" value="<?php echo $postData['judul'] ?>">
                </div>
                <div class="">
                    <textarea name="isi" id="" cols="30" rows="10">
                        <?php echo $postData['isi'] ?>
                    </textarea>
                </div>
                <div class="">
                    <label for="category" class="text-white">Pilih Category </label><br>
                    <select name="category" id="category" class="p-1 rounded px-3">
                        <option value="pengumuman">pengumuman</option>
                        <option value="pengumuman penting">pengumuman penting</option>
                        <option value="ekstrakurikuler">ekstrakurikuler</option>
                        <option value="event">event</option>
                        <option value="lain lain">lain lain</option>
                    </select>
                </div>
                <div class="">
                    <label for="tanggal" class="text-white">Pilih Tanggal dan Waktu:</label><br>
                    <input type="datetime-local" id="tanggal" name="tanggal" class="text-black" value="<?php echo $postData['deploy_date'] ?>">
                </div>
                <div class="">
                    <button class="p-1 px-4 rounded bg-yellow-500" type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../components/footer.php' ?>

    <script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
  });
</script>
</body>
</html>