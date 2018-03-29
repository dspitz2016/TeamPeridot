<?php

    require_once '../data/HistoricFilterData.class.php';
    require_once '../models/HistoricFilter.class.php';

class HistoricFilterService {

    private $historicFilterData;

    /**
     * HistoricFilterService constructor.
     * @param $historicFilterData
     */
    public function __construct()
    {
        $this->historicFilterData = new HistoricFilterData();
    }


    public function readAllHistoricFilters(){
        $historicFilterData = $this->historicFilterData->readAllHistoricFilters();
        $allHistoricalFilters = array();

        foreach ($historicFilterData as $historicFilter) {
            $filterBtn = new HistoricFilter(
                $historicFilter['idHistoricFilter'],
                $historicFilter['historicFilter'],
                $historicFilter['buttonColor']
            );

            array_push($allHistoricalFilters, $filterBtn);
        }

        return $allHistoricalFilters;
    }

    public function createHistoricFilter($historicFilter, $buttonColor){

        $historicFilter = filter_var($historicFilter, FILTER_SANITIZE_STRING);
        $buttonColor = filter_var($buttonColor, FILTER_SANITIZE_STRING);

        $this->historicFilterData->createHistoricFilter($historicFilter, $buttonColor);
    }

    public function updateHistoricFilter($idHistoricFilter, $historicFilter, $buttonColor){
        $idHistoricFilter = filter_var($idHistoricFilter, FILTER_SANITIZE_NUMBER_INT);
        $historicFilter = filter_var($historicFilter, FILTER_SANITIZE_STRING);
        $buttonColor = filter_var($buttonColor, FILTER_SANITIZE_STRING);

        $this->historicFilterData->updateHistoricFilter($idHistoricFilter, $historicFilter, $buttonColor);
    }

    public function deleteHistoricFilter($idHistoricFilter){
        $idHistoricFilter = filter_var($idHistoricFilter, FILTER_SANITIZE_NUMBER_INT);
        ConnectDb::getInstance()->deleteObject($idHistoricFilter, "HistoricFilter");
    }

    public function getHistoricFilterFormDropdownForObject($idHistoricFilter){
        $data = $this->readAllHistoricFilters();
        $elem = '<div class="row">
                    <div class="input-field col s12">
                    <select name="idHistoricFilter">';

        // If the Historic filter is null set the default selected as the Choose an option
        if($idHistoricFilter == "" || $idHistoricFilter == null){
            $elem .= '<option value="0" disabled selected>Choose your option</option>';
        }

        foreach($data as $historicFilter){
            $idHistoricFilterListValue = $historicFilter->getIdHistoricFilter();

            // If it's not null it should match and display the field that matches
            if($idHistoricFilterListValue == $idHistoricFilter){
                $elem .= '<option value="'.$idHistoricFilterListValue.'" selected>'.$historicFilter->getHistoricFilter().'</option>';
            } else {
                $elem .= '<option value="'.$idHistoricFilterListValue.'">'.$historicFilter->getHistoricFilter().'</option>';
            }



        }

        $elem .= '</select><label>Historic Filter Selection</label></div></div>';

        return $elem;
    }

    public function getDefaultHistoricFilterDropdown(){
        $data = $this->readAllHistoricFilters();
        $elem = '<div class="row">
                    <div class="input-field col s12">
                    <select name="idHistoricFilter">';
        $elem .= '<option value="0" disabled selected>Choose your option</option>';


        foreach($data as $historicFilter){
            $idHistoricFilterListValue = $historicFilter->getIdHistoricFilter();

            $elem .= '<option value="'.$idHistoricFilterListValue.'">'.$historicFilter->getHistoricFilter().'</option>';
        }

        $elem .= '</select><label>Historic Filter Selection</label></div></div>';

        return $elem;
    }
}

?>