<?php

class TrackableObject {

	private $idTrackableObject;
	private $longitude;
	private $latitude;
    private $qrCode;
    private $scavengerHuntHint;
	private $imagePath;
	private $imageDescription;

	public function getIdTrackableObject(){
		return $this->IdTrackableObject;
	}

	public function getLongitude(){
		return $this->longitude;
	}

    public function getLatitude(){
        return $this->latitude;
    }

    public function getQrCode(){
        return $this->qrCode;
    }

    public function getScavengerHuntHint(){
        return $this->scavengerHuntHint;
    }

    public function getImagePath(){
        return $this->imagePath;
    }

    public function getImageDescription(){
        return $this->imageDescription;
    }

}

?>
