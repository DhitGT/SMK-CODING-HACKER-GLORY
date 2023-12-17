<?php 
    session_start();
    include '../function.php';
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordVerif = $_POST['passwordVerif'];
    
    if(mysqli_num_rows(getUserByEmail($email))){
        $_SESSION['info'] ="Email sudah di gunakan";
         header("location:../register");
    }else{
        if(strlen($password) < 8){
                
            $_SESSION['info'] = "Password harus lebih dari 7 karakter";
            header("location:../register");
        }else{
            if($password != $passwordVerif){
                $_SESSION['info'] = "Password Verify tidak sama";
                header('location:../register');
            }else{
                if(createUser($name,$email,$password)){
                    $_SESSION['info'] = 'akun berhasil dibuat';
                    header('location:../login');
                }
            }
        }
    }



?>