<?php include "includes/header.php";
require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';

echo "<body class=\"search-restaurant\">";
echo "<div class=\"list-div\">";
if (!isset($_SESSION['isLoggedInToGFWebsite.com'])) {
  echo "<p class=\"error-msg\"> لا يمكن إضافة تعليق إلا من خلال حساب مسجل. </p><br><br>";
}
$restaurant_name = $_SESSION['restaurant-name'];
echo "<h2>كيف كانت تجربتك في {$restaurant_name}؟</h2>"; ?>
<div class="review-area">
  <p>
  <ul>
    <li>ايش طلبت؟</li>
    <li>كيف كانت الخدمة؟</li>
    <li>كيف تجنبت التلوث؟</li>
    </p>
    <br><br>
    <form action="includes/addReview.inc.php" method="POST">
      <textarea rows="8" cols="44" id="review" name="review" placeholder="حكينا عن تجربتك هنا.."></textarea>
      <div>
        <br><br>
        <p><label>التقييم: </label></p>
        <div class="flip-horizontally">
          <fieldset class="starability-basic">
            <input type="radio" id="no-rate" class="input-no-rate" name="rating" value="0" checked aria-label="No rating." />
            <input type="radio" id="first-rate1" name="rating" value="1" />
            <label for="first-rate1" title="Terrible">1 star</label>
            <input type="radio" id="first-rate2" name="rating" value="2" />
            <label for="first-rate2" title="Not good">2 stars</label>
            <input type="radio" id="first-rate3" name="rating" value="3" />
            <label for="first-rate3" title="Average">3 stars</label>
            <input type="radio" id="first-rate4" name="rating" value="4" />
            <label for="first-rate4" title="Very good">4 stars</label>
            <input type="radio" id="first-rate5" name="rating" value="5" />
            <label for="first-rate5" title="Amazing">5 stars</label>
          </fieldset>
        </div>

      </div>
      <input type="submit" class="sign-btn submit-comment-btn" value="إرسال" name="submit">
    </form>
</div>
</div>
<?php include "includes/footer.php";?>

</body>
