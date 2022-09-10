<!DOCTYPE html>
<?php session_start(); ?>
<html lang="ar" dir="rtl">
<!-- <head> -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>باحث الجلوتين</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/starability-basic.css">
    <link rel="icon" href="images/logo.svg" sizes="any" type="image/svg+xml">

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/script.js"></script>
    <script src="https://kit.fontawesome.com/b9fa133a8f.js" crossorigin="anonymous"></script>
</head>
<header id="header">
    <nav class="navbar" id="nav-bar">
        <!-- logo without the dot <svg width="21" height="31" viewBox="0 0 21 31" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M20.5 11.1067C20.5 16.9914 15.9968 21.7133 10.5 21.7133C5.00324 21.7133 0.5 16.9914 0.5 11.1067C0.5 5.22193 5.00324 0.5 10.5 0.5C15.9968 0.5 20.5 5.22193 20.5 11.1067Z" fill="white" stroke="white"/>
<path d="M17.7268 18.7933L10.5 29.178L3.27318 18.7933H17.7268Z" fill="white" stroke="white"/>
</svg> -->
<a class="nav-branding" href="index.php"><svg width="22" height="29" viewBox="0 0 22 29" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21.1825 10.8394C21.1825 16.5588 16.5483 21.1499 10.8912 21.1499C5.23419 21.1499 0.599998 16.5588 0.599998 10.8394C0.599998 5.12011 5.23419 0.528992 10.8912 0.528992C16.5483 0.528992 21.1825 5.12011 21.1825 10.8394Z" fill="white" stroke="white"/>
<path d="M18.6876 17.4749L10.8913 28L3.09485 17.4749H18.6876Z" fill="white" stroke="white"/>
<circle cx="11.0862" cy="11.0428" r="4.87275" fill="black" fill-opacity="1"/>
</svg>
</a>
        <ul class="nav-menu">
            <li class="nav-item"><a class="nav-link" href="index.php">الصفحة الرئيسية</a></li>
            <li class="nav-item"><a class="nav-link" href="who-we-are.php">من نحن</a></li>
            <!-- <li class="nav-item"><a href="#">تواصل معنا</a></li> -->
            <?php
            if (isset($_SESSION['isLoggedInToGFWebsite.com'])) {
                echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"includes/logout.inc.php\">تسجيل خروج</a></li>";
            } else {
                echo "<li class=\"nav-item\"><a class=\"nav-link\" class=\"open-signup-form\" onclick=\"openLoginForm()\" style=\"cursor: pointer;\">الدخول/التسجيل</a>
                </li>";
            }
            ?>
        </ul>

        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar "></span>
        </div>
    </nav>
</header>
<div id="signin-overlay" class="overlay">
    <span class="close-button" onclick="closeLoginForm()" title="Close Overlay">&#215</span>
    <div class="wrap">
        <h2 class="center-h2">تسجيل دخول</h2>
        <form class="signup-form" action="includes/login.inc.php" method="POST">
            <input type="text" id="login-email" name="login-email" placeholder="البريد الإلكتروني">
            <input type="password" id="login-password" name="login-password" placeholder="كلمة المرور">
            <p id="msg-box-login" class="error-msg"></p>
            <input type="submit" name="login-submit" class="sign-btn" value="تسجيل دخول">
            <div> أو <a class="switch-signup-button" onclick="openSignupForm(); closeLoginForm()">إنشاء حساب</a> </div>
        </form>
    </div>
</div>

<div id="signup-overlay" class="overlay">
    <span class="close-button" onclick="closeSignupForm()" title="Close Overlay">&#215</span>
    <div class="wrap">
        <h2 class="center-h2">إنشاء حساب جديد</h2>
        <form class="signup-form" action="includes/signup.inc.php" method="POST">
            <input type="text" id="signup-username" name="signup-username" placeholder="الاسم">
            <input type="email" id="signup-email" name="signup-email" placeholder="البريد الإلكتروني">
            <input type="password" id="signup-password" name="signup-password" placeholder="كلمة المرور">
            <input type="password" id="signup-repeat-password" name="signup-repeat-password" placeholder="تأكيد كلمة المرور">
            <br>
            <p id="error-msg" class="error-msg"></p>
            <input type="submit" class="sign-btn" name="signup-submit" value="إنشاء حساب جديد">
            <div> أو <a class="switch-signup-button" onclick="openLoginForm(); closeSignupForm()">تسجيل دخول</a> </div>
        </form>
    </div>
</div>
<?php

if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
        echo "<script> openSignupForm();";
        echo "document.getElementById(\"error-msg\").innerHTML = \"يجب تعبئة جميع الخانات.\"; </script>";
    } else if ($_GET["error"] == "invalidusername") {
        echo "<script> openSignupForm();";
        echo "document.getElementById(\"error-msg\").innerHTML = \"اختر اسمًا ذو صيغة صحيحة.\"; </script>";
    } else if ($_GET["error"] == "invalidemail") {
        echo "<script> openSignupForm();";
        echo "document.getElementById(\"error-msg\").innerHTML = \"اختر بريد إلكتروني ذو صيغة صحيحة.\"; </script>";
    } else if ($_GET["error"] == "passwordsdontmatch") {
        echo "<script> openSignupForm();";
        echo "document.getElementById(\"error-msg\").innerHTML = \"كلمتا المرور لا تتطابقان.\"; </script>";
    } else if ($_GET["error"] == "stmtfailed") {
        echo "<script> openSignupForm();";
        echo "document.getElementById(\"error-msg\").innerHTML = \"حدث خلل في النظام، حاول مرة أخرى.\"; </script>";
    } else if ($_GET["error"] == "usernametaken") {
        echo "<script> openSignupForm();";
        echo "document.getElementById(\"error-msg\").innerHTML = \"اسم المستخدم المدخل غير متاح للاستخدام، اختر اسمًا آخر.\"; </script>";
    } else if ($_GET["error"] == "emailtaken") {
        echo "<script> openSignupForm();";
        echo "document.getElementById(\"error-msg\").innerHTML = \"البريد الإلكتروني المدخل غير متاح للاستخدام، اختر عنوانًا آخر.\"; </script>";
    } else if ($_GET["error"] == "none") {
        echo "<script> openLoginForm();";
        // echo "document.getElementById(\"error-msg\").innerHTML = \"تمت عملية تسجيلك بنجاح، أهلًا بك!\"; 
        //     document.getElementById(\"error-msg\").classList.add('confirm-msg');</script>";
    } else if ($_GET["error"] == "loginemptyinput") {
        echo "<script> openLoginForm();";
        echo "document.getElementById(\"msg-box-login\").innerHTML = \"يجب تعبئة جميع الخانات.\"; </script>";
    } else if ($_GET["error"] == "wronglogin") {
        echo "<script> openLoginForm();";
        echo "document.getElementById(\"msg-box-login\").innerHTML = \"البريد الإلكتروني أو كلمة المرور غير صحيحة.\"; </script>";
    } else if ($_GET["error"] == "loginnone") {
    }
}

?>