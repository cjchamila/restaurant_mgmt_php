<!DOCTYPE html>
<html lange="en">
<head>
<meta charset="UTF-8">
<title>Document</title>
<link rel="stylesheet" type="text/css" href="../css/menu_filter.css">
<script type="text/javascript" src="../js/menu_filter.js"></script>

</head>
<body>
<?php  
require('../classes/MenuItem.php');
const CURRENCY = "Rs.";

$menuItems = array(
    new MenuItem("Hot battered cuttlefish", 550.30, MenuItem::APPETIZER),    
    new MenuItem("Egg fried rice", 850.00, MenuItem::MAIN_COURSE),
    new MenuItem("Vegetable fried rice", 750.00, MenuItem::MAIN_COURSE),
    new MenuItem("Chicken noodles", 650.00, MenuItem::MAIN_COURSE),
    new MenuItem("Ice cream", 450.00, MenuItem::DESSERT),
    new MenuItem("Fried Prawns", 750.00, MenuItem::APPETIZER),
    new MenuItem("Caramel pudding", 350.00, MenuItem::DESSERT),
    new MenuItem("Fruit salad", 250.00, MenuItem::DESSERT),
    new MenuItem("Pepper Pork", 850.00, MenuItem::APPETIZER),
    new MenuItem("Chicken fried rice", 550.30, MenuItem::MAIN_COURSE),
    new MenuItem("Watalappan", 400.00, MenuItem::DESSERT)
);
?>

<h1 class="menu_card">Browse menu by category</h1>

<div class="dropdown_div">
<select name="category_select" onchange="showMenu(this.value)">
  <option value="0" selected>----Please select----</option>
  <option value="1">Appetizers</option>
  <option value="2">Main Courses</option>
  <option value="3">Desserts</option>
</select>
</div>

<div class="container">
  <div id="menu_1" class="box menu_div" style="display: none;">
    <h2 class='menu_card'>Appetizers</h2><br/>
    <?php 
    $appetizers = array_filter($menuItems, function($menuItem) {
        return $menuItem->getType() === MenuItem::APPETIZER;
    });

    foreach($appetizers as $appetizer){
        echo "<ul class='appetizer menu_card'><li>".$appetizer->getName()." ".CURRENCY." ".number_format($appetizer->getPrice(),2)."</li></ul><br/>";
    }
    ?>
  </div>

  <div id="menu_2" class="box menu_div" style="display: none;">
    <h2 class='menu_card'>Main Courses</h2><br/>
    <?php 
    $mainCourses = array_filter($menuItems, function($menuItem) {
        return $menuItem->getType() === MenuItem::MAIN_COURSE;
    });

    foreach($mainCourses as $mainCourse){
        echo "<ul class='main_course menu_card'><li>".$mainCourse->getName()." ".CURRENCY." ".number_format($mainCourse->getPrice(),2)."</li></ul><br/>";
    }
    ?>
  </div>

  <div id="menu_3" class="box menu_div" style="display: none;">
    <h2 class='menu_card'>Desserts</h2><br/>
    <?php 
    $desserts = array_filter($menuItems, function($menuItem) {
        return $menuItem->getType() === MenuItem::DESSERT;
    });

    foreach($desserts as $dessert){
        echo "<ul class='dessert menu_card'><li>".$dessert->getName()." ".CURRENCY." ".number_format($dessert->getPrice(),2)."</li></ul><br/>";
    }
    ?>
  </div>
</div>
</body>
</html>