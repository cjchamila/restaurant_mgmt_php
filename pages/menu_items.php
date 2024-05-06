<!DOCTYPE html>
<html lange="en">
<head>

<meta charset="UTF-8">
<title>Document</title>
<link rel="stylesheet" type="text/css" href="../css/menu_items.css">
</head>
<body>
<h1 class="menu_card">Menu Card</h1>
<?php require('../classes/MenuItem.php');
const CURRENCY="Rs.";
$appetizers=array(new MenuItem("Hot battered cuttlefish",550.30,MenuItem::APPETIZER),
                  new MenuItem("Pepper Pork",850.00,MenuItem::APPETIZER),
                  new MenuItem("Fried Prawns",750.00,MenuItem::APPETIZER));

$main_course=array(new MenuItem("Chicken fried rice",550.30,MenuItem::MAIN_COURSE),
new MenuItem("Egg fried rice",850.00,MenuItem::MAIN_COURSE),
new MenuItem("Vegetable fried rice",750.00,MenuItem::MAIN_COURSE),
new MenuItem("Chicken fried rice",750.00,MenuItem::MAIN_COURSE),
new MenuItem("Chicken noodles",650.00,MenuItem::MAIN_COURSE));

$desserts=array(new MenuItem("Ice cream",450.00,MenuItem::DESSERT),
new MenuItem("Caramel pudding",350.00,MenuItem::DESSERT),
new MenuItem("Fruit salad",250.00,MenuItem::DESSERT),
new MenuItem("Watalappan",400.00,MenuItem::DESSERT));

?>
<div class="container">
  <div class="box"><h2 class='menu_card'><?php echo MenuItem::APPETIZER ?></h2><br/><?php 
  foreach($appetizers as $appetizer){
    echo  "<ul class='appetizer menu_card'><li>".$appetizer->getName()." ".CURRENCY." ".number_format($appetizer->getPrice(),2)."</li></ul><br/>";
  }
  ?></div>

  <div class="box"><h2 class='menu_card'><?php echo MenuItem::MAIN_COURSE ?></h2><br/><?php 
  foreach($main_course as $main_course_item){
    echo  "<ul class='appetizer menu_card'><li>".$main_course_item->getName()." ".CURRENCY." ".number_format($main_course_item->getPrice(),2)."</li></ul><br/>";
  }
  ?></div>

  <div class="box"><h2 class='menu_card'><?php echo MenuItem::DESSERT ?></h2><br/><?php 
  foreach($desserts as $dessert){
    echo  "<ul class='appetizer menu_card'><li>".$dessert->getName()." ".CURRENCY." ".number_format($dessert->getPrice(),2)."</li></ul><br/>";
  }
  ?></div>
</div>
</body>
</html>