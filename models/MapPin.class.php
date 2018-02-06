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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPinColor()
    {
        return $this->pinColor;
    }

}