<?php
    ob_start();
    session_start();

    require_once '../components/Main.class.php';
    require_once '../services/LocationService.class.php';
    require_once '../services/GraveService.class.php';
    require_once '../services/FloraService.class.php';
    require_once '../services/NaturalHistoryService.class.php';
    require_once '../services/EventService.class.php';
    require_once '../services/FAQService.class.php';
    require_once '../services/HistoricFilterService.class.php';
    require_once '../services/TypeFilterService.class.php';

    $main = Main::getInstance();
	$main->getAdminHeader();


	if(!isset($_SESSION['email'])){
        header('Location: index.php');
    }

    $main->getAdminSideBar();

	$locationService = new LocationService();
	$graveService = new GraveService();
    $floraService = new FloraService();
	$naturalHistoryService = new NaturalHistoryService();
    $eventService = new EventService();
	$faqService = new FAQService();
	$historicFilterService = new HistoricFilterService();
	$typeFilterService = new TypeFilterService();
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

            //$floraService->createFlora("Tropical Pitcher Plant", "Nepenthes Ventricosa", "Amazing", -77.639081, 43.129468, "Carnivorous Plant", "/image/path", "image descriptions", 1, 2);
            //$floraService->updateFlora(6,"Tropical Pitcher", "Nepenthes truncata", "Amazingadsf", 15, -77.639081, 43.129468, "Carnivorous Plants", "/image/pathasdf", "image descriptionssdf", 1, 2);
            //$floraService->deleteFlora(6);

            //$naturalHistoryService->createNaturalHistory("Amazing Rock", "Made this hill", -77.639091, 43.129478, "What made the area like it is?", "images/images", "images descripty", 1, 3);
            //$naturalHistoryService->updateNaturalHistory(4, "Bryan's Rock", "Why did he do this?", 16, -77.639181, 43.129368, "A good rock", "/image/path", "description of image", 1, 4);
            //$naturalHistoryService->deleteNaturalHistory(4);

            //$eventService->createEvent("Grave Tour", "An amazing tour of all the graves here at Rapids.", "2018-06-13 12:00:00", "2018-06-13 13:00:00", "imagePath", "imageDescription", 1);
            //$eventService->updateEvent(5, "Grave touring amazing", "AHHHH.", "2018-07-13 12:00:00", "2018-07-13 13:00:00", "imagePath2", "imageDescription2", 1)
            //$eventService->deleteEvent(8);

            //$faqService->createFAQ("How are you?", "I'm not sure.", 1);
            //$faqService->updateFAQ(5, "How are you feeling today?", "meh...", 1);
            //$faqService->deleteFAQ(5);

            //$locationService->createLocation("A new hiding spot", "the best place to hide", "url/path/to/image", -77.635576, 43.129375, "abc 123 drive","amazing", "NY", "11111", "image/path","image description", "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=3|FE6256|000000", 7);
            //$locationService->updateLocation(7,"Spongebob's Pineapple", "Where's patrick?", "url/path/to", -77.640953, 43.129256, "abc 123 ","who", "NJ", "222222", "image/pathrer","image descriptionasdf", "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=3|FE6256|000000", 7);
            //$locationService->deleteLocation(7);

            //$historicFilterService->createHistoricFilter("Amazing #2", "ffec89");
            //$historicFilterService->updateHistoricFilter(7, "oh no", "000000");
            //$historicFilterService->deleteHistoricFilter(7);

            //$typeFilterService->createTypeFilter("Tinashe",  "good bops", "http://www.pngall.com/map-marker-png", "FF0000");
            //$typeFilterService->updateAllTypeFilter(6, "Britney", "bops", "/image/", "FFFFF");
            //$typeFilterService->deleteTypeFilter(6);
        ?>

    </div>

    <div class="tabularData">

        <!-- Locations -->
        <div class="navLinks" id="1"> <?php echo $locationService->readLocationTable(); ?> </div>
        <hr>

        <!-- Graves -->
        <div class="navLinks" id="2"> <?php echo $graveService->readGravesTable(); ?></div>
        <hr>

        <!-- Flora -->
        <div class="navLinks" id="3"> <?php echo $floraService->readFloraTable(); ?></div>
        <hr>

        <!-- Miscellaneous -->
        <div class="navLinks" id="4"><?php echo $naturalHistoryService->readNaturalHistoryTable(); ?></div>
        <hr>

        <!-- FAQ -->
        <div class="navLinks" id="5"><?php echo $faqService->readFAQTable(); ?></div>
        <hr>

        <!-- Events -->
        <div class="navLinks" id="6">Events Table</div>
        <hr>

        <!-- Feedback -->
        <div class="navLinks" id="7">Feedback Table</div>
        <hr>

        <!-- Type -->
        <div class="navLinks" id="8">Type Table</div>
        <hr>

        <!-- Historic -->
        <div class="navLinks" id="3">Historic Table</div>

    </div>

    <div id="createModal" class="modal">
        <div class="modal-content">
            <form id="createForm"></form>
        </div>
        <div class="modal-footer">
            <button class='btn waves-effect waves-light modal-close' href='#createModal' type='submit'>Discard</button>
            <button class='btn waves-effect waves-light green modal-trigger' href='#createModal' id='createBtn' type='submit'>Create</button>
        </div>
    </div>

    <div id="updateModal" class="modal">
        <div class="modal-content">
            <form id="updateForm"></form>
        </div>
        <div class="modal-footer">
            <button class='btn waves-effect waves-light modal-close' href='#updateModal' type='submit'>Discard Changes</button>
            <button class='btn waves-effect waves-light green modal-trigger' href='#updateModal' id='updateBtn' type='submit'>Update</button>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content ">
            <h5>Are you sure you would like to delete?</h5>
        </div>
        <div class="modal-footer">
            <button class='btn waves-effect waves-light modal-close' href='#deleteModal' type='submit'> Cancel</button>
            <button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' id='deleteBtn' type='submit'>Delete</button>
        </div>
    </div>

    <?php $main->getAdminScripts(); ?>
    <?php //$main->getFooter(); ?>
</div>



