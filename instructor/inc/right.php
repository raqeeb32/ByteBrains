<?php
if(!isset($_SESSION)){
    session_start();
 }
 if(isset($_SESSION['instlogin'])){
    include_once("inc/db_con.php");
 $id=$_SESSION["inst_id"];
if(!isset($_GET['chapters']) && !isset($_GET['courses']) && !isset($_GET['feedback']) && !isset($_GET['profile'])){
$get_courses=$conn->prepare("SELECT * FROM course WHERE ins_id=:id");
$get_courses->execute([':id' => $id]);
$num_courses = $get_courses->rowCount();
?>
<div class="right">
    <h2 style="text-align: center;">Overview</h2>
    <div class="Rcards">
        <a href="index.php?courses">
        <div class="Rcard">
        <span class="Rcard-head">Courses:</span>
        <span> <?php echo $num_courses; ?></span>
        </div>
        </a>
        <a href="index.php?courses">
        <div class="Rcard">
        <span class="Rcard-head">Revenew:</span>
        <span> 150 </span>
        </div>
        </a>
       
    </div>
</div>
 <?php
 }
 }
?>