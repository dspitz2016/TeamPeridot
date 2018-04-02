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
require_once 'ContactService.class.php';


$graveService = new GraveService();
$locationService = new LocationService();
$floraService = new FloraService();
$naturalHistoryService = new NaturalHistoryService();
$faqService = new FAQService();
$eventService = new EventService();
$typeFilterService = new TypeFilterService();
$historicFilterService = new HistoricFilterService();
$contactService = new ContactService();

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
                echo $faqService->createFAQForm();
                break;
            case "Events";
                echo $eventService->createEventForm();
                break;
            case "Type";
                echo $typeFilterService->createTypeForm();
                break;
            case "HistoricFilter";
                echo $historicFilterService->createHistoricFilterForm();
                break;
            case "Contact";
                echo $contactService->createContactForm();
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
                echo $faqService->updateFAQForm($objId);
                break;
            case "Events";
                echo $eventService->updateEventForm($objId);
                break;
            case "Type";
                echo $typeFilterService->updateTypeForm($objId);
                break;
            case "HistoricFilter";
                echo $historicFilterService->updateHistoricFilterForm($objId);
                break;
            case "Contact";
                echo $contactService->updateContactForm($objId);
                break;
            default:
                echo "update default";
        }

    }
}

if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && !empty($_POST['object']) && !empty($_POST['objId'])){
    $action = $_POST['action'];
    $object = $_POST['object'];
    $objId = $_POST['objId'];

    if($action === "create"){

        switch($object){
            case "Location":
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
                    1, // Always Rapids
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
                    1, // Always Rapids
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
                    1, // Always Rapids
                    3); // Always Misc
                break;
            case "FAQs";
                $faqService->createFAQ(
                    $_POST['question'],
                    $_POST['answer'],
                    1 // Always Rapids
                );
                break;
            case "Events";
                $eventService->createEvent(
                    $_POST['name'],
                    $_POST['description'],
                    $_POST['startTime'],
                    $_POST['endTime'],
                    "",
                    "",
                    1); // Always Rapids
                break;
            case "Type";
                $typeFilterService->createTypeFilter(
                    $_POST['typeFilter'],
                    $_POST['description'],
                    $_POST['pinDesign'],
                    $_POST['buttonColor']
                );
                break;
            case "HistoricFilter";
                $historicFilterService->createHistoricFilter(
                    $_POST['historicFilter'],
                    $_POST['buttonColor']
                );
                break;
            case "Contact";
                $contactService->createContact(
                    $_POST['firstName'],
                    $_POST['lastName'],
                    $_POST['email'],
                    $_POST['title'],
                    $_POST['description'],
                    1 // Always Rapids
                );
                break;
            default:
                echo "create default";
        }
    }

    if($action === "update"){
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
                $graveService->updateGrave(
                    $_POST['idGrave'],
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
                    1, // Always Rapids
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
                    1, // Always Rapids
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
                    1, // Always Rapids
                    3);
                break;
            case "FAQs";
                $faqService->updateFAQ(
                    $_POST['idFAQ'],
                    $_POST['question'],
                    $_POST['answer'],
                    1 // Always Rapids
                );
                break;
            case "Events";
                $eventService->updateEvent(
                    $_POST['idEvent'],
                    $_POST['name'],
                    $_POST['description'],
                    $_POST['startTime'],
                    $_POST['endTime'],
                    "",
                    "",
                    1);// Always Rapids
                break;
            case "Type";
                $typeFilterService->updateTypeFilter(
                    $_POST['idType'],
                    $_POST['typeFilter'],
                    $_POST['description'],
                    $_POST['buttonColor']
                );
                break;
            case "HistoricFilter";
                $historicFilterService->updateHistoricFilter(
                    $_POST['idHistoricFilter'],
                    $_POST['historicFilter'],
                    $_POST['buttonColor']
                );
                break;
            case "Contact";
                $contactService->updateContact(
                    $_POST['idContact'],
                    $_POST['firstName'],
                    $_POST['lastName'],
                    $_POST['email'],
                    $_POST['title'],
                    $_POST['description'],
                    1 // Always Rapids
                );
                break;
            default:
                echo "update default";
        }

    }

    if($action === "delete"){
        switch($object){
            case "Location":
                $locationService->deleteLocation($objId);
                break;
            case "Grave";
                $graveService->deleteGrave($objId);
                break;
            case "Flora";
                $floraService->deleteFlora($objId);
                break;
            case "Miscellaneous";
                $naturalHistoryService->deleteNaturalHistory($objId);
                break;
            case "FAQs";
                $faqService->deleteFAQ($objId);
                break;
            case "Events";
                $eventService->deleteEvent($objId);
                break;
            case "Type";
                echo $typeFilterService->deleteTypeFilter($objId);
                break;
            case "HistoricFilter";
                $historicFilterService->deleteHistoricFilter($objId);
                break;
            case "Contact";
                $contactService->deleteContact($objId);
                break;
            default:
                echo "delete default";
        }
    }
}


?>