<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../dashboard/dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Splash | Sign Up or Login</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">
      <link rel="icon" href="../images/icons/logo.png" type="image/x-icon">
  
</head>

<body>
    

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
    crossorigin="anonymous">

<div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="./register.php" method="post">
                <h1>Create Account</h1>
                <span>Sign Up with your email and password</span>
                <input type="text" placeholder="Username" name="username"/>
                <input type="email" placeholder="Email" name="email"/>
                <input type="password" placeholder="Password" name="password"/>
                <input type="password" placeholder="Confirm Password" name="confirm_password"/>
                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="./login.php" method="post">
                <h1>Sign in</h1>
                <span>or use your account</span>
                <input type="email" placeholder="Email" name="email"/>
                <input type="password" placeholder="Password" name="password"/>
                <a href="#">Forgot your password?</a>
                <button>Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <img src="icon.png" alt="Splash Icon">
                    <h1>Welcome Back!</h1>
                    <p>Login with your personal details on Splash!</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <img src="icon.png" alt="Splash Icon">
                    <h1>Hello, Friend!</h1>
                    <p>Sign Up to explore the world of Splash!</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
  
  

    <script  src="js/index.js"></script>




</body>

</html>
