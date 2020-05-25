  <?php

  class FakePDO{
    public function __construct(){
      $this->seed = mt_rand();
    }

    public function query($class){
      return new $class;
    }
  }


  // function getPdo(){
  //     $pdo = new FakePDO("mysql://user:pass@localhost");
  //     return $pdo;
  // }

  //on cherche une solution pour n'avoir QU'UN SEUL FakePDO

  class SinglePDO{

    static function getTheOne(){
      //pas le droit d'utiliser $this

      //si ça existe, on réutilise
      if( /*condition d'existence*/ ){

      }else{
        // si ça existe pas encore, on crée
        $pdo = new FakePDO("mysql://user:pass@localhost");
      } 
        
      return $pdo;
    }

  }


  class Controller1{
    function actionA(){
      $pdo = SinglePDO::getTheOne();
      //j'utilise mon pdo
    }
  }


class Village{

  public function getVillagers(){
    $pdo = SinglePDO::getTheOne();
    var_dump($pdo);

    $villagers = $pdo->query("Villager");
    return $villagers;
  }

  public function getHouses(){
    $pdo = SinglePDO::getTheOne();
    var_dump($pdo);

    $houses = $pdo->query("House");
    return $houses;
  }
}

class Villager{}
class House{}


class Controller2{
  function actionB(){
    $pdo = SinglePDO::getTheOne();
    var_dump($pdo);

    $village =  $pdo->query("Village");
    //j'utilise mon pdo pour récupérer un village
    $village->getVillagers();
    $village->getHouses();

  }
}


$c = new Controller2();
$c->actionB();

