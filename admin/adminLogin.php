<?php
 if(!isset($_SESSION)){
    session_start();
 }
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin login form</title> 
        <!-- <script src="js/jquery.min.js"></script> -->
        <!-- <script src="js/ajaxrequest.js"></script>  -->
        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
                <!-- CSS -->
    <link rel="stylesheet" href="../css/loginAndSignup.css">
                        
    </head>
    <body>
        <section class="container forms">
            <div class="form login">
                <div class="form-content">
                    <header> Admin Login</header>
            
                    <form action="#" method="post">
                        <div class="field input-field">
                            <input type="email" name="adminEmail" placeholder="Email" class="input" autocomplete="current-email">
                        </div>

                        <div class="field input-field">
                            <input type="password" name="adminPassword" placeholder="Password" class="password" autocomplete="current-password">
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="form-link">
                            <a href="#" class="forgot-pass">Forgot password?</a>
                        </div>

                        <div class="field button-field">
                            <button name="adminLoginBTN">Login</button>
                </div>
            </form>
             </div>
        </div>
    </section>
  </body>
</html>
<?php
include("inc/db_con.php");
if(isset($_POST['adminLoginBTN'])){
if(!empty($_POST['adminEmail']) && !empty($_POST['adminPassword'])){
    $adminEmail=$_POST['adminEmail'];
    $adminPassword=$_POST['adminPassword'];

    $check_log = $conn->prepare("SELECT * FROM admin WHERE email=:em AND password=:pwd");
    $check_log->bindParam(':em', $adminEmail);
    $check_log->bindParam(':pwd', $adminPassword);
    $check_log->execute();
    $count = $check_log->rowCount();
    if($count == 1){
        $_SESSION['adminEmail']=$adminEmail;
        $_SESSION['adminPassword']=$adminPassword;
        $_SESSION['adminLogin']=true;
        header('location:index.php');
        exit();
    }
    else{
        echo'<script> alert("Invalid details"); </script>';
        echo"<script>window.location.href ='adminLogin.php';</script>";
        
    }
}
}
?>
                