$(document).ready(function(){
	$(".button-collapse").sideNav();
	$('.parallax').parallax();
	$('.modal').modal();
    $('.collapsible').collapsible({
		accordian: true
	});

});


/************
 Map Filter Functions
 ************/

function clearMapFilters(){
	var len = markerAry.length;

	for(var i = 0; i < len; i++){
		markerAry[i].setVisible(true);
	}
}

function setHistoricFilter(idHistoricFilter){

    var len = markerAry.length;

    for (var i = 0; i < len; i++) {
        if(markerAry[i].idHistoricFilter == String(idHistoricFilter)){
            markerAry[i].setVisible(true);
        } else {
            markerAry[i].setVisible(false);
        }
    }
}

function setTypeFilter(idType){
    var len = markerAry.length;

    for (var i = 0; i < len; i++) {
        if(markerAry[i].idType == String(idType)){
            markerAry[i].setVisible(true);
        } else {
            markerAry[i].setVisible(false);
        }
    }
}

function loadModalContent(id){

	console.log(id);

    $.ajax({
        datatype: "text",
        type: "GET",
        url: "../services/MapService.class.php",
        data: "id="+id,
		async: true,
        success: function(data) {

        	var str = data;
        	var jsonStr = data.substring( str.indexOf("{"), str.length-2);


        	var jsonData = $.parseJSON(jsonStr);

        	if(jsonData.idType == 0){ //Grave

                $('#graveName').html(jsonData.firstName + " " + jsonData.middleName + " " + jsonData.lastName);
                $('#graveModalDescription').html(jsonData.description);
                $('#graveImage').src = jsonData.imagePath;

            } else if(jsonData.idType == 1){ // Vegetation

                $('#vegetationCommonName').html(jsonData.commonName);
				$('#vegetationScientificName').html(jsonData.scientificName);
                $('#vegetationDescription').html(jsonData.description);


            } else { // other object

                $('#otherObjectName').html(jsonData.name);
                $('#otherObjectDescription').html(jsonData.description);

            }



        }
    });
    return false;

}
