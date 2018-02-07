<?php

class Event {

	private $idEvent;
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

    public function getIdEvent(){
		return $this->idEvent;
	}

	public function getName(){
		return $this->name;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getStartTime(){
		return $this->startTime;
	}

	public function getEndTime(){
		return $this->endTime;
	}

    public function getImagePath(){
        return $this->imagePath;
    }

    public function getImageDescription(){
        return $this->imageDescription;
    }

}

?>
