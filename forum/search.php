<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disus coding form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            .container{
                min-height: 100vh;
            }
            </style>
</head>

<body>
<?php  include 'partials/_dbconnect.php';?>
    <?php
     include 'partials/_header.php';
     ?>
  


<div class="container" >
    <h1 class="ps-3">Search result for<em> "<?php echo $_GET['search']?>"</em></h1>
    
    <?php
    $noresult=true;
         $s=$_GET['search'];
         $sql="SELECT * FROM threads WHERE MATCH (threads_title,threads_desc) against('$s')";
         $result=mysqli_query($conn,$sql);
         while($row=mysqli_fetch_assoc($result)){
        
             $title=$row['threads_title'];
             $desc=$row['threads_desc'];
             $threads_cat_id=$row['threads_cat_user'];
             $threads_id=$row['threads_id'];
             $url="thread.php?threadid=".$threads_id;
             $noresult=false;
            echo '<div class="search">
        <h3><a href="'.$url.'" class="text-dark">'.$title.'</a>
        </h3>
        <p> '.$desc.'</p>
    </div>';
    
         }  
         if($noresult){
         echo'   <div class="container py-2 " id="ques">
      
         <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4"> NO result found</h1>
    <p class="lead"> correct your speeling</p>
    <p class="lead"> does not exit</p>

  </div>
</div>';
  
         }
 ?>
  
 </div>

    <?php
    include 'partials/_fotter.php';
    
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>