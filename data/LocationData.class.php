<?php

require_once '../services/ConnectDb.class.php';

class LocationData
{


    public function createLocation($name, $description, $url, $longitude, $latitude, $address, $city, $state, $zipcode, $imagePath, $imageDescription, $pinDesign, $trailOrder)
    {
        try {
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("INSERT INTO Location
                                                                                  (name, description, url, longitude, latitude, address, city, state, zipcode, imagePath, imageDescription, pinDesign, trailOrder)
                                                                                  VALUES
                                                                                  (:name, :description, :url, :longitude, :latitude, :address, :city, :state, :zipcode, :imagePath, :imageDescription, :pinDesign, :trailOrder)");

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':url', $url, PDO::PARAM_STR);
            $stmt->bindParam(':longitude', $longitude, PDO::PARAM_STR);
            $stmt->bindParam(':latitude', $latitude, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':city', $city, PDO::PARAM_STR);
            $stmt->bindParam(':state', $state, PDO::PARAM_STR);
            $stmt->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
            $stmt->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
            $stmt->bindParam(':imageDescription', $imageDescription, PDO::PARAM_STR);
            $stmt->bindParam(':pinDesign', $pinDesign, PDO::PARAM_STR);
            $stmt->bindParam(':trailOrder', $trailOrder, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Failed to create Location';
            echo $e->getMessage();
            die();
        }
    }

    public function updateLocation($idLocation, $name, $description, $url, $longitude, $latitude, $address, $city, $state, $zipcode, $imagePath, $imageDescription, $pinDesign, $trailOrder)
    {
        try {
            $stmt = ConnectDb::getInstance()->getConnection()->prepare("UPDATE Location
                                                                                    SET name = :name,
                                                                                        description = :description,
                                                                                        url = :url,
                                                                                        longitude = :longitude,
                                                                                        latitude = :latitude,
                                                                                        address = :address,
                                                                                        city = :city,
                                                                                        state = :state,
                                                                                        zipcode = :zipcode,
                                                                                        imagePath = :imagePath,
                                                                                        imageDescription = :imageDescription,
                                                                                        pinDesign = :pinDesign,
                                                                                        trailOrder = :trailOrder
                                                                                     Where idLocation = :idLocation");

            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':url', $url, PDO::PARAM_STR);
            $stmt->bindParam(':longitude', $longitude, PDO::PARAM_STR);
            $stmt->bindParam(':latitude', $latitude, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':city', $city, PDO::PARAM_STR);
            $stmt->bindParam(':state', $state, PDO::PARAM_STR);
            $stmt->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
            $stmt->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
            $stmt->bindParam(':imageDescription', $imageDescription, PDO::PARAM_STR);
            $stmt->bindParam(':pinDesign', $pinDesign, PDO::PARAM_STR);
            $stmt->bindParam(':trailOrder', $trailOrder, PDO::PARAM_INT);
            $stmt->bindParam(':idLocation', $idLocation, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Failed to update Location';
            echo $e->getMessage();
            die();
        }

    }

    public function getAllLocationPinData()
    {
        return ConnectDb::getInstance()->returnObject("Location.class", "Select * from Location Order by trailOrder");
    }

    public function getLocationById($idLocation)
    {
        return ConnectDb::getInstance()->returnObject("", "SELECT * FROM Location WHERE idLocation = " . $idLocation);
    }

    public function getLocationModalInfo($id)
    {
        return json_encode(ConnectDb::getInstance()->returnObject("Location.class", "Select * from Location where idLocation = " . $id)[0]);
    }

}

?>