<?php
    session_start();
    if(isset($_SESSION['email'])){
      header('location:login.php');
    }
    $conn= new mysqli('localhost','root','','jdp') or die($conn->error);


    if(isset($_POST['register'])){
        $username = $_POST['name'];
        $email = $_POST['email'];
        $password = md5($_POST['pass']);
        $cpassword =md5($_POST['cpass']);

        if($password == $cpassword){
            $dupp = $conn->query("SELECT * FROM user WHERE email='$email'") or die($conn->error);
            if(!$dupp->num_rows >0){
                $dupp2 = $conn->query("SELECT * FROM user WHERE username='$username'") or die($conn->error);
                if(!$dupp2->num_rows > 0){
                                $result = $conn->query("INSERT INTO user (username,email,password) 
                                VALUES('$username','$email','$password')") or die($conn->error);
                                if($result){
                                    echo "<script>alert('WOW! Registration completed')</script>";
                                    $username = '';
                                    $email = '';
                                    $_POST['password'] = '';
                                    $_POST['cpassword'] = '';
                                    }
                                else{
                                    echo "<script>alert('oops something wrong! please try again')</script>";
                                } 
                }
                else{
                    echo "<script>alert('There is already an user with same username')</script>"; 
                }
                 
            }
            else{
                echo "<script>alert('There is already an user with same email')</script>"; 
            }
        }
        else{
            echo "<script>alert('Password not Matched')</script>";
        }
        
    }
?>