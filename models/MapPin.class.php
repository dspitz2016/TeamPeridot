<?php

class MapPin {

    private $idTrackableObject;
    private $latitude;
    private $longitude;
    private $imageDescription;
    private $imageLocation;
    private $name;
    private $pinColor;
    
    /**
     * MapPin constructor.
     * @param $idTrackableObject
     * @param $latitude
     * @param $longitude
     * @param $imageDescription
     * @param $imageLocation
     * @param $name
     * @param $pinColor
     */
    public function __construct($idTrackableObject, $latitude, $longitude, $imageDescription, $imageLocation, $name, $pinColor)
    {
        $this->idTrackableObject = $idTrackableObject;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->imageDescription = $imageDescription;
        $this->imageLocation = $imageLocation;
        $this->name = $name;
        $this->pinColor = $pinColor;
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
    public function getImageLocation()
    {
        return $this->imageLocation;
    }

    /**
     * @param mixed $imageLocation
     */
    public function setImageLocation($imageLocation)
    {
        $this->imageLocation = $imageLocation;
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
    public function getPinColor()
    {
        return $this->pinColor;
    }

    /**
     * @param mixed $pinColor
     */
    public function setPinColor($pinColor)
    {
        $this->pinColor = $pinColor;
    }

}