<?php include "includes/header.php";
require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

echo "<body class=\"search-restaurant\">";

$city = $_GET['city-choice'];
$sql_query = "SELECT * FROM restaurants WHERE restaurant_location = \"{$city}\"";
$result = $conn->query($sql_query);


echo "<div class=\"list-div\">";
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<div class=\"container\">";
    $restaurantID = $row['restaurant_ID'];
    echo "<h2 id=\"restaurant-name\"><a id=\"restaurant-name\" href=\"restaurant-reviews.php?restaurant-id={$row['restaurant_ID']}\">" . $row['restaurant_name'] . "</a></h2>";
    // some js to check rating in db and then for loop for checked stars and unchecked
    $restaurant_rating = getRestaurantAvgRating($conn, $restaurantID);
    $num_unchecked_stars = 5 - $restaurant_rating;
    $num_of_ratings = getNumOfRatings($conn, $restaurantID);
    while ($restaurant_rating > 0) {
      echo "<i class=\"fa-solid fa-star checked\"></i>";
      $restaurant_rating--;
    }
    while ($num_unchecked_stars > 0) {
      echo "<i class=\"fa-solid fa-star\"></i>";
      $num_unchecked_stars--;
    }

    echo "<span id=\"ratings-num\">{$num_of_ratings} تقييمات</span>";
    echo "<br><br><hr>";
    echo "</div>";
  }
} else {
  echo "0 results";
}




?>
<?php include "includes/footer.php"; ?>

</body>

</html>