<?php


class Villager{
  private $name;

  public function __construct($name){
    $this->name = $name;
  }

  public function getName(){
    return $this->name;
  }

}

class Group implements Iterator{
  private $persons = [];

  private $name;
  private $canVote = false;

  public function __construct($name, $canVote){
    $this->name = $name;
    $this->canVote = $canVote;
  }

  public function getName(){
    return $this->name;
  }

  public function add(Villager $person){
    $this->persons[] = $person;
    return $this;
  }
}

class Village{
  private $name;
  public $villagers;
  public $conseilMunicipal;

  public function __construct($name){
    $this->name = $name;
    $this->villagers = new Group("Villageois", false);
    $this->conseilMunicipal = new Group("Conseil Municipal", true);
  }

  public function addVillager(Villager $villager){
    $this->villagers->add($villager);
    return $this;
  }

  public function addToConseilMunicipal(Villager $villager){
    $this->conseilMunicipal->add($villager);
    return $this;
  }
}

$city = new Village("Jadielle");

$profChen = new Villager("Professor Chen");
$mamanDeSacha = new Villager("Maman de Sacha");
$joelle = new Villager("Infirnière Joelle");
$sacha = new Villager("Sacha");
$james = new Villager("James");
$jessie = new Villager("Jessie");
$police = new Villager("La Policière");

$city->addVillager($profChen)
     ->addToConseilMunicipal($profChen)
     ->addVillager($joelle)
     ->addToConseilMunicipal($joelle)
     ->addVillager($police)
     ->addToConseilMunicipal($police)
     ->addVillager($sacha)
     ->addVillager($mamanDeSacha)
     ->addVillager($james)
     ->addVillager($jessie)

     ;

//lister les villageois
echo "Groupe ".$city->villagers->getName()." :\n";

foreach ($city->villagers as $villager) {
  echo "- ".$villager->getName()."\n";
}

//lister les membres du Conseil Municipal
echo "Groupe ".$city->conseilMunicipal->getName()." :\n";

foreach ($city->conseilMunicipal as $villager) {
  echo "- ".$villager->getName()."\n";
}