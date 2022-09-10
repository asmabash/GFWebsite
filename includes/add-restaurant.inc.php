<?php
$restaurantName = $_POST['restaurant-name'];
$restaurantCity = $_POST['restaurant-city'];
if (isset($_POST['submit'])) {
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';


    if (emptyInputAddRestaurant($restaurantName, $restaurantCity) !== false) {
        header("location: ../add-restaurant.php?error=addrestaurantemptyinput");
        exit();
      }

      addRestaurant($conn, $restaurantName, $restaurantCity);

    
}
