<?php

  global $trackableObjectPinQry = "SELECT * FROM(
	SELECT type, longitude, latitude, concat(firstName, ' ', middleName, ' ', lastName) as name, pinColor
    FROM Grave G 
    JOIN TrackableObject T on G.idGrave = T.idGrave
    JOIN Type TF on T.idType = TF.idType
    UNION 
    SELECT type, longitude, latitude, commonName as name, pinColor
    FROM Vegetation V
    JOIN TrackableObject T on V.idVegetation = T.idVegetation
    JOIN Type TF on T.idType = TF.idType
    Union
    SELECT type, longitude, latitude, name, pinColor
    FROM OtherObject O
    JOIN TrackableObject T on O.idOtherObject = T.idOtherObject
    JOIN Type TF on T.idType = TF.idType
) as Pins";

 ?>

