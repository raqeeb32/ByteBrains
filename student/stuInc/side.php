<div class="left" >
    <ul class="nav-links">
        <li><a href="index.php?my_profile"><i class="fa-solid fa-gauge"></i><span class="link-name">My profile</span></a></li>
        <li><a href="index.php?my_courses"><i class="fa-solid fa-bookmark"></i><span class="link-name">My Courses</span></a></li>
        <li><a href="index.php?feedback"><i class="fa-solid fa-book"></i><span class="link-name">Feedback</span></a></li>
        <li><a href="../logout.php"><i class="fa-solid fa-right-from-bracket"></i><span class="link-name">Logout</span></a></li>
    </ul>
</div>
<?php
if(isset($_GET['my_courses'])){
    include_once('my_courses.php');
}
if(isset($_GET['feedback'])){
    include_once('stu_feedback.php');
}

?>