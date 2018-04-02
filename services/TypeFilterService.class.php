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

    public function getTypeFilterById($idType){
        $idType = filter_var($idType, FILTER_SANITIZE_NUMBER_INT);
        $obj = $this->typeFilterData->getTypeFilterById($idType);
        $singleType = new TypeFilter(
            $obj[0]['idType'],
            $obj[0]['typeFilter'],
            $obj[0]['description'],
            $obj[0]['pinDesign'],
            $obj[0]['buttonColor']
        );

        return $singleType;
    }

    public function updateTypeFilter($idType, $typeFilter, $description, $buttonColor){
        $idType = filter_var($idType, FILTER_SANITIZE_NUMBER_INT);
        $typeFilter = filter_var($typeFilter, FILTER_SANITIZE_STRING);
        $description = filter_var($description, FILTER_SANITIZE_STRING);
        $buttonColor = filter_var($buttonColor, FILTER_SANITIZE_STRING);

        $this->typeFilterData->updateTypeFilter($idType, $typeFilter, $description, $buttonColor);

    }

    public function deleteTypeFilter($idType){
        if($this->typeFilterData->checkIfTypeIsInUse(filter_var($idType,FILTER_SANITIZE_NUMBER_INT)) || $idType == 1 || $idType == 2 || $idType == 3){
            return "Type Filter is currently in use or is a default type filter and cannot be deleted.";
        } else {
            $idType = filter_var($idType, FILTER_SANITIZE_NUMBER_INT);
            ConnectDb::getInstance()->deleteObject($idType, "Type");
            return "";

        }
    }

    public function readTypeTable(){
        $data = $this->readAllTypeFilters();

        $table = "<script>
                        var typ = 'Type';
                    </script>";
        $table .= "
                    <div class='card'>
                    
                    <div class='card-panel cust-color-rust'>
                        <span class='card-title white-text'>Type Filters</span>
                        <a class='btn-floating waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, typ, -1)'><i class='material-icons'>add</i></a>
                    </div>
                    
                    <div class='card-content'>

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
                        <td><button class='waves-effect waves-light green btn modal-trigger' href='#updateModal' type='submit' onclick='modalController(updateAction, typ, ".$obj->getIdType().")'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>  
                        <td><button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' type='submit' onclick='modalController(deleteAction, typ, ".$obj->getIdType().")'> Delete
                            <i class='material-icons'>delete</i>
                        </button></td> 
                      </tr>
            ";
        }

        $table .= "</tbody></table></div></div>";

        return $table;
    }

    public function createTypeForm(){
        return '
                        <div class="row"><div class="col s12"><h5>Create a Type</h5></div></div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="typeFilter">Type Filter</label><br/>
                                <input id="typeFilter" name="typeFilter" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>
            
                        <div class="row">
                           <div class="input-field col s12">
                                <label for="pinDesign">Pin Design</label><br/>
                                <input id="pinDesign" name="pinDesign" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>
                        
                        <div class="row">
                           <div class="input-field col s12">
                                <label for="buttonColor">Button Color</label><br/>
                                <input id="buttonColor" name="buttonColor" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="description" name="description" class="materialize-textarea"></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
                        '
            ;
    }

    public function updateTypeForm($idType){
        $singleType = $this->getTypeFilterById($idType);

        return '
                        <div class="row"><div class="col s12"><h5>Update Type</h5></div></div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="typeFilter">Type Filter</label><br/>
                                <input id="typeFilter" name="typeFilter" type="text" class="validate" required="" aria-required="true" value="'.$singleType->getTypeFilter().'">
                            </div>
                        </div>
            
                        <div class="row">
                           <div class="input-field col s12">
                                <label for="pinDesign">Pin Design</label><br/>
                                <input id="pinDesign" name="pinDesign" type="text" class="validate" required="" aria-required="true" value="'.$singleType->getPinDesign().'">
                            </div>
                        </div>
                        
                        <div class="row">
                           <div class="input-field col s12">
                                <label for="buttonColor">Button Color</label><br/>
                                <input id="buttonColor" name="buttonColor" type="text" class="validate" required="" aria-required="true" value="'.$singleType->getButtonColor().'">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="description">Description</label><br/>
                                <textarea id="description" name="description" class="materialize-textarea">'.$singleType->getDescription().'</textarea>
                            </div>
                        </div>
                        
                        <div class="row" style="display:none;">
                            <div class="input-field col s12">
                                <input id="idType" name="idType" type="text" class="validate" required="" aria-required="true" value="'.$singleType->getIdType().'">
                            </div>
                        </div>
                        '
            ;
    }

}

?>