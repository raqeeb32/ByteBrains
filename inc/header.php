<?php include("inc/function.php");?>
  <header>
    <a href="#" class="logo">ByteBrains</a>

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
        <li><a href="./about.php">About us</a></li>
      </ul>
    </nav> 
    <?php
    if(!isset($_SESSION)){
      session_start();
    }
 
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
