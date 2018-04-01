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

    public function getHistoricFilterById($idHistoricFilter){
        $idHistoricFilter = filter_var($idHistoricFilter, FILTER_SANITIZE_NUMBER_INT);
        $obj = $this->historicFilterData->getHistoricFilterById($idHistoricFilter);
        $singleHF = new HistoricFilter(
            $obj[0]['idHistoricFilter'],
            $obj[0]['historicFilter'],
            $obj[0]['buttonColor']
        );

        return $singleHF;
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

    public function readHistoricFilterTable(){
        $data = $this->readAllHistoricFilters();

        $table = "<script>
                        var hf = 'HistoricFilter';
                    </script>";
        $table .= "
                    <div class='card'>
                    
                    <div class='card-panel cust-color-rust'>
                        <span class='card-title white-text'>Events</span>
                        <a class='btn-floating waves-light modal-trigger' href='#createModal' onclick='modalController(createAction, hf, -1)'><i class='material-icons'>add</i></a>
                    </div>
                    
                    <div class='card-content'>

                    <table class='responsive-table striped'>
                    <thead>
                      <tr>
                          <th>Name</th>
                          <th></th>
                          <th></th>
                      </tr>
                    </thead>
                    <tbody>";


        foreach($data as $obj){
            $table .= "
                      <tr>
                        <td>".$obj->getHistoricFilter()."</td>
                        <td><button class='waves-effect waves-light green btn modal-trigger' href='#updateModal' type='submit' onclick='modalController(updateAction, hf, ".$obj->getIdHistoricFilter().")'> Edit
                            <i class='material-icons'>edit</i>
                        </button></td>  
                        <td><button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' type='submit' onclick='modalController(deleteAction, hf, ".$obj->getIdHistoricFilter().")'> Delete
                            <i class='material-icons'>delete</i>
                        </button></td> 
                      </tr>
            ";
        }

        $table .= "</tbody></table></div></div>";

        return $table;
    }

    public function createHistoricFilterForm(){
        return '
                        <div class="row"><div class="col s12"><h5>Create a Historic Filter</h5></div></div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="historicFilter">Historic Filter</label><br/>
                                <input id="historicFilter" name="historicFilter" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>
                        
                        <div class="row">
                           <div class="input-field col s12">
                                <label for="buttonColor">Button Color</label><br/>
                                <input id="buttonColor" name="buttonColor" type="text" class="validate" required="" aria-required="true">
                            </div>
                        </div>
                       
                        '
            ;
    }

    public function updateHistoricFilterForm($idHistoricFilter){
        $singleHF = $this->getHistoricFilterById($idHistoricFilter);
        return '
                        <div class="row"><div class="col s12"><h5>Update a Historic Filter</h5></div></div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="historicFilter">Historic Filter</label><br/>
                                <input id="historicFilter" name="historicFilter" type="text" class="validate" required="" aria-required="true" value="'.$singleHF->getHistoricFilter().'">
                            </div>
                        </div>
                        
                        <div class="row">
                           <div class="input-field col s12">
                                <label for="buttonColor">Button Color</label><br/>
                                <input id="buttonColor" name="buttonColor" type="text" class="validate" required="" aria-required="true" value="'.$singleHF->getButtonColor().'">
                            </div>
                        </div>
                        
                        <div class="row" style="display:none;">
                           <div class="input-field col s12">
                                <input id="idHistoricFilter" name="idHistoricFilter" type="text" class="validate" required="" aria-required="true" value="'.$singleHF->getIdHistoricFilter().'">
                            </div>
                        </div>
                       
                        '
            ;
    }
}

?>