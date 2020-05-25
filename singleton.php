  <?php

  class FakePDO{
    public function __construct(){
      $this->seed = random_int(0, PHP_INT_MAX);
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


  class Logger{

    private static $mylogger = null;

    private function __construct(){
      $this->seed = random_int(0, PHP_INT_MAX);
    }

    static function getInstance(){

      if(is_null(self::$mylogger)){
        self::$mylogger = new Logger();
      }

      return self::$mylogger;
    } 

  }


  abstract class SinglePDO{

    private static $mypdo = null;

    static function getInstance(){
      //pas le droit d'utiliser $this

      //si ça existe pas, on crée
      if(is_null(self::$mypdo)){
          self::$mypdo = new FakePDO("mysql://user:pass@localhost");
      }

      return self::$mypdo;
    }

  }


  class Controller1{
    function actionA(){
      $pdo = SinglePDO::getInstance();
      //j'utilise mon pdo
    }
  }


class Village{

  public function getVillagers(){
    $pdo = SinglePDO::getInstance();


    $villagers = $pdo->query("Villager");
    return $villagers;
  }

  public function getHouses(){
    $pdo = SinglePDO::getInstance();
    var_dump($pdo);

    $houses = $pdo->query("House");
    return $houses;
  }
}

class Villager{}
class House{}


class Controller2{
  function actionB(){
    $logger1 = Logger::getInstance();
    var_dump($logger1);

    $logger2 = Logger::getInstance();
    var_dump($logger2);

    die();
    $pdo = SinglePDO::getInstance();
    var_dump($pdo);


    $village =  $pdo->query("Village");
    //j'utilise mon pdo pour récupérer un village
    $village->getVillagers();
    $village->getHouses();

  }
}


$c = new Controller2();
$c->actionB();

