<?php
    session_start();
if(isset($_SESSION['email'])){
  header('location:index.php');
}
    $conn= new mysqli('localhost','root','','jdp') or die($conn->error);

   if(isset($_POST['login'])){
       $email = $_POST['email'];
       $password =md5($_POST['pass']);

       $result = $conn->query("SELECT * FROM user WHERE email='$email' AND password='$password'") or die($conn->error);
       if($result->num_rows > 0){
           $row = $result->fetch_assoc();
           $_SESSION['email'] = $row['email'];
           header('location:index.php');
       }
       else{
        echo "<script>alert('oops Incorrect email or password!')</script>";
       }
   }

?>