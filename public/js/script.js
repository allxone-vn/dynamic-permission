document.addEventListener("DOMContentLoaded", function() {
  var links = document.querySelectorAll('.sidebar__link > a');
  var currentPath = window.location.pathname;

  links.forEach(function(link) {
      var linkPath = new URL(link.href).pathname;
      if (linkPath === currentPath) {
          link.parentElement.classList.add('active_menu_link');
      }
  });
});
