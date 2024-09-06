<?php
$showerror="false";
if($_SERVER['REQUEST_METHOD']=="POST")
{
    include '_dbconnect.php';
    $username =$_POST['singupemail'];
    $cpass =$_POST['cpassword'];
    $pass =$_POST['password'];
    
    //check wheter 
    $existsql="SELECT * FROM `username` WHERE `username` LIKE '$username'";
    $result=mysqli_query($conn,$existsql);
    $numrow=mysqli_num_rows($result);
    if($numrow>0)
    {
        $showerror="email is alerady use";
    }
    else{
        if($pass==$cpass){
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `username` (`username`, `pass`, `timestamp`) VALUES ('$username', '$hash', current_timestamp())";
            $result =mysqli_query($conn,$sql);
            if($result){
                $showalert=true;
            
               header("location:/forum/index.php?singupsuccess=true");
            exit();
            }

        }
         else{
            $showerror="does not match";
         
        }
    
   header("location:/forum/index.php?singupsuccess=false&error=$showerror");
    }
}
?>