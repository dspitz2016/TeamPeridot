<?php

class FilterBar {

    // Take in array of objects and format them into a map filter
    public function getTypeFilterBar($typeFilterObjectArray){
        echo '<div class="section cust-color-slate">';
            echo '<div class="row container white-text">';
                echo '<h5>Type Filters<h5>';

                foreach($typeFilterObjectArray as $typeFilter){
                    echo '<a class="waves-effect waves-light btn light-blue"><i class="material-icons left">filter_list</i>'.$typeFilter->getTypeFilter().'</a>';
                }

            echo '</div>';
        echo '</div>';

    }

    public function getHistoricFilterBar($historicFilterObjectArray){
        echo '<div class="section cust-color-seafoam">';
            echo '<div class="row container white-text">';
                echo '<h5>Historic Filters<h5>';

                foreach($historicFilterObjectArray as $historicFilter){
                    echo '<a class="waves-effect waves-light btn light-blue"><i class="material-icons left">filter_list</i>'.$historicFilter->getHistoricFilter().'</a>';
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