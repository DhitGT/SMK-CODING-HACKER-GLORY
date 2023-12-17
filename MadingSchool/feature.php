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

    <title>Feature</title>
</head>
<body>
    <?php include 'components/navbar.php' ?>
    <div class="container mx-auto  ">
        <section id='post'>
            <div id="9999" class="post-card mx-auto bg-white md:w-3/4 w-full rounded p-4 shadow-2xl">
                    <h3 class="text-xl text-center font-medium">
                        Some Feature In This Website
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
                        <ol style="margin-bottom: 0cm; margin-top: 13.3333px;">
<li style="text-align: justify; margin: 10pt -24.6pt 0cm 0px; line-height: 115%; font-size: 11pt; font-family: helvetica, arial, sans-serif; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;"><strong>Halaman Home</strong></span></li>
</ol>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;">Di halaman home ini semua pengguna (baik sudah login maupun belum) dapat melihat semua Mading yang sudah di publikasikan</span></p>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);">&nbsp;</p>
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="2">
<li style="text-align: justify; margin: 0cm -24.6pt 0cm 0px; line-height: 115%; font-size: 11pt; font-family: helvetica, arial, sans-serif; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;"><strong>Halaman Dashboard</strong></span></li>
</ol>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;">Halaman dashboard hanya dapat diakses oleh user dengan role &lsquo;admin&rsquo;. Di dalam halaman dashboard kita bisa melihat berbagai Postingan Mading yang sudah di publish maupun yang belum di publish dan terdapat tombol &lsquo;allow post&rsquo; untuk mengizinkan mading untuk di publish ke public. Dan ada tombol hapus untuk menghapus Postingan.</span></p>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);">&nbsp;</p>
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="3">
<li style="text-align: justify; margin: 0cm -24.6pt 0cm 0px; line-height: 115%; font-size: 11pt; font-family: helvetica, arial, sans-serif; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;"><strong>Halaman Tambah Post</strong></span></li>
</ol>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;">Melalui halaman ini beberapa user dengan role tertentu yang sudah di tentukan agar bisa menambahkan Post, bisa menambahkan postingan mading baru disini, dengan beberapa keperluan seperti : Judul Mading, Isi Mading, Category Mading, dan tanggal kapan mading tersebut akan dirilis.</span></p>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);">&nbsp;</p>
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="4">
<li style="text-align: justify; margin: 0cm -24.6pt 0cm 0px; line-height: 115%; font-size: 11pt; font-family: helvetica, arial, sans-serif; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;"><strong>Halaman Edit Post</strong></span></li>
</ol>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;">Melalui halaman ini user yang di izinkan untuk edit post dapat mengedit postingan mading mereka sendiri, fitur ini berguna untuk memperbaiki apabila ada kata kata yang salah atau kurang.</span></p>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);">&nbsp;</p>
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="5">
<li style="text-align: justify; margin: 0cm -24.6pt 0cm 0px; line-height: 115%; font-size: 11pt; font-family: helvetica, arial, sans-serif; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;"><strong>Fitur Hapus Post</strong></span></li>
</ol>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;">Melalui halaman ini user yang di izinkan untuk hapus post dapat menghapus postingan mading mereka sendiri, fitur ini berguna untuk mengurai / menghapus postingan mading yang sudah tidak relevan lagi</span></p>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);">&nbsp;</p>
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="6">
<li style="text-align: justify; margin: 0cm -24.6pt 0cm 0px; line-height: 115%; font-size: 11pt; font-family: helvetica, arial, sans-serif; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;"><strong>Fitur Favorite</strong></span></li>
</ol>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;">Semua user yang sudah login ( apapun itu role nya ) bisa menyimpan beberapa postingan ke halaman favorite. Fitur ini berguna untuk menyimpan beberapa postingan mading yang mukin akan kita baca kembali di lain waktu</span></p>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);">&nbsp;</p>
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="7">
<li style="text-align: justify; margin: 0cm -24.6pt 0cm 0px; line-height: 115%; font-size: 11pt; font-family: helvetica, arial, sans-serif; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;"><strong>Halaman Profile</strong></span></li>
</ol>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;">Dihalaman ini user akan melihat deskripsi singkat mengenai akun nya sendiri, dan terdapat postingan yang user itu sudah posting.</span></p>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);">&nbsp;</p>
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="8">
<li style="text-align: justify; margin: 0cm -24.6pt 0cm 0px; line-height: 115%; font-size: 11pt; font-family: helvetica, arial, sans-serif; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;"><strong>Halaman User Controll</strong></span></li>
</ol>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;">Halaman ini hanya dapat diakses oleh admin saja, di dalam halaman ini terdapat semua data user, disini admin dapat memodifikasi role seseorang, dan admin dapat mengatur hak akses setiap role.</span></p>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);">&nbsp;</p>
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="9">
<li style="text-align: justify; margin: 0cm -24.6pt 0cm 0px; line-height: 115%; font-size: 11pt; font-family: helvetica, arial, sans-serif; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;"><strong>Halaman Statistic</strong></span></li>
</ol>
<p style="margin: 0cm -24.6pt 0cm 18.85pt; text-align: justify; line-height: 115%; font-size: 11pt; font-family: Nunito; color: rgb(66, 66, 66);"><span style="font-family: helvetica, arial, sans-serif;">Dihalaman ini beberapa user role yang dipilih agar bisa mengakses halaman ini, dapat melihat chart dari jumlah total view website , bisa berdasarkan jarak waktu hari, minggu, dan tahun. Dilengkapi dengan <strong><em>export to excel button.</em></strong></span></p>
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