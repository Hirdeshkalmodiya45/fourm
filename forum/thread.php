<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disus coding form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            #ques{
                min-height: 433px;
            }
            </style>
      </head>

<body>
    <?php
    include 'partials/_header.php';
    include 'partials/_dbconnect.php';

    ?>
      <?php
     $id=$_GET['threadid'];
    $sql="SELECT * FROM `threads` WHERE threads_id=$id";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
   
        $title=$row['threads_title'];
        $desc=$row['threads_desc'];
        $threads_cat_id=$row['threads_cat_user'];
        
$sql2="SELECT username FROM `username` WHERE sno=  $threads_cat_id";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);
$posted_by=$row2['username'];
    }
     ?> 
       <?php
     $showalert=false;
     //comment
     $method=$_SERVER['REQUEST_METHOD'];
     if( $method=='POST'){
        $comment=$_POST['comment'];
        $comment = str_replace("<", "&lt",$comment);
        $comment = str_replace(">",  "&gt",$comment);

        $sno=$_POST['sno'];

    
        $sql="INSERT INTO `comments` ( `comment_content`, `threads_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', '$sno', '2024-04-09 10:07:32.000000')";
        $result=mysqli_query($conn,$sql);
        $showalert=true;
        if($showalert){
            echo '  <div id="liveAlertPlaceholder"><div></div><div></div><div></div><div><div class="alert alert-success alert-dismissible" role="alert">   <div> Add your comment!</div>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div></div>
            ';
        }


     }
     ?>
  
   <div class="container my-4">


        <!-- Jumbotron -->


        <div class="jumbotron">
            <h1 class="display-4">welcome to <?php echo $title?> forum</h1>
            <p class="lead">
            <p> <?php echo $desc?></p>
            </p>
            <hr class="my-4">
            <p>Be respectful, even when theres a disagreement.
                No foul language or discriminatory comments.
                No spam or self-promotion.
                No links to external websites or companies.
                No NSFW (not safe for work) content.</p>
            <p class="lead">
            <p><b><?php echo $posted_by;?></b></p>
            </p>
        </div>
    </div>
  
    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    echo'
    <div class="container">
        <h1 class="py-2">Post of comment</h1>
        <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
      
        
            <div class="mb-3">
                <label for="desc" class="form-label">type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" class="sno" value="'.$_SESSION["sno"].'">
            </div>
            <button type="submit" class="btn btn-success">post</button>
        </form>
    </div>
    ';}
    else{
        echo'
        <div class="container"> 
        <h1 class="py-2">Post a comment</h1>
        <div class="container"> <p class=" plead ">you are not loggedin please login to be able to start post a comment.</p> </div>';
    }
    ?>


 
<div class="container py-2 " id="ques">
        <h1> Discussion</h1>
        <?php 
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `comments` WHERE `threads_id`=$id";
$result=mysqli_query($conn,$sql);
$nosresult=true;
while($row=mysqli_fetch_assoc($result))
{
    $nosresult=false;
$id=$row['comment_id'];

$content=$row['comment_content'];
$time=$row['comment_time'];
$comment_user_id=$row['comment_by'];


$sql2="SELECT username FROM `username` WHERE sno=$comment_user_id";
$result2=mysqli_query($conn,$sql2);
$row2=mysqli_fetch_assoc($result2);



echo'
        <div class="media  my-3 d-flex ">
            <img src="partials/user.png" width="50px" class="mr-100" alt="...">
           
            <div class=" ps-3 media-body ">
            <div class="fw-bold my-0">'.$row2['username'].''. $time.' </div>
                '. $content.'

            </div>
        </div>';
}
//echo var_dump($nosresult);
if($nosresult){
   echo' <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">NO comments  found</h1>
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