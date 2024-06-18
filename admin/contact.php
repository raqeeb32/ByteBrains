<?php if(!isset($_SESSION)){
    session_start();
 }
 if(isset($_SESSION['adminLogin'])){
    include_once("inc/db_con.php")
    ?>
<div id="bodyRight">
        <h3> Contact us page</h3>
        <div class="con">          
            <?php echo contact(); ?>
        </div>

</div>
<?php }?>