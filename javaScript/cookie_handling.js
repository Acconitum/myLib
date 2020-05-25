<script>
  var donationButtonClicked = false;
  setTimeout(function() {

    jQuery(document).ready(function() {
      jQuery('#donations a, .donations a').on('click', function(event) {
        if (!donationButtonClicked) {
          event.preventDefault();
        }
        if(!document.cookie.match(/cs-donator/)) {
          window.location.href = jQuery(this).attr('href');
          return true;
        } else {
          if (window.location.href.match(/\.ch\/de\//)) {
            var page = 'https://www.schweizertafel.ch/de/helfen-sie-mit/cs-spendenaktion.html';
          } else {
            var page = 'https://www.schweizertafel.ch/fr/soutenez-nous/cs-spendenaktion.html';
          }
          window.location.href = page; 
          return true;
        }
      });
    });
  }, 1000);
</script>


<script>
  jQuery(document).ready(function() {
    var expirationDate = new Date();
    expirationDate.setDate(expirationDate.getDate() + 5);
    document.cookie = "cs-donator=true; expires=" + expirationDate.toUTCString() + "; path=/";
  });
</script>


<script>
  setTimeout(function() {
    if (!document.cookie.match(/pop-up-declined/)) {
      document.querySelector('.pop-up').classList.add('popupfade');
    }
  }, 2000);

  document.addEventListener('click', function (event) {
    if (event.target.getAttribute('data-close') ==="pop-up") {
      event.preventDefault();
      document.cookie = "pop-up-declined=true; expires=Thu, 30 Dec 2200 12:00:00 UTC; path=/";
      document.querySelector('.pop-up').classList.remove('popupfade');
      
    }
  });
</script>
