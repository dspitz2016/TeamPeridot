<?php
    ob_start();
    session_start();

    include '../components/Main.class.php';
    include '../services/LocationService.class.php';
    include '../services/GraveService.class.php';
    include '../services/EventService.class.php';
    include '../services/FAQService.class.php';

    $main = Main::getInstance();
	$main->getAdminHeader();


	if(!isset($_SESSION['email'])){
        header('Location: index.php');
    }

    $main->getAdminSideBar();

	$locationService = new LocationService();
	$graveService = new GraveService();
	$eventService = new EventService();
	$faqService = new FAQService();
?>

<!-- cust-nav used for media query -->
<nav class="cust-nav">
    <div class="brand-logo">Admin</div>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
</nav>

<!-- main class used for resizing in the media query -->
<div class="main">
    <div class="section">
        <?php
            //$graveService->createGrave("Dustin", "Tyler", "Spitz", "1994-06-27", "2018-03-17", "I Tried...", 4, -77.639091, 43.129458, "You might find him", "", "", 1,1);
            //$graveService->createGrave("John", "J.", "Smith", "1974-06-27", "2018-03-17", "Do words like this work? I don't know hmm.", "", -77.63913, 43.12935, "You might find him here ' 's", "test", "tester", 1,1);
            //$graveService->updateGrave(6, "Jimmy", "B.", "Smithy", "1999-06-27", "2000-03-17", "abc", "", 14, -77.63913, 43.12935, "You who what me", "tester", "testertester", 1,1);
            //$graveService->deleteGrave(6);

            //$eventService->createEvent("Grave Tour", "An amazing tour of all the graves here at Rapids.", "2018-06-13 12:00:00", "2018-06-13 13:00:00", "imagePath", "imageDescription", 1);
            //$eventService->updateEvent(5, "Grave touring amazing", "AHHHH.", "2018-07-13 12:00:00", "2018-07-13 13:00:00", "imagePath2", "imageDescription2", 1)
            //$eventService->deleteEvent(8);

            //$faqService->createFAQ("How are you?", "I'm not sure.", 1);
            //$faqService->updateFAQ(5, "How are you feeling today?", "meh...", 1);
            //$faqService->deleteFAQ(5);

            //$locationService->createLocation("A new hiding spot", "the best place to hide", "url/path/to/image", -77.635576, 43.129375, "abc 123 drive","amazing", "NY", "11111", "image/path","image description", "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=3|FE6256|000000", 7);
            //$locationService->updateLocation(7,"Spongebob's Pineapple", "Where's patrick?", "url/path/to", -77.640953, 43.129256, "abc 123 ","who", "NJ", "222222", "image/pathrer","image descriptionasdf", "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=3|FE6256|000000", 7);
            //$locationService->deleteLocation(7);

        ?>

    </div>

    <div class="tabularData">
        <?php echo $locationService->readLocationTable(); ?>
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



