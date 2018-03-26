/**
 * @param action - create, update
 * @param obj - any object on the navigation stored where tables are generated
 * @param idObj - object of id used for update tables
 */

function modalController(action, obj, objId){

    console.log("Perform " + action + " on " + obj + " ID: " + objId);


    $.ajax({
        datatype: "html",
        type: "GET",
        url: '../services/AdminModalController.php',
        data: 'action='+action+'&object='+obj+'&objId='+objId,
        success: function(data){
            // var obj =  '"' + obj + '"';
            // var objId =  '"' + objId + '"';

            switch(action){
                case "create":
                    $('#createModal .modal-content').html(data);
                    break;
                case "update":
                    $('#updateModal .modal-content').html(data);
                    break;
                case "delete":

                    $('#deleteModal .modal-footer').html(
                        "<a href='#!' class='modal-action modal-close waves-effect waves-red btn-flat'>Maybe</a>"
                        + "<button class='btn waves-effect waves-light red modal-trigger' href='#deleteModal' id='deleteBtn' type='submit'> Delete" +
                        "                            <i class='material-icons'>delete</i>" +
                        "                        </button>"
                    );

                    break;
            }
        },
        complete: function(){
            // Convert Action to String

            $( "#deleteBtn" ).click(function() {
                alert( "Amazing: " + action + " ID: " + objId);

                // var formData = new FormData();
                //
                // formData.append("action", action);
                // formData.append("object", obj);
                // formData.append("objId", objId);

                $.ajax({
                    type: "POST",
                    url: '../services/AdminModalController.php',
                    data: 'action='+action+'&object='+obj+'&objId='+objId,
                    // data: formData,
                    // data: {
                    //     'action': action,
                    //     'object': obj,
                    //     'objId' : objId
                    // },
                    // contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                    processData: false,
                    contentType: false,
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



$(document).delegate('click', '#deleteModal .deleteBtn', function(){
    alert("Please work");
});


function deleteObject(action){
    alert("yay: " + action);
}


