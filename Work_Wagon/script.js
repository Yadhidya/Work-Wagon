$(document).ready(function() {
  $('#buttonContainer').hide();

  $('#loginButton').click(function() {
    $(this).slideUp();

    $('#buttonContainer').slideDown();
  });

  $('#shopButton, #otherButton').click(function() {
    $('#buttonContainer').slideUp();

    $('#loginButton').slideDown();
  });
});
 document.addEventListener('DOMContentLoaded', function () {
  const hamburgerIcon = document.querySelector('.hamburger-icon');
  const sidebar = document.querySelector('.sidebar');
  const overlay = document.querySelector('.overlay');

  function openSidebar() {
    sidebar.style.width = '250px';
    overlay.style.display = 'block';
    }

  function closeSidebar() {
    sidebar.style.width = '0';
    overlay.style.display = 'none';
  }

  hamburgerIcon.addEventListener('click', openSidebar);
  overlay.addEventListener('click', closeSidebar);
  
  // Close the sidebar when the close button is clicked
  document.querySelector('.close-button').addEventListener('click', closeSidebar);
});





var tabs = $('.tabs');
var selector = $('.tabs').find('a').length;
var activeItem = tabs.find('.active');
var activeWidth = activeItem.innerWidth();
$(".selector").css({
  "left": activeItem.position.left + "px", 
  "width": activeWidth + "px"
});

$(".tabs").on("click","a",function(e){
  e.preventDefault();
  $('.tabs a').removeClass("active");
  $(this).addClass('active');
  var activeWidth = $(this).innerWidth();
  var itemPos = $(this).position();
  $(".selector").css({
    "left":itemPos.left + "px", 
    "width": activeWidth + "px"
  });
});
function openTab(evt, TabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(TabName).style.display = "block";
  evt.currentTarget.className += " active";
}
const cityFilter = document.getElementById('cityFilter');
const restaurantItems = document.querySelectorAll('#restaurantList .innerdisplay');

cityFilter.addEventListener('change', function () {
    const selectedCity = this.value;

    restaurantItems.forEach(function (restaurant) {
        const restaurantCity = restaurant.getAttribute('data-city');
        if (selectedCity === 'all' || selectedCity === restaurantCity) {
            restaurant.style.display = 'block'; 
        } else {
            restaurant.style.display = 'none'; 
        }
    });
});  

document.addEventListener('DOMContentLoaded', function() {
  const workerfilter = document.getElementById('workerfilter');
  const workerlist = document.querySelectorAll('#workerlist .innerdisplay');

  workerfilter.addEventListener('change', function () {
      const selectCity = this.value;

      workerlist.forEach(function (restaurant) {
          const restaurantCity = restaurant.getAttribute('data-city');

          if (selectCity === 'all' || selectCity === restaurantCity) {
              restaurant.style.display = 'block';
          } else {
              restaurant.style.display = 'none';
          }
      });
  });
});




var moreButtons = document.querySelectorAll(".morebutton");

moreButtons.forEach(function(button, index) {
    button.addEventListener('click', function() {
        var popupContainer = document.querySelectorAll(".popup-container")[index];
        
        popupContainer.style.display = 'block';
        
        var margElement = document.querySelectorAll(".marg1")[index];
        if (margElement && margElement.textContent.trim() === "no") {
            var reqButton = document.querySelectorAll(".reqbutton2")[index];
            
            if (reqButton) {
                reqButton.style.display = "none";
            }
        }
        
        var closeButton = document.querySelectorAll(".closebutton")[index];
        closeButton.addEventListener("click", function() {
            popupContainer.style.display = 'none';
        });
    });
});

var shopbutton= document.querySelectorAll(".shopbutton");

shopbutton.forEach(function(button, index) {
    button.addEventListener('click', function() {
        var popupcontainer = document.querySelectorAll(".popupcontainer")[index];
        
        popupcontainer.style.display = 'block';
        
        var avail1Element = document.querySelectorAll(".avail11")[index];
        if (avail1Element && margElement.textContent.trim() === "0") {
            var shopreqButton = document.querySelectorAll(".shopereqbutton2")[index];
            
            if (shopreqButton) {
                shopreqButton.style.display = "none";
            }
        }
        
        var shopcloseButton = document.querySelectorAll(".shopclosebutton")[index];
        shopcloseButton.addEventListener("click", function() {
            popupcontainer.style.display = 'none';
        });
    });
});










