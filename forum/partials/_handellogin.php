<?php

$showalert="false";
if($_SERVER["REQUEST_METHOD"] =="POST"){
    include '_dbconnect.php';
    $email=$_POST['loginemail'];
    $pass=$_POST['loginpassword'];
    
    $sql="SELECT * FROM `username` WHERE `username` LIKE '$email'";
    $result=mysqli_query($conn,$sql);
    $numrow=mysqli_num_rows($result);
    if($numrow==1){
        $row=mysqli_fetch_assoc($result);
            if(password_verify($pass,$row['pass'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$email;
            $_SESSION['sno']=$row['sno'];
        
          
            }
          
            header("location:/forum/index.php");
            

        }
        header("location:/forum/index.php");

    }


?>