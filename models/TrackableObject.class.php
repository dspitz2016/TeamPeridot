<?php

class AdminTrackableObject {
    private $idTrackableObject;
    private $longitude;
    private $latitude;
    private $scavengerHuntHint;
    private $imagePath;
    private $imageDescription;
    private $idLocation;
    private $idType;

    /**
     * AdminTrackableObject constructor.
     * @param $idTrackableObject
     * @param $longitude
     * @param $latitude
     * @param $scavengerHuntHint
     * @param $imagePath
     * @param $imageDescription
     * @param $idLocation
     * @param $idType
     */
    public function __construct($idTrackableObject, $longitude, $latitude, $scavengerHuntHint, $imagePath, $imageDescription, $idLocation, $idType)
    {
        $this->idTrackableObject = $idTrackableObject;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->scavengerHuntHint = $scavengerHuntHint;
        $this->imagePath = $imagePath;
        $this->imageDescription = $imageDescription;
        $this->idLocation = $idLocation;
        $this->idType = $idType;
    }

    /**
     * @return mixed
     */
    public function getIdTrackableObject()
    {
        return $this->idTrackableObject;
    }

    /**
     * @param mixed $idTrackableObject
     */
    public function setIdTrackableObject($idTrackableObject)
    {
        $this->idTrackableObject = $idTrackableObject;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getScavengerHuntHint()
    {
        return $this->scavengerHuntHint;
    }

    /**
     * @param mixed $scavengerHuntHint
     */
    public function setScavengerHuntHint($scavengerHuntHint)
    {
        $this->scavengerHuntHint = $scavengerHuntHint;
    }

    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param mixed $imagePath
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * @return mixed
     */
    public function getImageDescription()
    {
        return $this->imageDescription;
    }

    /**
     * @param mixed $imageDescription
     */
    public function setImageDescription($imageDescription)
    {
        $this->imageDescription = $imageDescription;
    }

    /**
     * @return mixed
     */
    public function getIdLocation()
    {
        return $this->idLocation;
    }

    /**
     * @param mixed $idLocation
     */
    public function setIdLocation($idLocation)
    {
        $this->idLocation = $idLocation;
    }

    /**
     * @return mixed
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * @param mixed $idType
     */
    public function setIdType($idType)
    {
        $this->idType = $idType;
    }


}

?>