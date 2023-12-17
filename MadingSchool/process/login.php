
<?php 
    session_start();
    include "../function.php";
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $data = mysqli_fetch_assoc(getUserByEmail($email));
    if(!$data){
        $_SESSION['info'] = "Email tidak di temukan";
         header("location:../login");
    }else{
      
        if(password_verify($password,$data['password'])){
            $_SESSION['login'] = $data['email'];
            if($data['role'] === 'admin'){
                 header('location:../dashboard');
            }else{
                 header('location:../index.php');

            }
        }else{
            $_SESSION['info'] = "Password salah";
            header('location:../login');
        }
    }

?>
