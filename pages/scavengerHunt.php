<?php

include '../components/Main.class.php';
include '../services/MapService.class.php';

$main = Main::getInstance();
$main->getHeader("main");
$main->getNavigationBar();

$mapService = new MapService();
?>

<h1>Scavenger Hunt Page</h1>

<h4>To do</h4>
<ul>
    <li>1. Fix Pin Size</li>
    <li>2. Add User buttons for interactions, move to next object, tell me where it is</li>
    <li>3. Onclick next show next hint</li>
    <li>4. Onclick tell me where it is, change icon where idTrackableObject = clicked object</li>
</ul>
<div id="map"></div>


<script type="text/javascript">

    var map, infoWindow;
    var markerAry = [];

    function initMap() {

        // Scavenger hunt is random pull of trackable objects
        <?php echo $mapService->initMap($mapService->getAllScavengerHuntObjectsAsPins(),43.129467, -77.639153, 20); ?>

        // Display All pins

        // When user selects Tell me where it is correct pin is highlighted
        // In Array of markers highlight the one where idTrackable = observed pin
    }

</script>

<div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxPGQ8GD6zL36rlXs-o2AE-RAOsZYpvbQ&callback=initMap" async defer></script>

<?php $main->getScripts("main"); ?>
<?php $main->getFooter(); ?>

