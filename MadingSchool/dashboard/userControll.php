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


    $csrfToken = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrfToken;

    $searchTerm = isset($_POST['search'])? $_POST['search'] : '';
    $curent_page = isset($_GET['page'])? $_GET['page'] : 1;
    $usersData = getAllUser($searchTerm,$curent_page);

    $query = "SELECT NOW() as current_datetime";
    $result = mysqli_query(conn(), $query);
    $row = mysqli_fetch_assoc($result);

    $roleSettingsData = getRoleSettingsData();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Controll</title>
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
                <form action="" id="searchUser" method="post">
                    <div class="flex gap-1 justify-center">
                    <input type="text" name="search" class="rounded p-1 my-auto h-[50%] border-2 border-black w-[20%] focus:w-[60%] duration-300" placeholder="Search ">
                    <button class="p-3 py-1 hover:scale-90 duration-100" type="submit"><img src="../resource/icon/search-2-line.svg" alt="search svg" class="w-8"></button>
                </form>
            </div>
            <div class="post-wrapper flex flex-col gap-4 items-center bg-gray-200 mt-7 p-5 md:p-20 justify-center text-sm md:text-base">
                <div class="w-full bg-white shadow-2xl border-2 border-gray-400 rounded-xl p-2 h-max overflow-y-hidden">
                    <h4 class="sticky left-0">Role Settings</h4>
                    <table class="min-w-fit bg-white rounded-xl">
                        <thead>
                            <tr>
                                <th class="py-2 text-left px-4 sticky left-0 bg-white">Role</th>
                                <th class="py-2 text-left px-4 ">Add Post</th>
                                <th class="py-2 text-left px-4 ">Edit Post</th>
                                <th class="py-2 text-left px-4 ">Delete Post</th>
                                <th class="py-2 text-left px-4 ">View Statistic</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($roleSettingsData as $index => $rsData): ?>
                            <tr>
                                <td class="py-2 text-left px-4 sticky left-0 bg-white"> <?php echo $rsData['role'] ?></td>
                                <td class="py-2 text-left px-4">
                                    <div class="">
                                        <input name="role-settings"  data-role-id = '<?php echo $rsData['id'] ?>'  <?php echo setChecked($rsData['can_add']) ?> value="can_add" type="checkbox" class="w-5 h-5 bg-gray-600 text-blue-200 rounded role-settings">
                                    </div> 
                                </td>
                                <td class="py-2 text-left px-4">
                                    <div class="">
                                        <input name="role-settings"  data-role-id = '<?php echo $rsData['id'] ?>' <?php echo setChecked($rsData['can_edit_posts']) ?> value="can_edit_posts" type="checkbox" class="w-5 h-5 bg-gray-600 text-blue-200 rounded role-settings">
                                    </div> 
                                </td>
                                <td class="py-2 text-left px-4">
                                    <div class="">
                                        <input name="role-settings"  data-role-id = '<?php echo $rsData['id'] ?>' <?php echo setChecked($rsData['can_delete_posts']) ?> value="can_delete_posts" type="checkbox" class="w-5 h-5 bg-gray-600 text-blue-200 rounded role-settings">
                                    </div> 
                                </td>
                                <td class="py-2 text-left px-4">
                                    <div class="">
                                        <input name="role-settings"  data-role-id = '<?php echo $rsData['id'] ?>' <?php echo setChecked($rsData['can_view_stats']) ?> value="can_view_stats" type="checkbox" class="w-5 h-5 bg-gray-600 text-blue-200 rounded role-settings">
                                    </div> 
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="w-full bg-white rounded-xl shadow-2xl border-2 border-gray-400 h-max overflow-y-hidden">
                    <table class="min-w-fit bg-white rounded-xl">
                       <thead>
                           <tr>
                               <th class="py-2 text-left px-4 ">No</th>
                               <th class="py-2 text-left px-4 ">Id</th>
                               <th class="py-2 text-left px-4 sticky left-0 bg-white">Username</th>
                               <th class="py-2 text-left px-4 ">Email</th>
                               <th class="py-2 text-left px-4 ">Role</th>
                               <th class="py-2 text-left px-4 ">Actions</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php foreach ($usersData as $index => $uData): ?>
                           <tr id="user-row-<?php echo $uData['id'] ?>">
                               <td class="py-2 px-4 "><?php echo $index+1 ?></td>
                               <td class="py-2 px-4 "><?php echo $uData['id'] ?></td>
                               <td class="py-2 px-4 sticky left-0 bg-white "><?php echo $uData['nama'] ?> </td>
                               <td class="py-2 px-4 "><?php echo $uData['email'] ?></td>
                               <td class="py-2 px-4">
                           <select name="updateRole" class="update-role" data-user-id="<?php echo $uData['id'] ?>">
                               <option value="admin" <?php echo isOptionSelected($uData['role'], 'admin') ?> >admin</option>
                               <option value="siswa" <?php echo isOptionSelected($uData['role'], 'siswa') ?>>siswa</option>
                               <option value="guru" <?php echo isOptionSelected($uData['role'], 'guru') ?>>guru</option>
                               <option value="osis" <?php echo isOptionSelected($uData['role'], 'osis') ?>>osis</option>
                               <option value="ketua eskul" <?php echo isOptionSelected($uData['role'], 'ketua eskul') ?>>ketua eskul</option>
                           </select>
                       </td>
                               <td class="py-2 px-4 ">
                                   <button class="hover:rotate-12 transition-all duration-200 py-1 px-2 rounded" onclick="deleteUser(<?php echo $uData['id'] ?>)"><img class="w-8" src="../resource/icon/delete-bin-6-line.svg" alt="delete bin svg"></button>
                               </td>
                           </tr>
                           <?php endforeach ?>
                       </tbody>
                   </table>
                </div>
            </div>
        </section>
    </div>
    <?php include '../components/footer.php' ?>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="../jQuery-Plugin-For-Animated-Stackable-Toast-Messages-Toast/src/jquery.toast.js"></script>
    <script>
        
        var csrfToken = '<?php echo $csrfToken; ?>';
        $('.update-role').change(function() {
            console.log(csrfToken)
            var userId = $(this).data('user-id');
            var newRole = $(this).val();

            // AJAX request to update user role
            $.ajax({
                type: 'POST',
                url: '../process/updateUserRole.php', 
                data: { userId: userId, newRole: newRole,csrf_token: csrfToken },
                headers: { 'X-CSRF-Token': csrfToken },
                success: function(response) {
                    $.toast({
                        heading: 'Success',
                        text: 'User role berhasil diubah',
                        position: 'top-right',
                        showHideTransition: 'fade',
                        icon: 'success'
                    })
                    
                },
                error: function(error) {
                    $.toast({
                        heading: 'Fail',
                        text: 'User role gagal diubah',
                        showHideTransition: 'slide',
                        icon: 'danger',
                    })
                    console.error('Error updating role:', error);
                }
            });
        });

        function deleteUser(userId) {
        // AJAX request to delete user
            $.ajax({
                type: 'POST',
                url: '../process/deleteUser.php',
                data: { userId: userId, csrf_token: csrfToken },
                headers: { 'X-CSRF-Token': csrfToken },
                success: function(response) {
                    var rowToDelete = $('#user-row-' + userId);

                    // Hide the row
                    rowToDelete.hide();
                    $.toast({
                        heading: 'Success',
                        text: 'User berhasil di hapus',
                        position: 'top-right',
                        showHideTransition: 'fade',
                        icon: 'success'
                    })
                },
                error: function(error) {
                    // Handle the error response
                    $.toast({
                        heading: 'fail',
                        text: 'user gagal dihapus ',
                        position: 'top-right',
                        showHideTransition: 'fade',
                        icon: 'danger'
                    })
                    console.error('Error deleting user:', error);
                }
            });
        }

        // role setting ajax
        $('.role-settings').change(function() {
            console.log(csrfToken)
            var roleId = $(this).data('role-id');
            var roleRow = $(this).val();

            // AJAX request to update user role
            $.ajax({
                type: 'POST',
                url: '../process/updateUserRoleSetting.php', 
                data: { roleId: roleId, roleRow: roleRow,csrf_token: csrfToken },
                headers: { 'X-CSRF-Token': csrfToken },
                success: function(response) {
                    $.toast({
                        heading: 'Success',
                        text: 'role setting berhasil diubah',
                        position: 'top-right',
                        showHideTransition: 'fade',
                        icon: 'success'
                    })
                },
                error: function(error) {
                    $.toast({
                        heading: 'Error',
                        text: `Role setting gagal diubah err: ${error}`,
                        position: 'top-right',
                        showHideTransition: 'fade',
                        icon: 'danger'
                    })
                    console.error('Error updating role:', error);
                }
            });
        });

    </script>
    
</body>
</html>