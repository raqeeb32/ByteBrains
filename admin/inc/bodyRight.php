<?php
if(!isset($_GET['courses']) && !isset($_GET['instructors']) && !isset($_GET['students']) && !isset($_GET['vcat']) && !isset($_GET['sub_cat']) && !isset($_GET['lang']) && !isset($_GET['terms'])&& !isset($_GET['contact']) && !isset($_GET['faqs'])  && !isset($_GET['about'])){ ?>
<style>
     h3{
        background-color:black;
        color:white;
        margin-bottom: 1rem;
    }
</style>
<div id="bodyRight">
    <h3>Overview</h3>
    <div class="cardContainer">
    <a href="index.php?students">
        <div class="students C"> <span>Students</span> <?php echo numStudents(); ?></div>
    </a>
    <a href="index.php?instructors">
        <div class="students C"> <span>Instructors</span> <?php echo numInstructors(); ?></div>
    </a>    
</div>
<?php
}
?>
