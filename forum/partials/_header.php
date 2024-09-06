<?php
session_start();

include "_dbconnect.php";

echo'<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/forum">idiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">about</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top categories
        </a>
        <ul class="dropdown-menu">';
        $sql="SELECT  category_name , category_id FROM `categoris`  LIMIT 3";
        
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
        echo'  <a class="dropdown-item" href="/forum/threads.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a>';
          
        }  
       echo ' </ul>
        <li class="nav-item">
        <a class="nav-link" href="contact.php">conctact</a>
      </li>
    </ul>';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  
    
   echo' <form class="d-flex" role="search" action="search.php" method="get">
      <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
  <p class="text-light my-0 mx-2"> welcome'.$_SESSION['username'].'</p>
  <a href="partials/_logout.php" class="btn btn-outline-success ml-2 ">logout</a>

      </form>';
    }
    else{
   echo' 
   <form class="d-flex" role="search" action="search.php" method="get">
      <input class="form-control me-2"  name="search " type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <div class="mx-4">
    <button class="btn btn-outline-success ml-2 " data-bs-toggle="modal" data-bs-target="#loginModal">login</button>
    <button class="btn btn-outline-success"data-bs-toggle="modal" data-bs-target="#singupModal">singup</button>
 
    '; } 
    echo' 
      </div>
</div>
</div>
</nav>';
include 'partials/_login.php';
include 'partials/_singup.php';
if(isset($_GET['singupsuccess'] ) && $_GET['singupsuccess']=="true"){
  echo'<div id="liveAlertPlaceholder"><div></div><div></div><div></div><div><div class="alert alert-success alert-dismissible my-0" role="alert">   <div> you can login</div>   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div></div></div>';
}




?>