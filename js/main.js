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
        datatype: "json",
        type: "GET",
        url: "../services/MapService.Class.php",
        data: "id="+id,
        success: function(data) {
			alert("Yay: " + data);
			$('#graveModalDescription').replaceWith(data);
            $('#vegetationModalDescription').replaceWith(data);
            $('#otherModalDescription').replaceWith(data);

        }
    });
    return false;

}
