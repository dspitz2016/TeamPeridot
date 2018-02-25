<?php

Class TourData {

    public function getTourOptions(){
        return ConnectDb::getInstance()->returnObject("Tour.Class", "Select idTour, name, description from Tour;");
    }

    public function getTourItems(){
        return ConnectDb::getInstance()->returnObject("TourItem.Class", "Select idTrackableObject, idLocation, idAccount, idTour from TourItem;");
    }
}

?>