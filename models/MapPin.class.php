<?php

class MapPin {

    private $idTrackableObject;
    private $longitude;
    private $latitude;
    private $name;
    private $pinDesign;
    private $idType;
    private $idHistoricFilter;

    /**
     * MapPin constructor.
     * @param $idTrackableObject
     * @param $longitude
     * @param $latitude
     * @param $name
     * @param $pinDesign
     * @param $idType
     * @param $idHistoricFilter
     */
    public function __construct($idTrackableObject, $longitude, $latitude, $name, $pinDesign, $idType, $idHistoricFilter)
    {
        $this->idTrackableObject = $idTrackableObject;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->name = $name;
        $this->pinDesign = $pinDesign;
        $this->idType = $idType;
        $this->idHistoricFilter = $idHistoricFilter;
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
    public function getPinDesign()
    {
        return $this->pinDesign;
    }

    /**
     * @param mixed $pinDesign
     */
    public function setPinDesign($pinDesign)
    {
        $this->pinDesign = $pinDesign;
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

    /**
     * @return mixed
     */
    public function getIdHistoricFilter()
    {
        return $this->idHistoricFilter;
    }

    /**
     * @param mixed $idHistoricFilter
     */
    public function setIdHistoricFilter($idHistoricFilter)
    {
        $this->idHistoricFilter = $idHistoricFilter;
    }

}