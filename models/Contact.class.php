<?php

class Contact {

    private $idContact;
    private $firstName;
    private $lastname;
    private $email;
    private $title;
    private $description;
    private $idLocation;

    /**
     * Contact constructor.
     * @param $idContact
     * @param $firstName
     * @param $lastname
     * @param $email
     * @param $title
     * @param $description
     * @param $idLocation
     */
    public function __construct($idContact, $firstName, $lastname, $email, $title, $description, $idLocation)
    {
        $this->idContact = $idContact;
        $this->firstName = $firstName;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->title = $title;
        $this->description = $description;
        $this->idLocation = $idLocation;
    }

    /**
     * @return mixed
     */
    public function getIdContact()
    {
        return $this->idContact;
    }

    /**
     * @param mixed $idContact
     */
    public function setIdContact($idContact)
    {
        $this->idContact = $idContact;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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