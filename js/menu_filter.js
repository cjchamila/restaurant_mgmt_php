function showMenu(category) {
    // Hide all menu divs
    var menuDivs = document.querySelectorAll('.menu_div');
    menuDivs.forEach(function(div) {
      div.style.display = 'none';
    });

    // Show the selected menu div
    var selectedDiv = document.getElementById('menu_' + category);
    if (selectedDiv) {
      selectedDiv.style.display = 'block';
    }
  }