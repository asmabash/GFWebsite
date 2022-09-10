<?php
function emptyInputSignup($username, $email, $password, $passwordRepeat)
{
    $result;
    if (empty($username) || empty($email) || empty($password)  || empty($passwordRepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username)
{
    $result;
    // ("/^[أ-يa-zA-Z٠-٩0-9]*$/")
    // ^[\u0621-\u064Aa-zA-Z\d\-_\s]+$
    // if (!preg_match("/^[أ-يa-zA-Z٠-٩0-9]*$/", $username))

    if (!preg_match("/^[\u0621-\u064Aa-zA-Z\d\-_\s]+$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email)
{
    $result;
    // ("/^[أ-يa-zA-Z٠-٩0-9]*$/")
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function passwordMatch($password, $passwordRepeat)
{
    $result;
    // ("/^[أ-يa-zA-Z٠-٩0-9]*$/")
    if ($password !== $passwordRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function usernameExists($conn, $username)
{
    $sql = "SELECT * FROM users WHERE username = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if (mysqli_fetch_assoc($resultData)) {
        //.. code
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function emailExists($conn, $email)
{
    $sql = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if (mysqli_fetch_assoc($resultData)) {
        //.. code
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function createUser($conn, $username, $email, $password)
{
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, email, userPassword) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../index.php?error=none");
}
function emptyInputLogin($email, $password)
{
    $result;
    if (empty($email) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function loginUser($conn, $email, $password)
{
    $sql = "SELECT * FROM users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        $hashedPassword = $row["userPassword"];
        $checkPassword = password_verify($password, $hashedPassword);
        if ($checkPassword === false) {
            header("location: ../index.php?error=wronglogin");
            exit();
        } else if ($checkPassword === true) {
            session_start();
            $_SESSION['isLoggedInToGFWebsite.com'] = true;
            $_SESSION['username'] = $row["username"];
            $_SESSION['email'] = $email;
            header("location: ../index.php?error=loginnone");
            exit();
        }
    } else {
        header("location: ../index.php?error=wronglogin");
        exit();
    }
    mysqli_stmt_close($stmt);
}

function emptyInputAllAddReview($reviewText, $userRating)
{
    $result;
    if (empty($reviewText) && empty($userRating)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function addReview($conn, $reviewText, $userRating, $restaurantID, $username)
{
    $sql = "INSERT INTO reviews (restaurant_ID, userID, rating, review_text) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../addReview.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssss", $restaurantID, $username, $userRating, $reviewText);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../index.php");
}
function getRestaurantReviews($conn, $restaurantID)
{
    $sql = "SELECT * FROM reviews WHERE restaurant_ID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../restaurant-reviews.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $restaurantID);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    return $resultData;
}

function getRestaurantAvgRating($conn, $restaurantID)
{
    $sql = "SELECT AVG(rating) AS avgRating FROM reviews WHERE restaurant_ID = {$restaurantID};";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $restaurant_rating = $row['avgRating'];
        }
    }
    //$conn->close(); its closed after the getNumOfRatings function
    return $restaurant_rating;
}
function getNumOfRatings($conn, $restaurantID)
{
    $num_of_ratings;
    $sql = "SELECT COUNT(rating) AS numOfRatings FROM reviews WHERE restaurant_ID = {$restaurantID};";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $num_of_ratings = $row['numOfRatings'];
        }
    }
    //$conn->close();
    return $num_of_ratings;
}

function emptyInputAddRestaurant($restaurantName, $restaurantCity)
{
    $result;
    if (empty($restaurantName) || empty($restaurantCity)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function addRestaurant($conn, $restaurantName, $restaurantCity)
{
    $sql = "INSERT INTO restaurants (restaurant_name, restaurant_location) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../addReview.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $restaurantName, $restaurantCity);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../add-restaurant.php?error=noneinrestaurantadd");
}

function getSaudiCitiesList()
{
    $jsondata = file_get_contents("cities_lite.json");
    $json = json_decode($jsondata, true);
    $numOfInstances = count($json);
    for ($i = 0; $i < $numOfInstances; $i++) {
        $jsonList[$i] = $json[$i]['name_ar'];
    }

    return $jsonList;
}
function getRestaurantNameByID($conn, $restaurantID)
{
    $sql = "SELECT * FROM restaurants WHERE restaurant_ID = {$restaurantID};";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $restaurant_name = $row['restaurant_name'];
        }
    }
    //$conn->close(); 
    return $restaurant_name;
}
