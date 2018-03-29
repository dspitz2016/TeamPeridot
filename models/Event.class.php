<?php

class Event {

    private $idEvent;
	private $name;
	private $description;
	private $startTime;
	private $endTime;
	private $imagePath;
	private $imageDescription;
	private $idLocation;
	private $locationName;

    /**
     * Event constructor.
     * @param $idEvent
     * @param $name
     * @param $description
     * @param $startTime
     * @param $endTime
     * @param $imagePath
     * @param $imageDescription
     * @param $idLocation
     */
    public function __construct($idEvent, $name, $description, $startTime, $endTime, $imagePath, $imageDescription, $idLocation, $locationName)
    {
        $this->idEvent = $idEvent;
        $this->name = $name;
        $this->description = $description;
        $this->startTime = date('F j, Y, g:i a', strtotime($startTime));
        $this->endTime = date('F j, Y, g:i a', strtotime($endTime));
        $this->imagePath = $imagePath;
        $this->imageDescription = $imageDescription;
        $this->idLocation = $idLocation;
        $this->locationName = $locationName;
    }

    /**
     * @return mixed
     */
    public function getLocationName()
    {
        return $this->locationName;
    }

    /**
     * @param mixed $locationName
     */
    public function setLocationName($locationName)
    {
        $this->locationName = $locationName;
    }

    

    /**
     * @return mixed
     */
    public function getIdEvent()
    {
        return $this->idEvent;
    }

    /**
     * @param mixed $idEvent
     */
    public function setIdEvent($idEvent)
    {
        $this->idEvent = $idEvent;
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

    /**
     * @return false|string
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param false|string $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return false|string
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param false|string $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
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


}

?>
