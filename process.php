<?php 
    session_start();
    if(!isset($_SESSION['email'])){
      header('location:login.php');
    }

    $conn = new mysqli('localhost','root','','jdp') or die($conn->error);
    $id= 0;
    $update = false;
    $name ='';
    $email ='';
    $requ ='';
    $JFL ='';
    $date ='';

    if (isset($_POST['submit'])) {
        $Cname = $_POST['Cname'];
        $Cemail = $_POST['Cemail'];
        $Cjfl = $_POST['JFL'];
        $Crequirement = $_POST['Crequirement'];
        $Cdate = $_POST['Cdate'];

        $conn->query("INSERT INTO jobdetails (Cname,Cemail,JFL,Crequirement,date) VALUES('$Cname','$Cemail','$Cjfl','$Crequirement','$Cdate')") 
        or die($conn->error);
        
        $_SESSION['message']="JOB added Successfully";
        $_SESSION['msg_type'] = "success";

        header('location:index.php');
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete']; 

        $conn->query("DELETE FROM jobdetails WHERE id=$id") or die($conn->error);
       
        $_SESSION['message']="Record Deleted";
        $_SESSION['msg_type'] = "danger";
        header('location:index.php');
        
    }

    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $result = $conn->query("SELECT * FROM jobdetails WHERE id= $id") or die($conn->error);
        if($result->num_rows >0){
            $row = $result->fetch_array();
            $name = $row['Cname'];
            $email = $row['Cemail'];
            $JFL = $row['JFL'];
            $requ = $row['Crequirement'];
            $date = $row['date'];
        }
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $name = $_POST['Cname'];
        $email = $_POST['Cemail'];
        $jfl = $_POST['JFL'];
        $requirement = $_POST['Crequirement'];
        $Cdate = $_POST['Cdate'];
        $conn->query("UPDATE jobdetails SET Cname='$name', Cemail='$email',JFL='$jfl',Crequirement='$requirement',date='$Cdate' WHERE id=$id") or die($conn->error);
        
        $_SESSION['message']="Job Details Updated";
        $_SESSION['msg_type'] = "warning";

        header('location: index.php');
    }
?>