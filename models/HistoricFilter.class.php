<?php

class HistoricFilter {


    private $idHistoricFilter;
    private $historicFilter;
    private $buttonColor;

    /**
     * HistoricFilter constructor.
     * @param $idHistoricFilter
     * @param $historicFilter
     * @param $buttonColor
     */
    public function __construct($idHistoricFilter, $historicFilter, $buttonColor)
    {
        $this->idHistoricFilter = $idHistoricFilter;
        $this->historicFilter = $historicFilter;
        $this->buttonColor = $buttonColor;
    }

    /**
     * @return mixed
     */
    public function getIdHistoricFilter()
    {
        return $this->idHistoricFilter;
    }

    /**
     * @param mixed $idHistoricFilter
     */
    public function setIdHistoricFilter($idHistoricFilter)
    {
        $this->idHistoricFilter = $idHistoricFilter;
    }

    /**
     * @return mixed
     */
    public function getHistoricFilter()
    {
        return $this->historicFilter;
    }

    /**
     * @param mixed $historicFilter
     */
    public function setHistoricFilter($historicFilter)
    {
        $this->historicFilter = $historicFilter;
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
