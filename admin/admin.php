<?php
    ob_start();
    session_start();
    date_default_timezone_set('America/New_York');

    require_once '../components/Main.class.php';
    require_once '../services/LocationService.class.php';
    require_once '../services/GraveService.class.php';
    require_once '../services/FloraService.class.php';
    require_once '../services/NaturalHistoryService.class.php';
    require_once '../services/EventService.class.php';
    require_once '../services/FAQService.class.php';
    require_once '../services/HistoricFilterService.class.php';
    require_once '../services/TypeFilterService.class.php';
    require_once '../services/ContactService.class.php';

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
	$contactService = new ContactService();
?>

<!-- cust-nav used for media query -->
<nav class="cust-nav">
    <div class="brand-logo">Admin</div>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
</nav>

<!-- main class used for resizing in the media query -->
<div class="main">

    <div class="tabularData">

        <!-- Locations -->
        <div class="navLinks" id="1"> <?php echo $locationService->readLocationTable(); ?> </div>

        <!-- Graves -->
        <div class="navLinks" id="2"> <?php echo $graveService->readGravesTable(); ?></div>

        <!-- Flora -->
        <div class="navLinks" id="3"> <?php echo $floraService->readFloraTable(); ?></div>

        <!-- Miscellaneous -->
        <div class="navLinks" id="4"><?php echo $naturalHistoryService->readNaturalHistoryTable(); ?></div>

        <!-- FAQ -->
        <div class="navLinks" id="5"><?php echo $faqService->readFAQTable(); ?></div>

        <!-- Events -->
        <div class="navLinks" id="6"><?php echo $eventService->readEventsTable(); ?></div>

        <!-- Type -->
        <div class="navLinks" id="7"><?php echo $typeFilterService->readTypeTable(); ?></div>


        <!-- Historic -->
        <div class="navLinks" id="8"><?php echo $historicFilterService->readHistoricFilterTable(); ?></div>

        <!-- Contacts -->
        <div class="navLinks" id="9"><?php echo $contactService->readContactTable(); ?></div>


    </div>

    <div id="createModal" class="modal admin-modal">
        <div class="modal-content">
            <form id="createForm"></form>
        </div>
        <div class="modal-footer">
            <button class='btn waves-effect waves-light modal-close' href='#createModal' type='submit'>Discard</button>
            <button class='btn waves-effect waves-light green modal-trigger' href='#createModal' id='createBtn' type='submit'>Create</button>
        </div>
    </div>

    <div id="updateModal" class="modal admin-modal">
        <div class="modal-content">
            <form id="updateForm"></form>
        </div>
        <div class="modal-footer">
            <button class='btn waves-effect waves-light modal-close' href='#updateModal' type='submit'>Discard Changes</button>
            <button class='btn waves-effect waves-light green modal-trigger' href='#updateModal' id='updateBtn' type='submit'>Update</button>
        </div>
    </div>

    <div id="deleteModal" class="modal admin-modal">
        <div class="modal-content ">
        </div>
        <div class="modal-footer">
        </div>
    </div>

    <?php $main->getAdminScripts(); ?>
    <?php //$main->getFooter(); ?>
</div>



