<?php
require_once 'TrackableObject.class.php';

class NaturalHistory extends TrackableObject {

    private $idNaturalHistory;
    private $name;
    private $description;

    /**
     * Flora constructor.
     * @param $idFlora
     * @param $commonName
     * @param $scientificName
     * @param $description
     */
    public function __construct($idNaturalHistory, $name, $description,
                                $idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType)
    {
        TrackableObject::__construct($idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);
        $this->idNaturalHistory = $idNaturalHistory;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getIdNaturalHistory()
    {
        return $this->idNaturalHistory;
    }

    /**
     * @param mixed $idNaturalHistory
     */
    public function setIdNaturalHistory($idNaturalHistory)
    {
        $this->idNaturalHistory = $idNaturalHistory;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

}

?>