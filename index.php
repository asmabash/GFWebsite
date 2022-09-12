    <?php include "includes/header.php";

    ?>
    <script>
        makeTransparentHeader();
    </script>

    <body class="main-page-body">


        <p class="name">

        </p>
        <h1 class="explanation-text">نافذة للبحث عن مطاعم <br> داعمة للنظام الخالي من الجلوتين</h1>
        <div class="query-form">
            <button class="mainpage-button button1" type="button" id="search-restaurant" value="search-restaurant" onclick="redirectToSearch();">بحث</button>
            <button class="mainpage-button button2" type="button" id="add-business" value="add-business" onclick="redirectToAddRestaurant();">إضافة</button>
        </div>



        <!-- <script>
            const hamburger = document.querySelector(".hamburger");
            const navMenu = document.querySelector(".nav-menu");
            hamburger.addEventListener("click", () => {
                hamburger.classList.toggle("active");
                navMenu.classList.toggle("active");
            })

            document.querySelectorAll(".nav-link").forEach(n => n.
            addEventListener("click", () => {
                hamburger.classList.remove("active");
            }))
        </script> -->
        <?php include "includes/footer.php";?>

    </body>

    </html>