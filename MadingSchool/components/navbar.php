<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$email = isset($_SESSION['login'])? $_SESSION['login']: 'guest';
$user_Roles = mysqli_fetch_assoc(getUserByEmail($email))['role'];
$user_ids = getUserIdByEmail($email);
?>
<style>
.close{
    transform: translateY(-100%);
    opacity: 0;
}
.open{
    transform: translateY(0%);
    opacity: 1;
}
li:hover a{
    text-decoration:underline;
}
@media screen and (min-width: 760px){
    #navUl{
        opacity: 1;
        transform: translateY(0%);
    }
    #nav-toggler{
        opacity: 0;
        transform: translateY(-1000%);
    }

}
</style>
<div class="mb-12">

</div>
<nav class="mb-12 z-10 bg-slate-300 shadow-xl items-center flex w-screen h-12 fixed top-0 left-0">
<div class="ps-3 text-lg ">
    <p class="font-bold ">Mading School</p>
</div>
<div id="navUl" class="close fixed delay-200 transition-all ease-in-out duration-400 top-0 w-screen mx-auto bg-slate-600 text-white py-3 px-6">
    <div class="container mx-auto flex flex-col md:flex-row md:items-center">
        <div class="mb-2 md:mb-0 md:px-3 text-lg ">
            <p class="font-bold ">Mading School</p>
        </div>
        <ul  class="flex flex-col md:flex-row justify-start gap-3">
            <li><a href="/MadingSchool" >Home</a></li>
            <?php 
                if(getRoleIsChecked($user_Roles,"can_add")){
                    echo "<li><a href='/MadingSchool/posts/create.php'>Tambah Post</a></li>";
                }
            ?>
            <li><a href="/MadingSchool/favorite/">Favorite</a></li>
            <?php 
                if($user_Roles == "admin"){
                    echo "<li><a href='/MadingSchool/dashboard/'>Dashboard</a></li>
                    <li><a href='/MadingSchool/dashboard/usercontroll.php'>User Controll</a></li>
                    ";
                }
                
            ?>
            <?php if(getRoleIsChecked($user_Roles,"can_view_stats")){
                echo "<li><a href='/MadingSchool/dashboard/chart.php'>Statistic</a></li>";
            } ?>
            <?php 
                if(isset($_SESSION['login'])){
                    echo "<li><a href='/MadingSchool/profile/'>Profile</a></li>";
                    echo "<li class='flex items-center gap-1'><a href='/MadingSchool/process/logout.php'>Log Out</a></li>";
                }else{
                    echo "<li><a href='/MadingSchool/login/'>Login</a></li>";
                }

            ?>
        </ul>
    </div>
</div>
<span class="ms-auto fixed top-2 right-4 navbar-toggler" class="" onclick="toggleMenu()"><img class="w-8 transition-all duration-200" id="nav-toggler" src="/MadingSchool/resource/icon/menu-line.svg"></span>
</nav>

<script>
        function toggleMenu() {
            const navUl = document.getElementById('navUl');
            const navToggler = document.getElementById('nav-toggler');
            navUl.classList.toggle('open');
            if (navUl.classList.contains('open')){
                navToggler.src = "/MadingSchool/resource/icon/close-fill.svg";
                navToggler.style.transform ='rotate(360deg)';
            }else{
                navToggler.src = "/MadingSchool/resource/icon/menu-line.svg";
                navToggler.style.transform ='rotate(0deg)';
            }
        }
</script>