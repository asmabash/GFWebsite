<?php include "includes/header.php"; 
require_once 'includes/functions.inc.php';?>

<body class="search-restaurant">
    <main>
        <h2 class="center-h2">ابحث عن مطاعم خالية من الجلوتين في مدينتك.</h2>
        <div class="wrap search-form">
            <form action="search-results.php" method="GET">
                <input list="city-options" id="city-choice" name="city-choice" placeholder="المدينة" />
                <datalist id="city-options">
                <?php
                $citiesList = getSaudiCitiesList();
                $numOfCities = count($citiesList);
                for ($i = 0; $i < $numOfCities; $i++) {
                    echo "<option value=\"".$citiesList[$i]."\"></option>"; 
                }
                ?>
                </datalist>
                <input type="submit" class="sign-btn" value="بحث">
        </div>
        </form>
    </main>
    <?php include "includes/footer.php";?>

</body>

</html>