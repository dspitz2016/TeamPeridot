<?php
ob_start();
session_start();

include '../components/Main.class.php';
include '../services/LoginService.class.php';

$main = Main::getInstance();
$main->getHeader();

$errorMsg = '';

/**
 * If someone is logged in currently clear session
 **/

if (isset($_SESSION['email'])) {
    header('Location: admin.php');
}

/**
 * If form submitted login
 **/
if (isset($_POST['submit'])) {

    if ($_POST['email'] != "" && $_POST['password'] != "") {

        $longinService = new LoginService();
        $validateEmail = $longinService->validatePassword($_POST['email'], $_POST['password']);

        if ($validateEmail) {
            $_SESSION['email'] = $_POST['email'];
            header('Location: admin.php');
        } else {
            $errorMsg = "Incorrect email and password combination.";
        }
    } else {
        $errorMsg = "Incorrect email and password combination.";
    }

}
?>

<div class="container">
    <div class="section"></div>
    <div class="section"></div>


    <div class='row'>
        <div class='card col s8 offset-s2 m4 offset-m4 l4 offset-l4'>
            <div class='card-panel cust-color-rust'>
                <span class='card-title white-text center-align'>Rapids Cemetery <br/> Admin Portal</span>

            </div>

            <div class='card-content'>
                <form class='row' method='post'
                      action='<?php print $_SERVER['PHP_SELF'] ?>'>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <i class="material-icons prefix">email</i>
                            <input id='icon_prefix' class='validate' type='email' name='email' id='email'/>
                            <label for='icon_prefix'>Email</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <i class="material-icons prefix">lock</i>

                            <input id='icon_prefix' validate' type='password' name='password' id='password'/>
                            <label for='icon_prefix'>Password</label>
                        </div>
                    </div>

                    <div class='row warning'>
                        <div class="col s12 red-text center-align section ">
                            <?php echo $errorMsg; ?>
                        </div>
                    </div>

                    <div class='row center'>
                        <button type='submit' name='submit' value='submit'
                                class='btn btn-large brown lighten-1 waves-effect brown'>Login
                        </button>
                    </div>

                    <br/>
                </form>
            </div>

        </div>
    </div>

    <div class="section"></div>
    <div class="section"></div>

    <?php
    $main->getScripts();
    ?>
