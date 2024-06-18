<?php
if(!isset($_SESSION)){
    session_start();
 }
 if(isset($_SESSION['instlogin'])){
    include_once("inc/db_con.php")
    ?>
<div class="right">
    short cards will be displayed here
</div>
<?php
}
else{
    header("location:../index.php");
}
?>