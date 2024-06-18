<div id="bodyLeft">
    <h3><i class="fa-solid fa-border-all"></i>  Content management</h3>
    <ul>
        <li><a href=""> Dashboard</a></li>
        <li><a href="index.php?vcat"> View categories</a></li>
        <li><a href="index.php?sub_cat">  View Sub categories</a></li>
        <li><a href="index.php?lang"> View languages</a></li>
    </ul>
     <h3><i class="fa-regular fa-file"></i> Course management</h3>
    <ul>
        <li><a href="index.php?courses">Active courses</a></li>
        <li><a href="">unpublished courses</a></li>
    </ul>
    <h3><i class="fa-solid fa-user"></i>User management</h3>
    <ul>
        <li><a href="index.php?students">Students</a></li>
        <li><a href="index.php?instructors">Teachers</a></li>
    </ul>
    <!-- <h3><i class="fa-solid fa-money-check"></i>Payment management</h3>
    <ul>
        <li><a href="">Pay to teachers</a></li>
        <li><a href="">Complete payments</a></li>
        <li><a href="">Search payment</a></li>
    </ul> -->
    <h3><i class="fa-solid fa-note-sticky"></i>Page management</h3>
    <ul>
        <li><a href="index.php?terms">Terms and conditions</a></li>
        <li><a href="index.php?contact">Contact us page</a></li>
        <li><a href="index.php?about">About us page</a></li>
        <li><a href="index.php?faqs">FAQs page</a></li>
        <li><a href="">Edit slider</a></li>     
    </ul>
    
</div>
<?php
    if(isset($_GET['vcat'])){
        include("vcat.php");
    }
    if(isset($_GET['lang'])){
        include("lang.php");
    }
    if(isset($_GET['sub_cat'])){
        include("sub_cat.php");
    }
    if(isset($_GET['terms'])){
        include("terms.php");
    }
    if(isset($_GET['contact'])){
        include("contact.php");
    }
    if(isset($_GET['faqs'])){
        include("faqs.php");
    }
    if(isset($_GET['about'])){
        include("about.php");
    }
    if(isset($_GET['students'])){
        include("students.php");
    }
    if(isset($_GET['instructors'])){
        include("instructors.php");
    }
    if(isset($_GET['courses'])){
        include("vCourses.php");
    }
?>