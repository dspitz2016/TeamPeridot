<?php

class Main {

    private static $instance = null;

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new Main();
        }

        return self::$instance;
    }

    public function getPath($page){
        $path = '../';
        if($page == "admin"){
            $path = "../../";
        } else if ($page == "main"){
            $path = "../";
        }
        return $path;
    }

    public function getHeader($page){
        echo '<!DOCTYPE html>';
        echo '<html>';
        echo '<head>';
        echo '<title>Rapids Cemetery</title>';
        echo    '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
        echo    '<link type="text/css" rel="stylesheet" href="'.$this->getPath($page).'css/materialize.css" media="screen,projection">';
        echo    '<link type="text/css" rel="stylesheet" href="'.$this->getPath($page).'css/main.css" />';
        echo    '<meta name="viewport" content="width=device-width, initial-scale=1">';
        echo '</head>';
        echo '<body>';
    }

    public function getNavigationBar(){
        echo '<nav>';
        echo '<div class="nav-wrapper cust-color-nav">';
        echo '<a href="index.php" class="brand-logo">Rapids</a>';
        echo '<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>';
        echo '<ul class="right hide-on-med-and-down">';
        echo '<li><a href="index.php">History</a></li>';
        echo '<li><a href="/pages/tours.php">Tours</a></li>';
        echo '<li><a href="/pages/faq.php">FAQ</a></li>';
        echo '<li><a href="/pages/contact.php">Contact</a></li>';
        echo '</ul>';
        echo '<ul class="side-nav cust-color-side" id="mobile-demo">';
        echo '<h3>Naviagation</h3>';
        echo '<hr />';
        echo '<li><a href="index.php">History</a></li>';
        echo '<li><a href="/pages/tours.php">Tours</a></li>';
        echo '<li><a href="/pages/faq.php">FAQ</a></li>';
        echo '<li><a href="/pages/contact.php">Contact</a></li>';
        echo '</ul>';
        echo '</div>';
        echo '</nav>';
    }

    public function getScripts($page){
        echo '<script src="'.$this->getPath($page).'js/jquery-3.3.1.min.js"></script>';
        echo '<script src="'.$this->getPath($page).'js/materialize.js"></script>';
        echo '<script src="'.$this->getPath($page).'js/main.js"></script>';
//        echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxPGQ8GD6zL36rlXs-o2AE-RAOsZYpvbQ&callback=initMap" async defer></script>';
    }

    public function getFooter(){
        echo "</body>";
        echo "</html>";
    }

}

?>