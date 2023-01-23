$(function(){
  $(document).scroll(function(){
    var $nav = $(".nav-links");
    $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height() );
  });
});


function closeLoginForm(){
  document.getElementById("signin-overlay").style.display = "none";
}

function openLoginForm(){
      document.getElementById("signin-overlay").style.display = "block";
  }
  
function closeSignupForm(){
    document.getElementById("signup-overlay").style.display = "none";
  }
function openSignupForm(){
        document.getElementById("signup-overlay").style.display = "block";
    }

function redirectToSearch(){
    window.location.href='search-restaurant.php';
}

function redirectToAddRestaurant(){
  window.location.href='add-restaurant.php';
}


function makeTransparentHeader(){
  const elem = document.getElementById('header');
  elem.style.backgroundColor = 'transparent';
}

function redirectToTagalogCard() {
  window.location.href = 'show-restaurant-card.php?card-lang=tagalog';
};

function redirectToUrduCard() {
  window.location.href = 'show-restaurant-card.php?card-lang=urdu';
};

function redirectToBangladeshCard() {
  window.location.href = 'show-restaurant-card.php?card-lang=bangla';
};

function redirectToArabicCard() {
  window.location.href = 'show-restaurant-card.php?card-lang=arabic';
};

function redirectToEnglishCard() {
  window.location.href = 'show-restaurant-card.php?card-lang=english';
};

// function deleteComment(){
// TODO
// }

// function editComment(){
// TODO
// }