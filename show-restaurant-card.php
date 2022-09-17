<?php include "includes/header.php"; ?>
<body class="search-restaurant">
<?php
if(isset($_GET['card-lang'])){
    $cardLang = $_GET['card-lang'];
    echo "<img src=\"images/{$cardLang}-gluten-free-restaurant-card.png\" alt=\"بطاقة تعريف سيلياك لغة {$cardLang}\">";
}
