<?php include "includes/header.php"; 
require_once 'includes/functions.inc.php';?>

<body class="search-restaurant">
    <main>
        <h2 class="center-h2">ساهم في إضافة مطاعم توفر خيارات خالية من الجلوتين.</h2>
        <div class="wrap search-form">
        <h2 class="center-h2" style="margin-bottom: 30px;">إضافة مطعم</h2>
            <form action="includes/add-restaurant.inc.php" method="POST">
                <input type="text" name="restaurant-name" id="restaurant-name" placeholder="اسم المطعم">
                <input type="text" name="restaurant-city" id="restaurant-city" list="cities-list" placeholder="المدينة">
                <datalist id="cities-list">
                <?php
                $citiesList = getSaudiCitiesList();
                $numOfCities = count($citiesList);
                for ($i = 0; $i < $numOfCities; $i++) {
                    echo "<option value=\"".$citiesList[$i]."\"></option>"; 
                }
                ?>
                    
                </datalist>
                <input type="submit" class="sign-btn" name="submit" value="إضافة">
        </div>
        </form>
    </main>
    <?php 
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "noneinrestaurantadd") {
            echo"<p>تمت إضافة المطعم بنجاح! شكرًا لك.</p>";
                } }
    include "includes/footer.php";?>

</body>

</html>