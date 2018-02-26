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
	private $pinDesign;

    /**
     * Location constructor.
     * @param $idLocation
     * @param $name
     * @param $description
     * @param $url
     * @param $longitude
     * @param $latitude
     * @param $address
     * @param $city
     * @param $state
     * @param $zipcode
     * @param $imagePath
     * @param $imageDescription
     * @param $pinDesign
     */
    public function __construct($idLocation, $name, $description, $url, $longitude, $latitude, $address, $city, $state, $zipcode, $imagePath, $imageDescription, $pinDesign)
    {
        $this->idLocation = $idLocation;
        $this->name = $name;
        $this->description = $description;
        $this->url = $url;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipcode = $zipcode;
        $this->imagePath = $imagePath;
        $this->imageDescription = $imageDescription;
        $this->pinDesign = $pinDesign;
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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param mixed $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
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

    // Allow it to use the create Map Pin Service
	public function getIdType(){
    	return "-2";
	}

    public function getIdHistoricFilter(){
    	return "";
	}

	public function getIdTrackableObject(){
    	return "Location";
	}

}

?>
