<?php

class TypeFilter {


    private $idType;
    private $typeFilter;
    private $buttonColor;

    /**
     * TypeFilter constructor.
     * @param $idType
     * @param $typeFilter
     * @param $buttonColor
     */
    public function __construct($idType, $typeFilter, $buttonColor)
    {
        $this->idType = $idType;
        $this->typeFilter = $typeFilter;
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
