<div class="left menu menu-items" >
    <ul class="nav-links">
        <li><a href="index.php?dashboard"><i class="fa-solid fa-gauge"></i><span class="link-name">Dashboard</span></a></li>
        <li><a href="index.php?courses"><i class="fa-solid fa-bookmark"></i><span class="link-name">Courses</span></a></li>
        <!-- <li><a href="index.php?chapters"><i class="fa-solid fa-book"></i><span class="link-name">Chapters</span></a></li> -->
        <li><a href="index.php?feedback"><i class="fa-solid fa-comment"></i><span class="link-name">Feedback</span></a></li>
        <li><a href="index.php?profile"><i class="fa-solid fa-user"></i><span class="link-name">Profile</span></a></li>
        <li><a href="#"><i class="fa-solid fa-right-from-bracket"></i><span class="link-name">Logout</span></a></li>
    </ul>
</div>
<?php
if(isset($_GET['dashboard'])){
    include_once('dashboard.php');
}
if(isset($_GET['courses'])){
    include_once('courses.php');
}
// if(isset($_GET['chapters'])){
//     include_once('chapters.php');
// }
?>