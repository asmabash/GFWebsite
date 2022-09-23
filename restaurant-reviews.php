<?php include "includes/header.php";
require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

echo "<body class=\"search-restaurant\">";
$_SESSION['restaurant-ID'] = $_GET['restaurant-id'];
$restaurantID = $_SESSION['restaurant-ID'];
$_SESSION['restaurant-name'] = getRestaurantNameByID($conn, $restaurantID);
$restaurantID = $_SESSION['restaurant-ID'];
$sql_query = "SELECT * FROM reviews WHERE restaurant_ID = \"{$restaurantID}\"";
$result = $conn->query($sql_query);
echo "<div class=\"list-div\">";
echo "<h2>{$_SESSION['restaurant-name']}</h2>";
echo "<div><a href=\"add-review.php\"><button class=\"sign-btn comment-btn\">إضافة تعليق</button></a></div>";
$resultData = getRestaurantReviews($conn, $restaurantID);

while ($row = mysqli_fetch_assoc($resultData)) {
  // echo "{$row['restaurant_name']}";
    echo "<div class=\"container\">";
    //CHANGE TO USERNAME
    $username = $row['userID'];
    echo "<h3 class=\"user-ID\">{$username}</h3>";
    $user_rating = $row['rating'];

    $num_unchecked_stars = 5 - $user_rating;
    echo "<span class=\"star\">";
    while ($user_rating) {
      echo "<i class=\"fa-solid fa-star checked\"></i>";
      $user_rating--;
    }
    while ($num_unchecked_stars) {
      echo "<i class=\"fa-solid fa-star\"></i>";
      $num_unchecked_stars--;
    }
    echo "</span>";
    echo "<br><p class=\"user-review\">{$row['review_text']}</p>";
    if($username == $_SESSION['username']){

      echo "<button>حذف</button>
      <button>تعديل</button>";
    }
    echo "<hr>";
    
  }
  echo "</div>";



?>
        <?php include "includes/footer.php";?>

</body>

</html>