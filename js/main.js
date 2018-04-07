$(document).ready(function () {
    $(".button-collapse").sideNav();
    $('.parallax').parallax();
    $('.modal').modal();
    $("#createModal").modal({dismissible: false});
    $("#updateModal").modal({dismissible: false})
    $("#deleteModal").modal({dismissible: false})

    $('.collapsible').collapsible({
        accordian: true
    });

    $('.navTab').click(function () {
        $('.navLinks').hide();
        $(this.getAttribute('href')).show();
    });

});


/************
 Map Filter Functions
 ************/

function clearMapFilters() {
    infoWindow.close();
    var len = markerAry.length;

    for (var i = 0; i < len; i++) {
        markerAry[i].setVisible(true);
    }
}

function setHistoricFilter(idHistoricFilter) {
    infoWindow.close();

    var len = markerAry.length;

    for (var i = 0; i < len; i++) {
        if (markerAry[i].idHistoricFilter == String(idHistoricFilter)) {
            markerAry[i].setVisible(true);
        } else {
            markerAry[i].setVisible(false);
        }
    }
}

function setTypeFilter(idType) {
    infoWindow.close();

    var len = markerAry.length;

    for (var i = 0; i < len; i++) {
        if (markerAry[i].idType == String(idType)) {
            markerAry[i].setVisible(true);
        } else {
            markerAry[i].setVisible(false);
        }
    }
}

function loadModalContent(id, idType) {

    console.log(id, idType);

    $.ajax({
        datatype: "json",
        type: "GET",
        url: "../services/MapService.class.php",
        data: "id=" + id + "&idType=" + idType,
        async: true,
        success: function (data) {
            console.log(data);
            var str = data;
            var jsonStr = data.substring(str.indexOf("{"), str.length - 2);
            var jsonData = $.parseJSON(jsonStr);
            var htmlContent = "";

            if (jsonData.idType == 1) { //Grave
                var m_names = new Array("January", "February", "March",
                    "April", "May", "June", "July", "August", "September",
                    "October", "November", "December");

                var fbirth = new Date(jsonData.birth);
                var format_birth = m_names[fbirth.getMonth()] + " " + fbirth.getDate() + ", " + fbirth.getFullYear();

                var fdeath = new Date(jsonData.death);
                var format_death = m_names[fdeath.getMonth()] + " " + fdeath.getDate() + ", " + fdeath.getFullYear();

                htmlContent = '<h4>' + jsonData.firstName + ' ' + jsonData.middleName + ' ' + jsonData.lastName + '</h4> <br/>' +
                    '<p>(' + format_birth + ' - ' + format_death + ')</p> <br/>' +
                    '<img src="' + jsonData.imagePath + '" alt="' + jsonData.imageDescription + '"/> <br/>' +
                    '<p>' + jsonData.description + '</p> <br/>';


            } else if (jsonData.idType == 2) { // Flora

                htmlContent = '<h4>' + jsonData.commonName + '</h4> <br/>' +
                    '<img height="150px" src="' + jsonData.imagePath + '" alt="' + jsonData.imageDescription + '"/> <br/>' +
                    '<p>' + jsonData.description + '</p> <br/>';


            } else { // other object

                htmlContent = '<h4>' + jsonData.name + '</h4> <br/>' +
                    '<img height="150px" src="' + jsonData.imagePath + '" alt="' + jsonData.imageDescription + '"/> <br/>' +
                    '<p>' + jsonData.description + '</p>';


            }

            $('.modal-content').html(htmlContent);

        }
    });
    return false;

}

function loadLocationModal(id) {

    console.log(id);

    $.ajax({
        datatype: "json",
        type: "GET",
        url: "../services/LocationService.class.php",
        data: "idLocation=" + id,
        success: function (data) {
            console.log(id);
            console.log(data);

            var str = data;
            var jsonStr = data.substring(str.indexOf("{"), str.length - 2);


            var jsonData = $.parseJSON(jsonStr);
            var htmlContent = "";

            htmlContent = '<h4>' + jsonData.name + '</h4> <br/>' +
                '<p>' + jsonData.description + '</p> <br/>' +
                '<img src="' + jsonData.imagePath + '" alt="' + jsonData.imageDescription + '"/> <br/>' +
                '<p>' + jsonData.address + ', ' + jsonData.city + ', ' + jsonData.state + ' ' + jsonData.zipcode + '</p>' +
                '<a class="waves-effect waves-light btn" href="' + jsonData.url + '">Go to ' + jsonData.name + ' Website</a>';


            $('.modal-content').html(htmlContent);


        }
    });
    return false;
}


