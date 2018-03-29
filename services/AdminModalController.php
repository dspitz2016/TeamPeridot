<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once 'GraveService.class.php';
require_once 'LocationService.class.php';
require_once 'FloraService.class.php';
require_once 'NaturalHistoryService.class.php';
require_once 'FAQService.class.php';
require_once 'EventService.class.php';
require_once 'TypeFilterService.class.php';
require_once 'HistoricFilterService.class.php';


$graveService = new GraveService();
$locationService = new LocationService();
$floraService = new FloraService();
$naturalHistoryService = new NaturalHistoryService();
$faqService = new FAQService();
$eventService = new EventService();
$typeFilterService = new TypeFilterService();
$historicFilterService = new HistoricFilterService();

if($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['action']) && isset($_GET['object']) && isset($_GET['objId'])){
    $action = $_GET['action'];
    $object = $_GET['object'];
    $objId = $_GET['objId'];

    if($action === "create"){
        switch($object){
            case "Location":
                echo $locationService->createLocationForm();
                break;
            case "Grave";
                echo $graveService->createGraveForm();
                break;
            case "Flora";
                echo $floraService->createFloraForm();
                break;
            case "Miscellaneous";
                echo $naturalHistoryService->createNaturalHistoryForm();
                break;
            case "FAQs";
                break;
            case "Events";
                break;
            case "Feedback";
                break;
            case "Type";
                break;
            case "HistoricalFilter";
                break;
            default:
                echo "create default";
        }
    }

    if($action === "update"){
        switch($object){
            case "Location":
                echo $locationService->updateLocationForm($objId);
                break;
            case "Grave";
                echo $graveService->updateGraveForm($objId);
                break;
            case "Flora";
                echo $floraService->updateFloraForm($objId);
                break;
            case "Miscellaneous";
                echo $naturalHistoryService->updateNaturalHistoryForm($objId);
                break;
            case "FAQs";
                break;
            case "Events";
                break;
            case "Feedback";
                break;
            case "Type";
                break;
            case "HistoricalFilter";
                break;
            default:
                echo "update default";
        }

    }
}

/**
 * Get Requests only used to populate modals, not required for delete because modal is always the same
 */
//if($_SERVER['REQUEST_METHOD'] == "POST"){
//
//    echo "in POST";
//
//    if(!empty($_POST['action'])){
//        echo "Action: " . $_POST['action'] . "<br/>";
//    }
//
//    if(!empty($_POST['object'])){
//        echo "Object: " . $_POST['object'] . "<br/>";
//    }
//
//    if(!empty($_POST['objId'])){
//        echo "ID: " . $_POST['objId'] . "<br/>";
//    }
//}


if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && !empty($_POST['object']) && !empty($_POST['objId'])){
    $action = $_POST['action'];
    $object = $_POST['object'];
    $objId = $_POST['objId'];

    echo "Made it to Post Request <br/>";

    if($action === "create"){

        switch($object){
            case "Location":
                echo "Made it to create Location";
                $locationService->createLocation(
                    $_POST['name'],
                    $_POST['description'],
                    $_POST['url'],
                    $_POST['longitude'],
                    $_POST['latitude'],
                    $_POST['address'],
                    $_POST['city'],
                    $_POST['state'],
                    $_POST['zipcode'],
                    $_POST['imagePath'],
                    $_POST['imageDescription'],
                    $_POST['pinDesign'],
                    $_POST['trailOrder']
                );

                break;
            case "Grave";
                echo "Made it to create <br/>";
                $graveService->createGrave(
                    $_POST['firstName'],
                    $_POST['middleName'],
                    $_POST['lastName'],
                    $_POST['birth'],
                    $_POST['death'],
                    $_POST['description'],
                    $_POST['idHistoricFilter'],
                    $_POST['longitude'],
                    $_POST['latitude'],
                    $_POST['scavengerHuntHint'],
                    $_POST['imagePath'],
                    $_POST['imageDescription'],
                    $_POST['idLocation'],
                    1); // Always Grave
                break;
            case "Flora";
                $floraService->createFlora(
                    $_POST['commonName'],
                    $_POST['scientificName'],
                    $_POST['description'],
                    $_POST['longitude'],
                    $_POST['latitude'],
                    $_POST['scavengerHuntHint'],
                    $_POST['imagePath'],
                    $_POST['imageDescription'],
                    1,
                    2); // Always Flora
                break;
            case "Miscellaneous";
                $naturalHistoryService->createNaturalHistory(
                    $_POST['name'],
                    $_POST['description'],
                    $_POST['longitude'],
                    $_POST['latitude'],
                    $_POST['scavengerHuntHint'],
                    $_POST['imagePath'],
                    $_POST['imageDescription'],
                    1,
                    3);
                break;
            case "FAQs";
                break;
            case "Events";
                break;
            case "Feedback";
                break;
            case "Type";
                break;
            case "HistoricalFilter";
                break;
            default:
                echo "create default";
        }
    }

    if($action === "update"){
        echo "made it to update post";
        switch($object){
            case "Location":
                $locationService->updateLocation(
                  $_POST['idLocation'],
                  $_POST['name'],
                  $_POST['description'],
                  $_POST['url'],
                  $_POST['longitude'],
                  $_POST['latitude'],
                  $_POST['address'],
                  $_POST['city'],
                  $_POST['state'],
                  $_POST['zipcode'],
                  $_POST['imagePath'],
                  $_POST['imageDescription'],
                  $_POST['pinDesign'],
                  $_POST['trailOrder']
                );
                break;
            case "Grave";
                echo "Made it to POST UPDATE";
                $graveService->updateGrave($_POST['idGrave'],
                                           $_POST['firstName'],
                                           $_POST['middleName'],
                                           $_POST['lastName'],
                                           $_POST['birth'],
                                           $_POST['death'],
                                           $_POST['description'],
                                           $_POST['idHistoricFilter'],
                                           $_POST['idTrackableObject'],
                                           $_POST['longitude'],
                                           $_POST['latitude'],
                                           $_POST['scavengerHuntHint'],
                                           $_POST['imagePath'],
                                           $_POST['imageDescription'],
                                           $_POST['idLocation'],
                                           1); // Always Grave
                break;
            case "Flora";
                $floraService->updateFlora(
                    $_POST['idFlora'],
                    $_POST['commonName'],
                    $_POST['scientificName'],
                    $_POST['description'],
                    $_POST['idTrackableObject'],
                    $_POST['longitude'],
                    $_POST['latitude'],
                    $_POST['scavengerHuntHint'],
                    $_POST['imagePath'],
                    $_POST['imageDescription'],
                    1,
                    2); // Always Flora
                break;
            case "Miscellaneous";
                $naturalHistoryService->updateNaturalHistory(
                    $_POST['idNaturalHistory'],
                    $_POST['name'],
                    $_POST['description'],
                    $_POST['idTrackableObject'],
                    $_POST['longitude'],
                    $_POST['latitude'],
                    $_POST['scavengerHuntHint'],
                    $_POST['imagePath'],
                    $_POST['imageDescription'],
                    1,
                    2);
                break;
            case "FAQs";
                break;
            case "Events";
                break;
            case "Feedback";
                break;
            case "Type";
                break;
            case "HistoricalFilter";
                break;
            default:
                echo "update default";
        }

    }

    if($action === "delete"){
        echo "made it to delete <br/>";
        switch($object){
            case "Location":
                $locationService->deleteLocation($objId);
                break;
            case "Grave";
                echo "Deleting Grave";
                $graveService->deleteGrave($objId);
                break;
            case "Flora";
                $floraService->deleteFlora($objId);
                break;
            case "Miscellaneous";
                $naturalHistoryService->deleteNaturalHistory($objId);
                break;
            case "FAQs";
                break;
            case "Events";
                break;
            case "Feedback";
                break;
            case "Type";
                break;
            case "HistoricalFilter";
                break;
            default:
                echo "delete default";
        }
    }
}


?>