$(document).ready(function(){

    // Resets POST variables on modal close to keep user from passing data twice.
    var reloadPage = function(){
        location.reload();
    };

    $("#createModal").modal({dismissible: false, complete : reloadPage});
    $("#updateModal").modal({dismissible: false, complete : reloadPage})
    $("#deleteModal").modal({dismissible: false, complete : reloadPage})

});



/**
 * @param action - create, update
 * @param obj - any object on the navigation stored where tables are generated
 * @param idObj - object of id used for update tables
 */

function modalController(action, obj, objId){

    console.log("Perform " + action + " on " + obj + " ID: " + objId);

    var objectData = 'action='+action+'&object='+obj+'&objId='+objId;

    $.ajax({
        datatype: "html",
        type: "GET",
        url: '../services/AdminModalController.php',
        data: objectData,

        success: function(data){
            // var obj =  '"' + obj + '"';
            // var objId =  '"' + objId + '"';

            switch(action){
                case "create":
                    $('#createModal .modal-content #createForm').html(data);

                    break;
                case "update":
                    $('#updateModal .modal-content #updateForm').html(data);
                case "delete":
                    $('#deleteModal .modal-content').html('<h5>Are you sure you would like to delete?</h5>');
                    $('#deleteModal .modal-footer').html(" <button class='btn waves-effect waves-light modal-close' href='#deleteModal' type='submit'> Cancel</button>" +
                        "            <button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' id='deleteBtn' type='submit'>Delete</button>");
                    break;
            }

            $('select').material_select(); // initializes material select
            // $(".select.currentFilter option:selected").val();
        },
        complete: function(){

            $( "#createBtn" ).click(function() {
                console.log( "Create: " + action + " ID: " + objId);
                var data = objectData +"&"+ $('#createForm').serialize();


                $.ajax({
                    type: "POST",
                    url: '../services/AdminModalController.php',
                    data: data,
                    processData: false,
                    contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                    success: function(){
                        console.log("created object");
                        location.reload();
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });

            });

            $( "#updateBtn" ).click(function() {
                console.log( "Update: " + action + " ID: " + objId);
                var data = objectData + "&" + $('#updateForm').serialize();

                // var sel = $('idHistoricFilter').material_select();
                // alert("Select Value: " + sel);
                // $('select').material_select(); // initializes material select

                $.ajax({
                    type: "POST",
                    url: '../services/AdminModalController.php',
                    data: data,
                    processData: false,
                    contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                    success: function(){
                        console.log("updated object");
                        location.reload();

                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });

            });

            // Create a JQuery ajax request when delete button is pressed passing in params to call required php function
            $( "#deleteBtn" ).click(function() {
                console.log( "Amazing: " + action + " ID: " + objId);


                $.ajax({
                    type: "POST",
                    url: '../services/AdminModalController.php',
                    data: 'action='+action+'&object='+obj+'&objId='+objId,
                    processData: false,
                    contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                    success: function(data){
                        console.log("deleted object" + data);

                        if(data != ""){
                            $('#deleteModal .modal-content').html('<h5>' + data + '</h5>');
                            $('#deleteModal .modal-footer').html("<button class='btn waves-effect waves-light modal-close' href='#deleteModal' id='cannotDeleteBtn' type='submit'> Cancel</button>");
                        } else {
                            location.reload();
                        }
                    },
                    complete:function(){
                         $('#cannotDeleteBtn').click(function(){
                            location.load();
                         });
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });

            });

        }
    });
}
