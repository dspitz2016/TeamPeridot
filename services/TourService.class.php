<?php
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../data/TourData.class.php';
require_once '../models/Tour.class.php';

class TourService {

    // CREATE

    // READ
    public function getAllTours(){
        $tourData = new TourData();
        $toursData = $tourData->getTourOptions();
        $allTours = array();

        foreach($toursData as $tour){
            $newTour = new Tour(
                $tour['idTour'],
                $tour['name'],
                $tour['description']
            );

            array_push($allTours, $newTour);
        };

        return $allTours;
    }

    // UPDATE

    // DELETE


}

?>