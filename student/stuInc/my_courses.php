<?php
if(!isset($_SESSION)){
session_start();
}
include("db_con.php");
// Check if session email is set
if(isset($_SESSION['stuLogin'])){?>
    <div class="right">
    <h3>My courses</h3>
</div>

<?php
}
else{
    echo "<script>window.open('index.php?my_courses','_self')</script>";  
  }

?>