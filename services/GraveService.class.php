<?php

include '../data/GraveData.class.php';
include '../models/Grave.class.php';

class GraveService {

    public function readAllGravesAsObjects(){
        $graveData = new GraveData();
        $graves = $graveData->readAllGraves();
        $allGraves = array();

        foreach($graves as $grave){
            $newGrave = new Grave(
                $grave['idGrave'],
                $grave['firstName'],
                $grave['middleName'],
                $grave['lastName'],
                $grave['birth'],
                $grave['death'],
                $grave['description'],
                $grave['idHistoricFilter'],
                $grave['idTrackableObject'],
                $grave['longitude'],
                $grave['latitude'],
                $grave['scavengerHuntHint'],
                $grave['imagePath'],
                $grave['imageDescription'],
                $grave['idLocation'],
                $grave['idType']
            );

            array_push($allGraves, $newGrave);
        };

        return $allGraves;
    }
}

?>