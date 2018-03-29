<?php

require_once '../data/TypeFilterData.class.php';
require_once '../models/TypeFilter.class.php';

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
        $typeFilterData = $this->typeFilterData->readAllTypeFilters();
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

    public function readTypeTable(){
        $data = $this->readAllTypeFilters();

        $table = "<script>
                        var typ = 'type';
                    </script>";
        $table .= "
                    <div class='row'>
                            <div class='col s10'>
                                  <h4>Type Filters</h4>
                            </div>
                            <div class='col s2'>
                                   <a class='btn-floating btn-large waves-effect waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, type, -1)'><i class='material-icons'>add</i></a>
                            </div>
                    </div>

                    <table class='responsive-table striped'>
                    <thead>
                      <tr>
                          <th>Type</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>";


        foreach($data as $obj){
            $table .= "
                      <tr>
                        <td>".$obj->getTypeFilter()."</td>
                        <td><button class='waves-effect waves-light green btn modal-trigger' href='#updateModal' type='submit' onclick='modalController(updateAction, grave, ".$obj->getIdType().")'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>  
                        <td><button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' type='submit' onclick='modalController(deleteAction, grave, ".$obj->getIdType().")'> Delete
                            <i class='material-icons'>delete</i>
                        </button></td> 
                      </tr>
            ";
        }

        $table .= "</tbody></table>";

        return $table;
    }

}

?>