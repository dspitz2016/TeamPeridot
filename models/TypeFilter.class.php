<?php

class TypeFilter {


    private $idType;
    private $typeFilter;
    private $description;
    private $buttonColor;

    /**
     * TypeFilter constructor.
     * @param $idType
     * @param $typeFilter
     * @param $description
     * @param $buttonColor
     */
    public function __construct($idType, $typeFilter, $description, $buttonColor)
    {
        $this->idType = $idType;
        $this->typeFilter = $typeFilter;
        $this->description = $description;
        $this->buttonColor = $buttonColor;
    }

    /**
     * @return mixed
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * @param mixed $idType
     */
    public function setIdType($idType)
    {
        $this->idType = $idType;
    }

    /**
     * @return mixed
     */
    public function getTypeFilter()
    {
        return $this->typeFilter;
    }

    /**
     * @param mixed $typeFilter
     */
    public function setTypeFilter($typeFilter)
    {
        $this->typeFilter = $typeFilter;
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
    public function getButtonColor()
    {
        return $this->buttonColor;
    }

    /**
     * @param mixed $buttonColor
     */
    public function setButtonColor($buttonColor)
    {
        $this->buttonColor = $buttonColor;
    }


}

?>
