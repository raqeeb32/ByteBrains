<?php
include("instructor/addinstructor.php");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>login form</title> 
        <!-- <script src="js/jquery.min.js"></script> -->
        <!-- <script src="js/instructorajaxrequest.js"></script>  -->
        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
                <!-- CSS -->
    <link rel="stylesheet" href="css/loginAndSignup.css">
                        
    </head>
    <body>
        <section class="container forms">
            <!-- instructor signup form -->
            <div class="form">
                <div class="form-content">
                    <header> Insructor  Signup</header>
                    <form action="#" method="POST" >
                        <small id="statusMsq1"></small>
                        <div class="field input-field">
                        <input type="text" placeholder="Username" name="insName" id="instructor_name" class="input"> 
                        </div>
                        <small id="statusMsq2"></small>
                        <div class="field input-field">
                            <input type="email"placeholder="Email" name="insEmail" id="instructor_email"class="input" autocomplete="username">
                        </div>  
                        <small id="statusMsq3"></small>
                        <div class="field input-field">
                            <input type="password"  placeholder="Create password" name="insPass" id="instructor_pass" class="password" autocomplete="current-password">
                        </div>
                        <div class="field button-field">
                            <button id="ins-btn" name="ins-btn">Signup</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="loginAndSignup.php" class="link login-link">Login</a></span>
                    </div>
                </div>
            </div>
        </section>

</body>
</html>
<?php
if(isset($_POST['ins-btn'])){
    addinst();
}
?>