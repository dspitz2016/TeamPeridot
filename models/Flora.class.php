<?php
include 'TrackableObject.class.php';

class Flora extends AdminTrackableObject {

    private $idFlora;
    private $commonName;
    private $scientificName;
    private $description;

    /**
     * Flora constructor.
     * @param $idFlora
     * @param $commonName
     * @param $scientificName
     * @param $description
     */
    public function __construct($idFlora, $commonName, $scientificName, $description,
                                $idTrackableObject, $longitude, $latitute, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType)
    {
        AdminTrackableObject::__construct($idTrackableObject, $longitude, $latitute, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType);
        $this->idFlora = $idFlora;
        $this->commonName = $commonName;
        $this->scientificName = $scientificName;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getIdFlora()
    {
        return $this->idFlora;
    }

    /**
     * @param mixed $idFlora
     */
    public function setIdFlora($idFlora)
    {
        $this->idFlora = $idFlora;
    }

    /**
     * @return mixed
     */
    public function getCommonName()
    {
        return $this->commonName;
    }

    /**
     * @param mixed $commonName
     */
    public function setCommonName($commonName)
    {
        $this->commonName = $commonName;
    }

    /**
     * @return mixed
     */
    public function getScientificName()
    {
        return $this->scientificName;
    }

    /**
     * @param mixed $scientificName
     */
    public function setScientificName($scientificName)
    {
        $this->scientificName = $scientificName;
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