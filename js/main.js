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

function loadModalContent(id, idType){

	console.log(id, idType);

    $.ajax({
        datatype: "json",
        type: "GET",
        url: "../services/MapService.class.php",
        data: "id="+id+"&idType="+idType,
		async: true,
        success: function(data) {
            console.log(data);
        	var str = data;
        	var jsonStr = data.substring( str.indexOf("{"), str.length-2);


        	var jsonData = $.parseJSON(jsonStr);
        	var htmlContent = "";

        	if(jsonData.idType == 0){ //Grave

                htmlContent = '<h4>' + jsonData.firstName + ' ' + jsonData.middleName + ' ' + jsonData.lastName + '</h4> <br/>' +
                              '<img src="' + jsonData.imagePath +'" alt=""/> <br/>' +
                              '<p>' + jsonData.description + '</p> <br/>';


            } else if(jsonData.idType == 1){ // Vegetation

                htmlContent =   '<h4>' + jsonData.commonName + '</h4> <br/>' +
                                '<img height="150px" src="' + jsonData.imagePath +'" alt=""/> <br/>'+
                                '<p>' + jsonData.description + '</p> <br/>';


            } else { // other object

                htmlContent =   '<h4>' + jsonData.name + '</h4> <br/>' +
                                '<img height="150px" src="' + jsonData.imagePath +'" alt=""/> <br/>'+
                                '<p>' + jsonData.description + '</p>';


            }

            $('.modal-content').html(htmlContent);




        }
    });
    return false;

}

function loadLocationModal(id){

    console.log(id);

    $.ajax({
        datatype: "json",
        type: "GET",
        url: "../services/LocationService.class.php",
        data: "idLocation="+id,
        success: function(data) {
            console.log(id);
            console.log(data);

            var str = data;
            var jsonStr = data.substring( str.indexOf("{"), str.length-2);


            var jsonData = $.parseJSON(jsonStr);
            var htmlContent = "";

            htmlContent = '<h4>' + jsonData.name + '</h4> <br/>' +
                '<p>' + jsonData.description + '</p> <br/>' +
                '<img src="' + jsonData.imagePath +'" alt=""/> <br/>' +
                '<a href="' + jsonData.url + '">'+ jsonData.name + ' Website' +'</a>';


            $('.modal-content').html(htmlContent);


        }
    });
    return false;

}
