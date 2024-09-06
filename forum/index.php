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
<?php  include 'partials/_dbconnect.php';?>
    <?php
     include 'partials/_header.php';
  

    ?>

    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/random/1920x700/?coding,coding" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/random/1920x700/?java,coding" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/random/1920x700/?c++,coding" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container md-3 my-4" id="ques">
        <h2 class="text-center"> wellcome to idiscuss-categerios</h2>
        <div class="row my-4">

<?php 
$sql="SELECT * FROM `categoris`";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_assoc($result)){
  $id=  $row['category_id'];
$cat=$row['category_name'];
$dec=$row['category_descruption'];

       echo '     <div class="col-md-4 my-2">
                <div class="card" style="width: 18rem;">
                    <img src="https://source.unsplash.com/random/1920x1080/?'.$cat.',coding" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><a herf="threads.php?catid='.$id.'">'.$cat.'</h5>
                        <p class="card-text">'.substr($dec,0,40).'...</p>
                        <a href="threads.php?catid='.$id.'" class="btn btn-primary">view threads</a>
                    </div>
                </div>
            </div>';
      }
      ?>

        </div>
    </div>
    <?php
    include 'partials/_fotter.php';
    
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>