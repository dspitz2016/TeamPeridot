<?php

class MapPin {

    private $idTrackableObject;
    private $type;
    private $longitude;
    private $latitude;
    private $name;
    private $pinColor;

    /**
     * MapPin constructor.
     * @param $idTrackableObject
     * @param $type
     * @param $longitude
     * @param $latitude
     * @param $name
     * @param $pinColor
     */

    public function __construct($idTrackableObject, $type, $longitude, $latitude, $name, $pinColor)
    {
        $this->idTrackableObject = $idTrackableObject;
        $this->type = $type;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
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