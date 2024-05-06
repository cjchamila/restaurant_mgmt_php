<?php declare(strict_types=1);

class MenuItem{
    const APPETIZER="Appetizers";
    const MAIN_COURSE="Main Course";
    const DESSERT="Desserts";
    private string $name;
    private float $price;
    private string $type;

    public function __construct($name, $price,$type){
        $this->name=$name;
        $this->price=$price;
        $this->type=$type;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getName(){
        return $this->name;
    }

    public function getType(){
        return $this->type;
    }
}