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
        echo "made it to create";

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
        echo "made it to update";
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
        echo "Action: " . $_POST['action'];
    }

    if(!empty($_POST['object'])){
        echo "Object: " . $_POST['object'];
    }

    if(!empty($_POST['objId'])){
        echo "ID: " . $_POST['objId'];
    }
}


if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && !empty($_POST['object']) && !empty($_POST['objId'])){
    $action = $_POST['action'];
    $object = $_POST['object'];
    $objId = $_POST['objId'];

    echo "Made it to Post Request <br/>";

    if($action === "create"){
        echo "Made it to create";

        switch($object){
            case "Location":
                break;
            case "Grave";
                echo "made it to delete Grave </br>";
                //echo $graveService->createGraveForm();
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
        echo "made it to delete <br/>";
        switch($object){
            case "Location":
                break;
            case "Grave";
                echo "Deleting Grave";
                //echo $graveService->deleteGrave($objId);
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





//if(isset($_GET['action']) && isset($_GET['object'])){



//}

/**
 * Used to perform database modifications
 */
//if(isset($_POST['action']) && isset($_POST['object'])){
//    echo $_POST['action'];
//    echo $_POST['object'];
//
//    if($_POST['action'] == "create"){
//        switch($_POST['object']){
//            case "Location":
//                break;
//            case "Grave";
//                break;
//            case "Flora";
//                break;
//            case "Miscellaneous";
//                break;
//            case "FAQs";
//                break;
//            case "Events";
//                break;
//            case "Feedback";
//                break;
//            case "Type";
//                break;
//            case "HistoricalFilter";
//                break;
//        }
//    }
//
//    else if(isset($_POST['action']) == "update" && isset($_POST['objId'])){
//        switch($_POST['object']){
//            case "Location":
//                break;
//            case "Grave";
//                break;
//            case "Flora";
//                break;
//            case "Miscellaneous";
//                break;
//            case "FAQs";
//                break;
//            case "Events";
//                break;
//            case "Feedback";
//                break;
//            case "Type";
//                break;
//            case "HistoricalFilter";
//                break;
//        }
//    }
//
//    else if(isset($_POST['action']) == "delete" && isset($_POST['objId'])){
//        switch($_POST['object']){
//            case "Location":
//                break;
//            case "Grave";
//                echo 'Deleing Grave Object';
//                $graveService->deleteGrave($_POST['objId']);
//                break;
//            case "Flora";
//                break;
//            case "Miscellaneous";
//                break;
//            case "FAQs";
//                break;
//            case "Events";
//                break;
//            case "Feedback";
//                break;
//            case "Type";
//                break;
//            case "HistoricalFilter";
//                break;
//        }
//    }
//
//}


// Populate Edit Modal Forms

//if(isset($_GET['modalAction'])){
//    switch($_GET['modalAction']){
//        case "createGrave":
//            echo $graveService->createGraveForm();
//        break;
//            case "updateGrave";
//        break;
//    }
//}

?>