<?php

class Event {

	private $name;
	private $description;
	private $startTime;
	private $endTime;
	private $imagePath;
	private $imageDescription;

    /**
     * Event constructor.
     * @param $idEvent
     * @param $name
     * @param $description
     * @param $startTime
     * @param $endTime
     * @param $imagePath
     * @param $imageDescription
     */
    public function __construct($name, $description, $startTime, $endTime, $imagePath, $imageDescription)
    {
        $this->name = $name;
        $this->description = $description;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->imagePath = $imagePath;
        $this->imageDescription = $imageDescription;
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
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
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


}

?>
