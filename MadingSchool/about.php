<?php 

    include 'function.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>About</title>
</head>
<body>
    <?php include 'components/navbar.php' ?>
    <div class="container mx-auto  ">
        <section id='post'>
            <div id="9999" class="post-card mx-auto bg-white md:w-3/4 w-full rounded p-4 shadow-2xl">
                    <h3 class="text-xl text-center font-medium">
                        About This Website
                    </h3>
                    <div class="flex flex-col items-center justify-center w-full text-base sm:text-base text-xs">
                        <div class="flex flex-col-reverse w-full gap-2 justify-center items-center md:flex-row">
                            <div class="flex justify-center w-fit p-1 ">
                                <p>By : Aditya</p>
                            </div>
                            <div class="flex gap-2">
                                <div
                                    class="badge text-xs <?php echo setBadgeColor('admin') ?> h-auto p-1 px-3 rounded">
                                    admin
                                </div>
                                <p>||</p>
                                <div
                                    class="badge text-xs <?php echo setBadgeColor('lain lain') ?> h-auto p-1 w-fit px-3 rounded">
                                    information
                                </div>
                            </div>
                        </div>
                        <p>
                            17 Desc 2023
                        </p>
                    </div>
                    <div class="md:p-8  mt-2 p-2 border-t-2 border-t-gray-500 text-clip max-w-screen overflow-x-hidden">
                        <p style="text-align: justify;"><strong>What (Apa): </strong>Mading School adalah proyek pengembangan website daring yang memungkinkan sekolah untuk membuat dan mengelola mading secara online. Mading adalah papan pengumuman yang berisi informasi-informasi penting di sekolah.</p>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;"><strong>Why (Mengapa):</strong> Tujuan proyek ini adalah untuk memeberikan kemudahan kepada para warga sekolah untuk dapat menyampaikan informasi dengan modern dan efisien dengan memanfaatkan teknologi internet.</p>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;"><strong>Who (Siapa): </strong>Proyek ini dibuat oleh diri saya sendiri (Aditya), saya merancang, mengembangkan, dan melaksanakan proyek ini dan dengan dibantu oleh beberapa artikel yang ada di internet.</p>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;"><strong>When (Kapan):</strong> Pengembangan proyek ini dilaksanakan pertama kali pada tanggal 10 Desember 2023 sampai dengan selesai. Where (Dimana): Mading School dapat diakses melalui website dengan menggunakan internet, yang bisa di akses darimana saja, dan kapan saja.</p>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;"><strong>How (Bagaimana):</strong> Saya, Aditya, merancang Mading School dengan berbagai perencanaan Melibatkan analisis kebutuhan, desain user interface, coding, pengujian menyeluruh, demi memastikan setiap langkah sesuai dengan harapan.&nbsp;</p>
                    </div>
                    <div class="flex gap-2 items-center border-t-2 mt-2 pt-2 border-t-gray-400">
                        <div class="flex gap-2">
                            <img src="resource/icon/heart-fill.svg" alt="heart-fill" class="w-5">
                            <p id="like-count-999?>"> 120k Likes</p>
                        <div class="ms-auto flex gap-2">
                            <img class="w-5" src="resource/icon/eye-line.svg" ;
                            <p id="like-count-9999?>">
                                1.2m x viewed
                            </p>
                        </div>
                    </div>

                </div>
        </section>
    </div>
    <?php include 'components/footer.php' ?>

</body>
</html>