<?php
if (isset($_POST['signup-submit'])) {
  $username = $_POST['signup-username'];
  $email = $_POST['signup-email'];
  $password = $_POST['signup-password'];
  $passwordRepeat = $_POST['signup-repeat-password'];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';


  if (emptyInputSignup($username, $email, $password, $passwordRepeat) !== false) {
    header("location: ../index.php?error=emptyinput");
    echo "<script> openSignupForm(); </script>";
    exit();
  }

  if (invalidUsername($username) !== false) {
    header("location: ../index.php?error=invalidusername");
    echo "openSignupForm();";
    exit();
  }

  if (invalidEmail($email) !== false) {
    header("location: ../index.php?error=invalidemail");
    echo "openSignupForm();";
    exit();
  }

  if (passwordMatch($password, $passwordRepeat) !== false) {
    header("location: ../index.php?error=passwordsdontmatch");
    echo "openSignupForm();";
    exit();
  }

  if (usernameExists($conn, $username) !== false) {
    header("location: ../index.php?error=usernametaken");
    echo "openSignupForm();";
    exit();
  }

  if (emailExists($conn, $email) !== false) {
    header("location: ../index.php?error=emailtaken");
    echo "openSignupForm();";
    exit();
  }

 

  createUser($conn, $username, $email, $password);
} else {
  header("location: ../index.php");
}


$sql = "INSERT INTO `users`(`username`, `email`, `password`) VALUES ('[{$username}]','{$email}','{$hashedPassword}')";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "<p class=\"error-msg\">هذا البريد مستخدم من حساب آخر. حاول مرة أخرى.</p>";
}
$conn->close();
