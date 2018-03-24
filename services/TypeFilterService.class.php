<?php

require_once '../data/TypeFilterData.class.php';

class TypeFilterService {

    private $typeFilterData;

    /**
     * TypeFilterService constructor.
     * @param $typeFilterData
     */
    public function __construct()
    {
        $this->typeFilterData = new TypeFilterData();
    }


    public function createTypeFilter($typeFilter, $description, $pinDesign, $buttonColor){
        $typeFilter = filter_var($typeFilter, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $pinDesign = filter_var($pinDesign, FILTER_SANITIZE_STRING);
        $buttonColor = filter_var($buttonColor, FILTER_SANITIZE_STRING);

        $this->typeFilterData->createTypeFilter($typeFilter, $description, $pinDesign, $buttonColor);
    }

    public function readAllTypeFilters(){
        $typeFilterData = $mapData->getAllTypeFilters();
        $allTypeFilters = array();

        foreach ($typeFilterData as $typeFilter) {
            $filterBtn = new TypeFilter(
                $typeFilter['idType'],
                $typeFilter['typeFilter'],
                $typeFilter['description'],
                $typeFilter['pinDesign'],
                $typeFilter['buttonColor']
            );

            array_push($allTypeFilters, $filterBtn);
        }

        return $allTypeFilters;
    }

    public function updateAllTypeFilter($idType, $typeFilter, $description, $buttonColor){
        $idType = filter_var($idType, FILTER_SANITIZE_NUMBER_INT);
        $typeFilter = filter_var($typeFilter, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $buttonColor = filter_var($buttonColor, FILTER_SANITIZE_STRING);

        $this->typeFilterData->updateTypeFilter($idType, $typeFilter, $description, $buttonColor);

    }

    public function deleteTypeFilter($idType){

    }
}

?>