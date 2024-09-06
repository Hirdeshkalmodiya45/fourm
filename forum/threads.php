<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disus coding form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
</head>

<body>
<?php  include 'partials/_dbconnect.php';?>
    <?php
    include 'partials/_header.php';?>
  


    <?php
     $id=$_GET['catid'];
    $sql="SELECT * FROM `categoris` WHERE category_id=$id";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
    $id=  $row['category_id'];
   $catename=$row['category_name'];
   $catedesc=$row['category_descruption'];
   

    }
     ?>
     <?php
     $showalert=false;
     $method=$_SERVER['REQUEST_METHOD'];
     if( $method=='POST'){
        $th_title=$_POST['title'];
        $th_desc=$_POST['desc'];
        $th_title = str_replace("<", "&lt",$comment);
        $th_title = str_replace(">",  "&gt",$comment);
        $th_desc = str_replace("<", "&lt",$comment);
        $th_desc = str_replace(">",  "&gt",$comment);
        $sno=$_POST['sno'];

        $sql="INSERT INTO `threads` ( `threads_title`, `threads_desc`, `threads_cat_id`, `threads_cat_user`, `timestamp`) VALUES ( '$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        $showalert=true;
        if($showalert){
            echo '  <div id="liveAlertPlaceholder"><div></div><div></div><div></div><div><div class="alert alert-success alert-dismissible" role="alert">   <div>  your threads be added please  wait for response<</div>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div></div>
           ';
           
        }


     }
     ?>
    <div class="container my-4 "   >


        <!-- Jumbotron -->


        <div class="jumbotron bg-#dbd8e3  ps-10;" style="
    position: relative;
   
 
    padding: 1rem;
    margin: 1rem -15px 0;
    border: solid #f7f7f9;
    border-width: .2rem 0 0;">
            <h1 class="display-4">welcome to <?php echo $catename?> forum</h1>
            <p class="lead">
            <p> <?php echo $catedesc?></p>
            </p>
            <hr class="my-4">
            <p>Be respectful, even when theres a disagreement.
                No foul language or discriminatory comments.
                No spam or self-promotion.
                No links to external websites or companies.
                No NSFW (not safe for work) content.</p>
            <p><b>posted by hirdesh</b></p>
            <hr class="my-4">
        </div>

    </div>
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo'
    <div class="container">
        <h1 class="py-2">start a discussion</h1>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">problem title</label>
                <input type="text" class="form-control" id="title" name="title">
                <div id="emailHelp" class="form-text">keep your title as crisp and short as posssible</div>

            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Eleborate your concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                <input type="hidden" name="sno" class="sno" value="'.$_SESSION["sno"].'">
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';}
    else{
        echo' 
        <h1 class="py-2">start a discussion</h1>
        <div class="container"> <p class=" plead ">you are not loggedin please login to be able to start a discussion.</p> </div>';
    }
    ?>
    <div class="container py-2 " id="ques">
        <h1> browse ouestion</h1>
        <?php 
    $id=$_GET['catid'];
    $sql="SELECT * FROM `threads` WHERE `threads_cat_id`=$id";
$result=mysqli_query($conn,$sql);
$nosresult=true;
while($row=mysqli_fetch_assoc($result))
{
    $nosresult=false;
$id=$row['threads_id'];

$title=$row['threads_title'];
$desc=$row['threads_desc'];
$time=$row['timestamp'];
$threads_user_id=$row['threads_cat_user'];


$sql2="SELECT username FROM `username` WHERE sno=$threads_user_id";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);




echo'
        <div class="media my-3 d-flex">
            <img src="partials/user.png" width="50px" class="mr-3 " alt="...">
            <div class="media-body  ps-3 ml-2">
            <p class="fw-bold my-0">'.$row2['username'].' at'. $time.' </p>
                <h5 class="mt-0 "><a class="text-dark" href="thread.php?threadid='.$id.'">'.$title.'</a></h5>
                '.$desc.'
            </div>
        </div>';
}
//echo var_dump($nosresult);
if($nosresult){
   echo' <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">NO Result found</h1>
    <p class="lead">Be the first person to ask a ouestion.</p>
  </div>
</div>
  ';
}
?>


    </div>



    <!-- Jumbotron -->
    <?php
    include 'partials/_fotter.php';
    
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>