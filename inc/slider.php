<?php
 if(!isset($_SESSION)){
    session_start();
 }
 ?>
<main> 
<div class="hero">
      <div class="hero-title">
        <h1>Build Skills with online courses</h1>
      </div>
      <div class="hero-desc">
        <p>
          We denounce with righteous indignation and dislike men who are so
          beguiled and demoralized that cannot trouble.
        </p>
      </div>
      <?php
      if(isset($_SESSION['isLogin'])){
        if(isset($_SESSION['instlogin'])){
        echo'<button class="h-btn btn"><a href="instructor/index.php">My profile</a></button>';
        }
        elseif(isset($_SESSION['adminLogin'])){
          echo'<button class="h-btn btn"><a href="admin/index.php">My profile</a></button>';
        }
        else{
          echo'<button class="h-btn btn"><a href="student/index.php">My profile</a></button>';
        }
      }
      else{
      echo'  <button class="h-btn btn"><a href="loginAndSignup.php">Get started</a></button>';
      }
      ?>

    </div>
</main>
   