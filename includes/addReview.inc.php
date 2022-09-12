<?php
session_start();

$reviewText = $_POST['review'];
$userRating = $_POST['rating'];
// $userEmail = $_SESSION['email'];
$username = $_SESSION['username'];
$restaurantID = $_SESSION['restaurant-ID'];
if (isset($_SESSION['isLoggedInToGFWebsite.com'])){
if (isset($_POST['submit'])) {

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputAllAddReview($reviewText, $userRating) !== false) {
        header("location: ../add-review.php?error=emptyinput");
        exit();
    }

    addReview($conn, $reviewText, $userRating, $restaurantID, $username);
}
}
else{
    header("location: ../add-review.php?error=notloggedin");
    exit();
}