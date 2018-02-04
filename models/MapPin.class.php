<?php

class MapPin {

    private $idTrackableObject;
    private $type;
    private $longitude;
    private $latitude;
    private $name;
    private $pinColor;

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