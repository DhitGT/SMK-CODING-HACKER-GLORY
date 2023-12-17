<?php 
session_start() ;



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>

    <title>register</title>
</head>
<body>
    <div class="mx-auto container pt-[10%] ">
        <div class="card flex flex-col justify-center bg-gray-200 items-center p-5 font-white-900">
            <h1 class="mb-5 text-2xl font-bold">register</h1>

            <form action="../process/register.php" method="post" class="flex flex-col p-4 rounded-xl bg-white gap-3 shadow-xl border-2 border-gray-400 w-[90%] md:w-2/4">
                <span class="text-red-600"><?= isset($_SESSION['info']) ? $_SESSION['info'] : '' ?></span>
                <?php 
    isset($_SESSION['info'])? $_SESSION['info'] = '' : '';

                ?>
                <input type="text" class="rounded p-1" name="username" placeholder="name">
                <input type="email" class="rounded p-1" name="email" placeholder="example@email.com">
                <input type="password" class="rounded p-1" name="password" placeholder="password">
                <input type="password" class="rounded p-1" name="passwordVerif" placeholder="repeat password">
                <button type="submit" class="rounded p-1 bg-green-500" >
                    register
                </button>
            </form>
        </div>
    </div>
</body>
</html>