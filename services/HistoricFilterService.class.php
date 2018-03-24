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
        $allHistoricFilters = array();

        foreach ($historicFilterData as $historicFilter) {
            $newHistoricFilter = new HistoricFilter(
                $historicFilter['idHistoricFilter'],
                $historicFilter['historicFilter'],
                $historicFilter['buttonColor']
            );

            array_push($allHistoricalFilters, $newHistoricFilter);
        }

        return $allHistoricFilters;
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
}

?>