<?php

class HistoricFilter {

	private $idHistoricFilter;
	private $HistoricFilter;
	private $description;
	private $startDate;
	private $endDate;
	private $imagePath;
	private $imageDescription;
	private $url;

	public function getIdHistoricFilter(){
		return $this->IdHistoricFilter;
	}

	public function getHistoricFilter(){
		return $this->HistoricFilter;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getStartDate(){
		return $this->startDate;
	}

	public function getEndDate(){
		return $this->endDate;
	}

    public function getImagePath(){
        return $this->imagePath;
    }

    public function getImageDescription(){
        return $this->imageDescription;
    }

    public function getUrl(){
        return $this->url;
    }

}

?>
