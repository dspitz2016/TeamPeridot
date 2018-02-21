<?php

class FilterBar {

    // Take in array of objects and format them into a map filter
    public function getTypeFilterBar($typeFilterObjectArray){
        echo '<div class="section cust-color-slate">';
            echo '<div class="row container white-text center">';
                echo '<h5>Type Filters<h5>';

                foreach($typeFilterObjectArray as $typeFilter){
                    echo '<button class="btn waves-effect waves-light" type="submit" name="action" style="background-color:#'.$typeFilter->getButtonColor().'">'.$typeFilter->getTypeFilter();
                         echo '<i class="material-icons right">filter_list</i>';
                    echo '</button>';
                }

            echo '</div>';
        echo '</div>';

    }

    public function getHistoricFilterBar($historicFilterObjectArray){
        echo '<div class="section cust-color-seafoam">';
            echo '<div class="row container white-text center">';
                echo '<h5>Historic Filters<h5>';

                foreach($historicFilterObjectArray as $historicFilter){
                    echo '<button class="btn waves-effect waves-light" type="submit" name="action" style="background-color:#'.$historicFilter->getButtonColor().'">'.$historicFilter->getHistoricFilter();
                }

            echo '</div>';
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