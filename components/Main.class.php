<?php

class Main {

  private static $instance = null;

  public static function getInstance(){
      if(!self::$instance){
          self::$instance = new Main();
      }

      return self::$instance;
  }


  public function getHeader(){
        echo "<!DOCTYPE html>";
        echo "<html>";
        echo "<head>";
        echo "<title>Rapids Cemetery</title>";
        echo "</head>";
        echo "<body>";
  }

  public function getFooter(){
        echo "</body>";
        echo "</html>";
  }

}

?>