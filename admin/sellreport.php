<?php
if(!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION["adminLogin"])){
    header('location:../loginAndSignup.php');
}
include_once("inc/db_con.php");
?>
<style>
    .sellreport{
        width:50%;
        margin-left: 400px;
    }
    .dates{
        display: flex;
        column-gap: 10rem;
    }
    h3{
        text-align: center;
    }
    table{
        width:70%;
        border:1px solid black;
    }
    table th{
        background-color: blue;
        color: white;
    }
</style>
<div class="bodyRight">
    <h3>Sell report</h3>
<div class="sellreport">
    <form action="#" method="post">
        <div class="dates">
        <div class="row">
          Start date:  <input type="date" name="startdate">
        </div>
        <div class="row">
          End date:  <input type="date" name="enddate">
        </div>
        </div>
       <button type="submit" name="submitReport">Submit</button>
    </form>
</div>
</div>
<?php
if(isset($_POST["submitReport"])) {
    $startdate = $_POST["startdate"];
    $enddate = $_POST["enddate"];
    $sql = $conn->prepare("SELECT * FROM enrollment WHERE purchase_time BETWEEN :startdate AND :enddate");
    $sql->bindParam(':startdate', $startdate);
    $sql->bindParam(':enddate', $enddate);
    $sql->execute();
    $rowCount = $sql->rowCount();
    
    if ($rowCount > 0) {
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        echo '<table>';
        echo'
        <tr>
        <th>course id</th>
        <th>course name</th>
        <th>course price</th>
        <th>student name</th>
        <th>staudent email</th>
        <th>purchse time</th>
        </tr>
        ';
        foreach ($results as $row) {
            $stu_id=$row["stu_id"];
            $course_id=$row["course_p_id"];
            $getstu= $conn->prepare("SELECT * FROM student WHERE stu_id=:stu_id");
            $getstu->bindParam(':stu_id', $stu_id);
            $getstu->execute();
            $stu=$getstu->fetch();

            $getcourse= $conn->prepare("SELECT * FROM course WHERE course_id=:course_id");
            $getcourse->bindParam(':course_id', $course_id);
            $getcourse->execute();
            $course=$getcourse->fetch();
            echo '<tr>';
            echo '<td>' . $row['course_p_id'] . '</td>'; 
            echo '<td>' . $course['course_name'] . '</td>'; 
            echo '<td> ₹' . $course['course_price'] . '</td>'; 
            echo '<td>' . $stu['stu_name'] . '</td>'; 
            echo '<td>' . $stu['stu_email'] . '</td>'; 
            echo '<td>' . $row['purchase_time'] . '</td>'; 
            echo '</tr>';
        }
        echo'<tr><td>
        <form><input type="submit" value="Print" onclick="window.print()"</form></td>
        </tr>';
        echo '</table>';
    } else {
        echo '<script>alert("No records found");</script>';
        echo "<script>window.open('index.php?sellreports','_self')</script>";

    }
}

?>
