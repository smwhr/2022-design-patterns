<?php


class Villager{
  private $name;

  public function __construct($name){
    $this->name = name;
  }

}

class Village{
  private $name;

  public function __construct($name){
    $this->name = name;
  }

  public function addVillager(Villager $villager){

  }
}


$city = new Village("Jadielle");

$profChen = new Villager("Professor Chen");
$sacha = new Villager("Sacha");

$city->addVillager($profChen);
$city->addVillager($sacha);

//lister les villageois