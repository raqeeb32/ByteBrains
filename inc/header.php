<?php include("inc/function.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <header>
    <a href="#" class="logo">SkillyEarn</a>

    <nav>
      <ul class="nav-links">
        <li><a href="./index.php">Home</a></li>
        <li id="menu"><a href="./courses.php">Courses</a>
     <?php include("inc/courses_cat.php");?>
        </li>
        <li>   
          <form method="post" enctype="multipart/form-data">
              <input type="search" class="search_inp" name="query" placeholder="Search courses here">
               <button name="search" class="search_btn">Go</button>
          </form>
         </li>
        <li><a href="#">About us</a></li>
        <li id="cart"><a href="#"><img src="images/cartI.png" id=cart-icon alt="cart image"> <span id="cart-count">0</span></a></li>
      </ul>
    </nav> 
    <?php
    session_start();
    if(isset($_SESSION['isLogin'])){
      echo '<div class="log-sign">
    <!-- <a href="loginAndSignup/index.html" class="log">Login</a>  -->
    <a href="logout.php"><button class="btn">Logout</button> </a>
    </div> ';
    }
    else{
      echo ' <div class="log-sign">
    <!-- <a href="loginAndSignup/index.html" class="log">Login</a>  -->
    <a href="loginAndSignup.php"><button class="btn">Signup</button> </a>
    </div> ';
    }
    ?>
   
   
  </header>
