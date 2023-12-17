<?php

    session_start();
    include "../function.php";
    checkLogin("../login");

    $userRole = getRoleByEmail($_SESSION['login']);
    if(!getRoleIsChecked($userRole,'can_add')){
        header('location:../index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tiny.cloud/1/1vh79zsuthzr11yw9v9to8d2vdh565ob17lomk5ldjjot9sv/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  
</head>
<body>
    <!-- navbar -->
    <?php include "../components/navbar.php" ?>
    <!-- navbar end -->
    <div class="container mx-auto">
        <div class="bg-gray-200 p-3">
            <form action="../process/addPost.php" method="POST" class="flex flex-col gap-4">
                <div class=" bg-white border-2 border-slate-400 rounded-xl">
                    <input required class="rounded-xl p-3 w-full" name="judul" type="text" placeholder="Judul Mading">
                </div>
                <div class=" bg-white border-2 border-slate-400 rounded-xl">
                    <textarea required name="isi" id="" cols="30" rows="10">
                        <h2 align="center">Mading Content</h2>
                        <h4>Sub Header</h4>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quae exercitationem dolor mollitia molestias enim! Cupiditate vero eum, aut illo ipsum ipsa totam. Quos, repellendus officiis?</p>
                        <br>
                        <h4>Sub Header</h4>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quae exercitationem dolor mollitia molestias enim! Cupiditate vero eum, aut illo ipsum ipsa totam. Quos, repellendus officiis?</p>
                    </textarea>
                </div>
                <div class=" bg-white border-2 border-slate-400 rounded-xl py-2 px-3">
                    <label for="category" class="text-black">Select Category </label><br>
                    <select  name="category" id="category" class="p-1 rounded px-3 w-full">
                        <option value="pengumuman">pengumuman</option>
                        <option value="pengumuman penting">pengumuman penting</option>
                        <option value="ekstrakurikuler">ekstrakurikuler</option>
                        <option value="event">event</option>
                        <option value="lain lain">lain lain</option>
                    </select>
                </div>
                <div class=" bg-white border-2 border-slate-400 rounded-xl py-2 px-3">
                    <label for="tanggal" class="text-black">Choose Date Time Release:</label><br>
                    <input required type="datetime-local" id="tanggal"  name="tanggal" class=" py-2 px-3 text-black w-full">
                </div>
                <div class=" bg-white border-2 border-slate-400 rounded-xl">
                    <button class="p-1 w-full px-4 rounded bg-yellow-500" type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../components/footer.php' ?>

    <script>
        const currentDate = new Date();
        const year = currentDate.getFullYear();
        const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Month is zero-based
        const day = String(currentDate.getDate()).padStart(2, '0');
        const hours = String(currentDate.getHours()).padStart(2, '0');
        const minutes = String(currentDate.getMinutes()).padStart(2, '0');

        const initialDate = `${year}-${month}-${day}T${hours}:${minutes}`;
        document.getElementById("tanggal").value = initialDate;
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