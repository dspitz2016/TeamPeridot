<?php
date_default_timezone_set('GMT');

include '../components/Main.class.php';
include '../services/MapService.class.php';
include '../components/FilterBar.class.php';

include '../services/EventService.class.php';

$main = Main::getInstance();
$main->getHeader();
$main->getNavigationBar();

$mapService = new MapService();

?>


<div class="parallax-container">
    <div class="row overlay z-depth-5">
        <div class="col s12">
            <h3 id="header-title">Welcome to Rapids Cemetery!</h3>
            <p class="text-darken-3 lighten-3">
                This cemetery was probably founded between 1810 and 1812. The property was originally owned by the
                Wadsworth family which owned land from Geneseo to Rochester. The Wadsworths set aside one and a quarter
                acre for a burial place of area residents. The cemetery resided in the Town of Gates until 1902 when the
                area was annexed into the City of Rochester. The road leading to the cemetery was originally called
                Cemetery Road. Then between 1880 and 1890 the name was changed to Chester Street. In 1899, Chester
                Street became Congress Avenue.
                <br/><br/>
                19th Ward Community Association --- 216 Thurston Road Rochester, NY 14619 --- Phone: (585) 328-6571 ----
                19thWard@19wca.org
            </p>
        </div>
    </div>

    <div class="parallax grey lighten-1">
        <img src="https://www.gannett-cdn.com/-mm-/f924d923a0260fd170c12b5a1c21c61aa1590bc4/c=0-222-2163-1444&r=x803&c=1600x800/local/-/media/2015/11/10/Rochester/Rochester/635827519552760428-TY-110815-RAPIDS-CEMETERY-I.JPG">
    </div>
</div>

<!---->
<!--<div class="section cust-color-white">-->
<!---->
<!--    <div class="row container">-->
<!--        <div class="col s12">-->
<!--            <h3 class="header">Welcome to Rapids Cemetery!</h3>-->
<!--            <p class="grey-text text-darken-3 lighten-3">-->
<!--                This cemetery was probably founded between 1810 and 1812. The property was originally owned by the Wadsworth family which owned land from Geneseo to Rochester. The Wadsworths set aside one and a quarter acre for a burial place of area residents. The cemetery resided in the Town of Gates until 1902 when the area was annexed into the City of Rochester. The road leading to the cemetery was originally called Cemetery Road. Then between 1880 and 1890 the name was changed to Chester Street. In 1899, Chester Street became Congress Avenue.-->
<!--                <br/><br/>-->
<!--                19th Ward Community Association --- 216 Thurston Road Rochester, NY 14619 --- Phone: (585) 328-6571 ---- 19thWard@19wca.org-->
<!--            </p>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="section cust-color-rust">
    <div class="row container white-text">

        <div class="col s12 m4 l4 center-align">
            <h5>Historical Trails</h5>
            <i class="large material-icons">map</i>
            <p class="center-align">
                Learn the history of Rochester, NY!
            </p>
        </div>
        <div class="col s12 m4 l4 center-align">
            <h5>Learn About the Cemetery</h5>
            <i class="large material-icons">search</i>
            <p class="center-align">
                The graves, natural history, and flora.
            </p>
        </div>
        <div class="col s12 m4 l4 center-align">
            <h5>Schedule Events!</h5>
            <i class="large material-icons">schedule</i>
            <p class="center-align">
                Schedule an event with us.
            </p>
        </div>

    </div>
</div>

<?php
$filterBar = new FilterBar();
$filterBar->getTypeFilterBar($mapService->getTypeFilters());
$filterBar->getHistoricFilterBar($mapService->getHistoricFilters());
?>

<div id="map"></div>

<?php
$eventService = new EventService();
echo $eventService->getAllStyledHTMLEvents();
?>


<div id="modal" class="modal bottom-sheet">
    <div class="modal-content center">

    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Return to Map </a>
    </div>
</div>

<script type="text/javascript">

    var map, infoWindow;
    var markerAry = [];

    function initMap() {

        <?php echo $mapService->initMap($mapService->getAllTrackableObjectsAsPins(), 43.129467, -77.639153, 20, "HYBRID", false); ?>

    }

</script>

<?php $main->getScripts(); ?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxPGQ8GD6zL36rlXs-o2AE-RAOsZYpvbQ&callback=initMap" async
        defer></script>

<?php $main->getFooter(); ?>
