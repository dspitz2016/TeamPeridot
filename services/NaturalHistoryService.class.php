<?php

require_once '../data/NaturalHistoryData.class.php';
require_once '../models/NaturalHistory.class.php';
require_once 'TrackableObjectService.class.php';

class NaturalHistoryService extends TrackableObjectService {

    private $trackableObjectService;
    private $naturalHistoryData;

    /**
     * NaturalHistoryService constructor.
     * @param $trackableObjectService
     * @param $naturalHistoryData
     */
    public function __construct()
    {
        $this->trackableObjectService = new TrackableObjectService();
        $this->naturalHistoryData = new NaturalHistoryData();
    }

    public function createNaturalHistory($name, $description,
                                         $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType){
        // Sanitize
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $lastNaturalHistoryID = $this->naturalHistoryData->createNaturalHistory($name, $description);
        $lastTrackableObjectID = $this->trackableObjectService->createTrackableObject($longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);
        $this->trackableObjectService->updateReferencedTrackableObject($lastTrackableObjectID, $lastNaturalHistoryID, "NaturalHistory");
    }

    public function updateNaturalHistory($idNaturalHistory, $name, $description,
                                         $idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType){
        $idNaturalHistory = filter_var($idNaturalHistory, FILTER_SANITIZE_NUMBER_INT);
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);

        $this->naturalHistoryData->updateNaturalHistory($idNaturalHistory, $name, $description);
        $this->trackableObjectService->updateTrackableObject($idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);

    }

    public function deleteNaturalHistory($idNaturalHistory){
        $idNaturalHistory = filter_var($idNaturalHistory, FILTER_SANITIZE_NUMBER_INT);
        ConnectDb::getInstance()->deleteObject($idNaturalHistory, "NaturalHistory");
    }


}


?>