<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once 'GraveService.class.php';

$graveService = new GraveService();

if($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['action']) && isset($_GET['object']) && isset($_GET['objId'])){
    $action = $_GET['action'];
    $object = $_GET['object'];
    $objId = $_GET['objId'];

    if($action === "create"){
        switch($object){
            case "Location":
                break;
            case "Grave";
                echo $graveService->createGraveForm();
                break;
            case "Flora";
                break;
            case "Miscellaneous";
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
                break;
            case "Grave";
                echo $graveService->updateGraveForm($objId);
                break;
            case "Flora";
                break;
            case "Miscellaneous";
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
        echo "made it to delete";
        switch($object){
            case "Location":
                break;
            case "Grave";
                echo "Delete Grave GET";
                //echo $graveService->deleteGrave($_GET['objId']);
                break;
            case "Flora";
                break;
            case "Miscellaneous";
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

/**
 * Get Requests only used to populate modals, not required for delete because modal is always the same
 */
if($_SERVER['REQUEST_METHOD'] == "POST"){

    echo "in POST";

    if(!empty($_POST['action'])){
        echo "Action: " . $_POST['action'] . "<br/>";
    }

    if(!empty($_POST['object'])){
        echo "Object: " . $_POST['object'] . "<br/>";
    }

    if(!empty($_POST['objId'])){
        echo "ID: " . $_POST['objId'] . "<br/>";
    }
}


if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && !empty($_POST['object']) && !empty($_POST['objId'])){
    $action = $_POST['action'];
    $object = $_POST['object'];
    $objId = $_POST['objId'];

    echo "Made it to Post Request <br/>";

    if($action === "create"){

        switch($object){
            case "Location":
                break;
            case "Grave";
                echo "Made it to create <br/>";
                $graveService->createGrave( $_POST['firstName'],
                                            $_POST['middleName'],
                                            $_POST['lastName'],
                                            $_POST['birth'],
                                            $_POST['death'],
                                            $_POST['description'],
                                            null,
                                            $_POST['longitude'],
                                            $_POST['latitude'],
                                            $_POST['scavengerHuntHint'],
                                            $_POST['imagePath'],
                                            $_POST['imageDescription'],
                                            1,
                                            1);
                //if(!empty[$_POST['firstName']]){ echo "FirstName: " . $_POST['firstName']; }
                break;
            case "Flora";
                break;
            case "Miscellaneous";
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
                break;
            case "Grave";
                echo "Made it to POST UPDATE";
                //$graveService->updateGrave($_POST['idGrave'], $_POST['firstName'], $_POST['middleName'], $_POST['lastName'], $_POST['birth'], $_POST['death'], $_POST['description'],
                break;
            case "Flora";
                break;
            case "Miscellaneous";
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
                break;
            case "Grave";
                echo "Deleting Grave";
                echo $graveService->deleteGrave($objId);
                break;
            case "Flora";
                break;
            case "Miscellaneous";
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