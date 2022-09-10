<?php
$email = $_POST['login-email'];
$password = $_POST['login-password'];
if (isset($_POST['login-submit'])) {
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';


    if (emptyInputLogin($email, $password) !== false) {
        header("location: ../index.php?error=loginemptyinput");
        echo "<script> openLoginForm(); </script>";
        exit();
      }

      loginUser($conn, $email, $password);

    
}
