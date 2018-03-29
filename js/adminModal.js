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
                    break;
            }

            $('select').material_select(); // initializes material select

        },
        complete: function(){

            $( "#createBtn" ).click(function() {
                alert( "Create: " + action + " ID: " + objId);
                var data = objectData +"&"+ $('#createForm').serialize();

                $.ajax({
                    type: "POST",
                    url: '../services/AdminModalController.php',
                    data: data,
                    processData: false,
                    contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                    success: function(){
                        console.log("created object");
                        //location.reload();
                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });

            });

            $( "#updateBtn" ).click(function() {
                alert( "Update: " + action + " ID: " + objId);
                var data = objectData + "&" + $('#updateForm').serialize();

                $.ajax({
                    type: "POST",
                    url: '../services/AdminModalController.php',
                    data: data,
                    processData: false,
                    contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                    success: function(){
                        console.log("updated object");
                        //location.reload();

                    },
                    error: function(xhr, ajaxOptions, thrownError){
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });

            });

            // Create a JQuery ajax request when delete button is pressed passing in params to call required php function
            $( "#deleteBtn" ).click(function() {
                alert( "Amazing: " + action + " ID: " + objId);
                $.ajax({
                    type: "POST",
                    url: '../services/AdminModalController.php',
                    data: 'action='+action+'&object='+obj+'&objId='+objId,
                    processData: false,
                    contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                    success: function(){
                        console.log("deleted object");
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

// $(document).delegate('click', '#deleteModal .deleteBtn', function(){
//     alert("Please work");
// });
//
//
// function deleteObject(action){
//     alert("yay: " + action);
// }


