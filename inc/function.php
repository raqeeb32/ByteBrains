<?php

function courses_cat (){
    include("inc/db_con.php");
    $get_cat=$conn->prepare("SELECT * FROM categories");
    $get_cat->setFetchMode(PDO::FETCH_ASSOC);
    $get_cat->execute();
    while($row=$get_cat->fetch(PDO::FETCH_ASSOC)){
    echo " <li><a href='#'>".$row['cat_icon']." ".$row['categoryName']."</a></li>";
    }
}
?>
