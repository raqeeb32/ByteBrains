<!-- session start -->
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
        <title>login form</title> 
        <script src="js/jquery.min.js"></script>
        <script src="js/ajaxrequest.js"></script> 
        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
                <!-- CSS -->
    <link rel="stylesheet" href="css/loginAndSignup.css">
                        
    </head>
    <body>
        <section class="container forms">
            <div class="form login">
                <div class="form-content">
                    <header>Login</header>
            
                    <form action="#" method="post">
                        <div class="field input-field">
                            <input type="email" name="email" id="stuLogEmail" placeholder="Email" class="input" autocomplete="current-email">
                        </div>

                        <div class="field input-field">
                            <input type="password" name="password" id="stuLogpass" placeholder="Password" class="password" autocomplete="current-password">
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="form-link">
                            <a href="#" class="forgot-pass">Forgot password?</a>
                        </div>

                        <div class="field button-field">
                            <button name="loginBTN" id="loginBTN">Login</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Don't have an account? <a href="#" class="link signup-link">Signup</a></span>
                    </div>
                </div>         

            </div>

            <!-- Signup Form -->

            <div class="form signup"class="stuRegForm">
                <div class="form-content"class="stuRegForm">
                    <header> Student Signup</header>
                    <form action="#" method="POST"class="stuRegForm" >
                    
                        <div class="field input-field">
                        <input type="text" id="stuname" placeholder="Username" class="input"> 
                        </div>
                        <small id="statusMsq1"></small>
                        <div class="field input-field">
                            <input type="email" id="stuemail" placeholder="Email" class="input" autocomplete="username">
                        </div>  
                        <small id="statusMsq2"></small>            
                       
                        <div class="field input-field">
                            <input type="password" id="stupass" placeholder="Create password" class="password" autocomplete="current-password">
                        </div>
                        <!---added--->
                        <div class="field input-field">
                              <input type="password" id="stuconfirmpass" placeholder="Confirm password" class="password" autocomplete="off">
                        </div>
                        <small id="statusMsq4"></small>
                        
                        <small id="statusMsq3"></small>
                        <div class="field button-field">
                            <button type="submit" id="signupbtn">Signup</button>

                        </div>
                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                    </div>
                    <div class="form-link">
                        <span><a href="instructorSignup.php" class="instructor-link">Become a instructor on SkillyEarn</a></span>
                    </div>
                </div>
            </div>
          
        </section>

        <!-- JavaScript -->
       
        <script src="js/loginAndSignup.js"></script>
    </body>
</html>
<?php
include_once("inc/db_con.php");
function authenticateUser($email, $password, $conn) {
    $check_log = $conn->prepare("SELECT * FROM instructor WHERE email=:em AND password=:pwd");
    $check_log->bindParam(':em', $email);
    $check_log->bindParam(':pwd', $password);
    $check_log->execute();
    $row=$check_log->fetch(PDO::FETCH_ASSOC);
    $count = $check_log->rowCount();

    if ($count > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['instlogin'] = true;
        $_SESSION['isLogin'] = true;
        $_SESSION['inst_id']=$row['id'];
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['loginBTN']) && isset($_POST['email']) && isset($_POST['password']) && $_POST['email'] != '' && $_POST['password'] != '') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (authenticateUser($email, $password, $conn)) {
        header('location:instructor/index.php');//instructor dashboard
        exit();
    } else {
        $check_log = $conn->prepare("SELECT * FROM student WHERE stu_email=:em AND stu_pass=:pwd");
        $check_log->bindParam(':em', $email);
        $check_log->bindParam(':pwd', $password);
        $check_log->execute();
        $row=$check_log->fetch(PDO::FETCH_ASSOC);
        $count = $check_log->rowCount();

        if ($count == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['stuLogin'] = true;
            $_SESSION['stu_id']=$row['stu_id'];
            $_SESSION['isLogin'] = true;
            header('location:index.php');
            exit();
        } else {
                echo '<script> alert("Invalid details"); </script>';
            // $error_message = 'Invalid details';
            exit();
        }
    }
}
 ?>






