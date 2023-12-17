<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>

    <title>login</title>
</head>
<body>
    <div class="mx-auto container pt-[10%]">
        <div class="card flex flex-col justify-center bg-gray-200 items-center p-5 font-white-900">
            <h1 class="mb-5 text-2xl font-bold">Login</h1>

            <form action="../process/login.php" method="post" class="flex flex-col p-4 rounded-xl bg-white gap-3 shadow-xl border-2 border-gray-400 w-[90%] md:w-2/4">
                <span class="text-red-500"><?= isset($_SESSION['info'])? $_SESSION['info'] : '' ?></span>
                <?php 
                    isset($_SESSION['info'])? $_SESSION['info'] = '' : '';
                ?>
                <input type="email" class="rounded p-1" name="email" placeholder="@email">
                <input type="password" class="rounded p-1" name="password" placeholder="password">
                <button type="submit" class="rounded p-1 bg-green-500" >
                    Log In
                </button>
                <p class="text-center">Or</p>
                <p class="text-center ">Register new account <a class="text-blue-400 hover:underline hover:text-red-600" href="../register/index.php">here</a></p>
            </form>
        </div>
    </div>
</body>
</html>