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
        echo '<!DOCTYPE html>';
        echo '<html>';
        echo '<head>';
        echo '<title>Rapids Cemetery</title>';
        echo    '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
        echo    '<link type="text/css" rel="stylesheet" href="../css/materialize.css" media="screen,projection">';
        echo    '<link type="text/css" rel="stylesheet" href="../css/main.css" />';
        echo    '<meta name="viewport" content="width=device-width, initial-scale=1">';
        echo '</head>';
        echo '<body class="cust-color-slate">';
    }

    public function getNavigationBar(){
        echo '<nav>';
        echo '<div class="nav-wrapper cust-color-rust z-depth-1">';
        //echo '<a href="index.php" class="brand-logo right">Rapids Cemetery</a>';
        echo '<a href="index.php" class="brand-logo left"><img src="../images/RapidsLogo.png" style="margin: 0 1%;" alt="logo" height="60px" width="60px"></a>';
        echo '<a href="#" data-activates="mobile-demo" class="button-collapse right"><i class="material-icons">menu</i></a>';

        echo '<ul class="right hide-on-med-and-down">';
        echo '<li><a href="index.php">History</a></li>';
        echo '<li><a href="/pages/historicTrails.php">Historic Trail</a></li>';
        echo '<li><a href="/pages/contact.php">Contact</a></li>';
        echo '<li><a href="/pages/faq.php">FAQ</a></li>';
        echo '<li><a href="https://www.paypal.me/DustinSpitz">Donate</a></li>';
        echo '<li> <a href="https://www.facebook.com/RapidsCemeteryRochester/?ref=br_rs">Like us on facebook</a></li>';
        echo '</ul>';

        echo '<ul class="right side-nav z-depth-3" id="mobile-demo">';
        echo '<hr />';
        echo '<li><a href="index.php">Home</a></li>';
        echo '<li><a href="/pages/historicTrails.php">Historic Trail</a></li>';
        echo '<li><a href="/pages/contact.php">Contact</a></li>';
        echo '<li><a href="/pages/faq.php">FAQ</a></li>';
        echo '<li><a href="https://www.paypal.me/DustinSpitz">Donate</a></li>';
        echo '<li><a href="https://www.facebook.com/RapidsCemeteryRochester/?ref=br_rs">Like us on facebook</a></li>';
        echo '</ul>';
        echo '</div>';
        echo '</nav>';
    }

    public function getScripts(){
//        echo    '<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>';
        echo '<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>';
        echo '<script src="../js/main.js"></script>';

        echo '<script src="../js/materialize.js"></script>';
        }

    public function getFooter(){

        echo '<footer><div class="section cust-color-rust">';
            echo '<div class="row container white-text center-align">';
                echo '<div class="col s12">';
                echo '&copy; Team Peridot 2018';
                echo '</div>';
            echo '</div>';
        echo '</div></footer>';
        echo "</body>";
        echo "</html>";
    }

    /**
     * Admin Things
     * createAction, updateAction, deleteAction used as globals for all modal CRUD actions
     */

    public function getAdminHeader(){
        echo '<!DOCTYPE html>';
        echo '<html>';
        echo '<head>';
        echo '<title>Rapids Cemetery</title>';
        echo    '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';
        echo    '<link type="text/css" rel="stylesheet" href="../css/materialize.css" media="screen,projection">';
        echo    '<link type="text/css" rel="stylesheet" href="../css/main.css" />';
        echo    '<link type="text/css" rel="stylesheet" href="../css/admin.css" />';
        echo    '<meta name="viewport" content="width=device-width, initial-scale=1">';
        echo    "<script>     
                        var createAction = 'create';
                        var updateAction = 'update';
                        var deleteAction = 'delete';</script>";
        echo '</head>';
        echo '<body>';
    }

    public function getAdminSideBar(){
        echo '<ul id="slide-out" class="side-nav fixed cust-color-slate col s3">';
        echo '<li><h4>Rapids Cemetery Admin Portal</h4></li>';


        echo '<li><a class="navTab waves-effect" href="#1"><i class="material-icons">add_location</i>Locations</a></li>';
        echo '<li><a class="navTab waves-effect" href="#2"><i class="material-icons">exposure_plus_1</i>Graves</a></li>';
        echo '<li><a class="navTab waves-effect" href="#3"><i class="material-icons">filter_vintage</i>Flora</a></li>';
        echo '<li><a class="navTab waves-effect" href="#4"><i class="material-icons">nature</i>Miscellaneous</a></li>';
        echo '<li><a class="navTab waves-effect" href="#5"><i class="material-icons">question_answer</i>FAQs</a></li>';

        echo '<li><a class="navTab waves-effect" href="#6"><i class="material-icons">event</i>Events</a></li>';
        echo '<li><a class="navTab waves-effect" href="#7"><i class="material-icons">filter_list</i>Type</a></li>';
        echo '<li><a class="navTab waves-effect" href="#8"><i class="material-icons">filter_list</i>Historic Filter</a></li>';
        echo '<li><a class="navTab waves-effect" href="#9"><i class="material-icons">contacts</i>Contact</a></li>';

        echo '<li><div class="divider"></div></li>';

        echo '<form method="post" action="logout.php">';
            echo '<li><button type="submit" name="logout" value="logout" class="btn btn-medium lighten-1 waves-effect"><i class="material-icons">arrow_back</i> Logout</button></li>';
        echo '</form>';

        echo '</ul>';
    }

    public function getAdminScripts(){
        echo '<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>';
        echo '<script src="../js/materialize.js"></script>';
        echo '<script src="../js/main.js"></script>';
        echo '<script src="../js/adminModal.js"></script>';
    }

}

?>
