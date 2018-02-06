<?php
    include '../../components/Main.class.php';
    include '../../services/LoginService.class.php';

    $main = Main::getInstance();
    $main->getHeader("admin");

    /**
    * If someone is logged in currently clear session
    **/
    if($_SESSION['email']){
        echo "Email Unset";
        sesion_unset();
    }

    /**
    * If form submitted login
    **/
    if(isset($_POST['submit'])){
        echo "Submit clicked and being processed <br/>";
        if($_POST['email'] != "" && $_POST['password'] != ""){

            $validateEmail = LoginService::getInstance()->validatePassword($_POST['email'], $_POST['password']);
            echo "Validate Email: " . $vaildateEmail . "<br/>";
            var_dump($validateEmail);

            if($validateEmail){
                $_SESSION['email'] = $_POST['email'];
                echo "You will be redirect to admin home page";
                header('Location: admin.php');
            } else {
                echo "Incorrect Credentials";
                header('Location: adminLogin.php');
            }
        } else {
            echo "Please enter an email and password";
        }

    }
?>

<div class="section"></div>
<main>
    <center>
        <!--
              <img class="responsive-img" style="width: 250px;" src="https://i.imgur.com/ax0NCsK.gif" />
        -->
        <div class="section"></div>

        <h5 class="brown-text">Please, login into your account</h5>
        <div class="section"></div>

        <div class="container">
            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                <form class="col s12" method="post" action="<?php print $_SERVER['PHP_SELF']?>">
                    <div class='row'>
                        <div class='col s12'>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' type='email' name='email' id='email' />
                            <label for='email'>Enter your email</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' type='password' name='password' id='password' />
                            <label for='password'>Enter your password</label>
                        </div>
                        <label style='float: right;'>
                            <a class='pink-text' href='#!'><b>Forgot Password?</b></a>
                        </label>
                    </div>

                    <br />
                    <center>
                        <div class='row'>
                            <button type='submit' name='submit' value='submit' class='col s12 btn btn-large brown lighten-1 waves-effect brown'>Login</button>
                        </div>
                    </center>
                </form>
            </div>
        </div>
        <a href="#!">Create account</a>
    </center>

    <div class="section"></div>
    <div class="section"></div>
</main>

<?php
    $main->getScripts("admin");
    $main->getFooter();
?>