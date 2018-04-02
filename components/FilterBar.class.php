<?php

class FilterBar {

    // Take in array of objects and format them into a map filter
    public function getTypeFilterBar($typeFilterObjectArray){
            echo '<div class="filterRow  white-text center cust-color-slate">';
                foreach($typeFilterObjectArray as $typeFilter){
                    echo '<button class="btn waves-effect waves-light" type="submit" name="action" style="background-color:#'.$typeFilter->getButtonColor().';" onclick="setTypeFilter('.$typeFilter->getIdType().')">'.$typeFilter->getTypeFilter();
                         echo '<i class="material-icons right">filter_list</i>';
                    echo '</button>';
                }

            echo '</div>';

    }

    public function getHistoricFilterBar($historicFilterObjectArray){

            echo '<div class=" filterRow white-text center cust-color-seafoam">';

                foreach($historicFilterObjectArray as $historicFilter){
                    echo '<button class="btn waves-effect waves-light" type="submit" name="action" style="background-color:#'.$historicFilter->getButtonColor().';" onclick="setHistoricFilter('.$historicFilter->getIdHistoricFilter().')">'.$historicFilter->getHistoricFilter();
                    echo '<i class="material-icons right">filter_list</i>';
                    echo '</button>';
                }

            echo '<button class="btn waves-effect waves-light" type="submit" name="action" onclick="clearMapFilters()">Clear Filters';
            echo '<i class="material-icons right">filter_list</i>';
            echo '</button>';

            echo '</div>';
    }

    /**
     * @return mixed
     */
    public function getFilterObjectArray()
    {
        return $this->filterObjectArray;
    }

    /**
     * @param mixed $filterObjectArray
     */
    public function setFilterObjectArray($filterObjectArray)
    {
        $this->filterObjectArray = $filterObjectArray;
    }


}

?>