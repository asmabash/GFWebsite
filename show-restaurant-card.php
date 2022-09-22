<?php include "includes/header.php"; ?>
<body class="search-restaurant">
<?php
if(isset($_GET['card-lang'])){
    $cardLang = $_GET['card-lang'];
    echo "<div class=\"lang-img\"><img style=\"max-width: 100%; width: auto;\" src=\"images/{$cardLang}-gluten-free-restaurant-card.png\" alt=\"بطاقة تعريف سيلياك لغة {$cardLang}\"></div>";
}
include "includes/footer.php";?>
