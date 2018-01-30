<?php

class Event {

	private $idEvent;
	private $name;
	private $description;
	private $startTime;
	private $endTime;
	private $imagePath;
	private $imageDescription;

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
