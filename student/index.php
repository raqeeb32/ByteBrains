<?php
 if(!isset($_SESSION)){
    session_start();
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel</title>
    <link rel="stylesheet" href="css/style.css">
    
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <!-- <script src="https://kit.fontawesome.com/c25eb3470e.js" crossorigin="anonymous"></script> -->
     <link rel="stylesheet" href="css/style.css">
</head>
<body>
       <?php
  if( $_SESSION['stuLogin']){
    include("stuinc/header.php");
    include("stuinc/side.php");
    include("stuinc/my_profile.php");
  }

   else{
    header("location:../index.php");
   }
       ?>
</body>
</html>
