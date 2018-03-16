<?php
    ob_start();
    session_start();

    include '../components/Main.class.php';

    $main = Main::getInstance();
	$main->getHeader();


	if(!isset($_SESSION['email'])){
        header('Location: index.php');
    }

    $main->getAdminSideBar();
?>




<!-- cust-nav used for media query -->
<nav class="cust-nav">
    <div class="brand-logo">Admin</div>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
</nav>

<!-- main class used for resizing in the media query -->
<div class="main">

    <h1 class="center-align">Rapids Cemetery</h1>

    <div class="tabularData">
        show data formatted as a table here
    </div>

<!--    <form action="#" class="card-panel light-blue lighten-5">-->
<!--        <a class="waves-effect" href="#!"><i class="material-icons">add_circle</i>Add Grave</a>-->
<!---->
<!--        <div class="row">-->
<!--            <div class="input-field col s4">-->
<!--                <input id="first_name" type="text" class="validate">-->
<!--                <label for="first_name">First Name</label>-->
<!--            </div>-->
<!--            ?>-->
<!---->
<!--            <div class="input-field col s4">-->
<!--                <input id="middle_name" type="text" class="validate">-->
<!--                <label for="middle_name">Middle Name</label>-->
<!--            </div>-->
<!---->
<!--            <div class="input-field col s4">-->
<!--                <input id="last_name" type="text" class="validate">-->
<!--                <label for="last_name">Last Name</label>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="row">-->
<!--            <label for="birth" class="col s12">Birthdate:</label>-->
<!--            <div id="birth" class="input-field">-->
<!--                <div class="input-field col s2">-->
<!--                    <input id="birthmonth" type="text" class="validate" data-length="2" />-->
<!--                    <label for="birthmonth">Month</label>-->
<!--                </div>-->
<!--                <div class="input-field col s2">-->
<!--                    <input id="birthday" type="text" class="validate" data-length="2" />-->
<!--                    <label for="birthday">Day</label>-->
<!--                </div>-->
<!--                <div class="input-field col s2">-->
<!--                    <input id="birthyear" type="text" class="validate" data-length="4" />-->
<!--                    <label for="birthyear">Year</label>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <label for="death" class="col s12">Deathdate:</label>-->
<!--            <div id="death" class="input-field">-->
<!--                <div class="input-field col s2">-->
<!--                    <input id="deathmonth" type="text" class="validate" data-length="2" />-->
<!--                    <label for="deathmonth">Month</label>-->
<!--                </div>-->
<!--                <div class="input-field col s2">-->
<!--                    <input id="deathday" type="text" class="validate" data-length="2" />-->
<!--                    <label for="deathday">Day</label>-->
<!--                </div>-->
<!--                <div class="input-field col s2">-->
<!--                    <input id="deathyear" type="text" class="validate" data-length="4" />-->
<!--                    <label for="deathyear">Year</label>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="row">-->
<!--                <div class="input-field col s12">-->
<!--                    <textarea id="desc" class="materialize-textarea"></textarea>-->
<!--                    <label for="desc">Description</label>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </form>-->
<!---->
<!---->
<!--    <form action="#" class="card-panel light-blue lighten-5">-->
<!--        <a class="waves-effect" href="#!"><i class="material-icons">add_circle</i>Add Vegetation</a>-->
<!---->
<!--        <div class="row">-->
<!--            <div class="input-field col s12">-->
<!--                <input id="common_name" type="text" class="validate">-->
<!--                <label for="common_name">Common Name</label>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="row">-->
<!--            <div class="input-field col s12">-->
<!--                <input id="sci_name" type="text" class="validate">-->
<!--                <label for="sci_name">Scientific Name</label>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="row">-->
<!--            <div class="input-field col s12">-->
<!--                <textarea id="desc" class="materialize-textarea"></textarea>-->
<!--                <label for="desc">Description</label>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--</div>-->
<!--</form>-->


    <?php $main->getScripts(); ?>
    <?php $main->getFooter(); ?>
</div>



