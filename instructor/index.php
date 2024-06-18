<?php if(!isset($_SESSION)){
    session_start();
 }?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>instructor</title>
    <link rel="stylesheet" href="css/style.css">
   
    <script src="https://kit.fontawesome.com/c25eb3470e.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="container"><?php
    if(isset($_SESSION['instlogin'])){
        include('inc/header.php');
        include('inc/left.php');
        include('inc/right.php'); 
    }
    else{
        header('location:../index.php');
        exit();
    }
  ?>
    </div>
   
   
</body>
</html>