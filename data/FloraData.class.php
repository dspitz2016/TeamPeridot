<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );

require_once '../services/ConnectDb.class.php';

/**
 * Class GraveData
 * Used for Grave CREATE, READ, UPDATE, DELETE QUERIES
 */
class FloraData {

    public function createFlora(){

    }

    public function readAllFlora(){
        return ConnectDb::getInstance()->returnObject("", "Select * FROM Flora");
    }

    public function updateFlora(){

    }

    public function deleteFlora(){

    }

}