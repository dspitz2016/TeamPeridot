<?php

class Location {

	private $idLocation;
	private $name;
	private $description;
	private $url;
	private $longitude;
	private $latitude;
	private $address;
	private $city;
	private $state;
	private $zipcode;
	private $imagePath;
	private $imageDescription;

	public function getIdLocation(){
		return $this->idLocation;
	}

	public function getName(){
		return $this->name;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getUrl(){
		return $this->url;
	}

	public function getLongitude(){
		return $this->longitude;
	}

    public function getLatitude(){
        return $this->latitude;
    }

    public function getAddress(){
        return $this->address;
    }

    public function getCity(){
        return $this->city;
    }

    public function getState(){
        return $this->state;
    }

    public function getZipcode(){
        return $this->zipcode;
    }

    public function getImagePath(){
        return $this->imagePath;
    }

    public function getImageDescription(){
        return $this->imageDescription;
    }

}
