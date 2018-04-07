<?php

require_once '../services/ConnectDb.class.php';

class HistoricFilterData
{

    public function readAllHistoricFilters()
    {
        return ConnectDb::getInstance()->returnObject("HistoricFilter.class", "SELECT idHistoricFilter, historicFilter, buttonColor FROM HistoricFilter;");
    }

    public function getHistoricFilterById($idHistoricFilter)
    {
        return ConnectDb::getInstance()->returnObject("HistoricFilter.class", "SELECT idHistoricFilter, historicFilter, buttonColor FROM HistoricFilter WHERE idHistoricFilter =" . $idHistoricFilter);
    }

    public function createHistoricFilter($historicFilter, $buttonColor)
    {
        try {
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("INSERT INTO HistoricFilter
                                                                                  (historicFilter, buttonColor)
                                                                                  VALUES
                                                                                  (:historicFilter, :buttonColor)");
            $stmt->bindParam(':historicFilter', $historicFilter, PDO::PARAM_STR);
            $stmt->bindParam(':buttonColor', $buttonColor, PDO::PARAM_STR);

            $stmt->execute();

        } catch (PDOException $e) {
            echo 'Failed to create Historic Filter';
            echo $e->getMessage();
            die();
        }

    }

    public function updateHistoricFilter($idHistoricFilter, $historicFilter, $buttonColor)
    {
        try {
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("UPDATE HistoricFilter
                                                                                    SET historicFilter = :historicFilter,
                                                                                    buttonColor = :buttonColor
                                                                                    WHERE idHistoricFilter = :idHistoricFilter");

            $stmt->bindParam(':historicFilter', $historicFilter, PDO::PARAM_STR);
            $stmt->bindParam(':buttonColor', $buttonColor, PDO::PARAM_STR);
            $stmt->bindParam(':idHistoricFilter', $idHistoricFilter, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Failed to update Historic Filter';
            echo $e->getMessage();
            die();
        }

    }

    public function deleteHistoricFilter($idHistoricFilter)
    {

    }
}

?>