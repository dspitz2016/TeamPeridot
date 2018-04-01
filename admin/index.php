<?php
    ob_start();
    session_start();

    include '../components/Main.class.php';
    include '../services/LoginService.class.php';

    $main = Main::getInstance();
    $main->getHeader();

    /**
    * If someone is logged in currently clear session
    **/

    if(isset($_SESSION['email'])){
        header('Location: admin.php');
    }

    /**
    * If form submitted login
    **/
    if(isset($_POST['submit'])){

        if($_POST['email'] != "" && $_POST['password'] != ""){

            $longinService = new LoginService();
            $validateEmail = $longinService->validatePassword($_POST['email'], $_POST['password']);

            if($validateEmail){
                $_SESSION['email'] = $_POST['email'];
                echo "You will be redirect to admin home page";
                header('Location: admin.php');
            } else {
                echo "Incorrect Credentials";
            }
        } else {
            echo "Please enter an email and password";
        }

    }
?>

<div class="section"></div>
<main>
        <div class="section"></div>

        <div class="section"></div>

        <div class="container">
            <h5 class="brown-text center">Rapids Cemetery Administrative Portal</h5>

            <div class="z-depth-1 grey lighten-4 row">

                <form class="col s6 push-l3 pull-l3" method="post" action="<?php print $_SERVER['PHP_SELF']?>">

                    <br/>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' type='email' name='email' id='email' />
                            <label for='email'>Email</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' type='password' name='password' id='password' />
                            <label for='password'>Password</label>
                        </div>
                    </div>

                    <br/>

                    <div class='row'>
                        <button type='submit' name='submit' value='submit' class='col s12 btn btn-large brown lighten-1 waves-effect brown'>Login</button>
                    </div>

                    <br/>
                    <br/>

                </form>
            </div>
        </div>

    <div class="section"></div>
    <div class="section"></div>
</main>

<?php
    $main->getScripts();
?>
