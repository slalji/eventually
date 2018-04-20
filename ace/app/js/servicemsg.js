var section = $('#section').html();
var cols ='id, service, description, errorcode,recipient,en_msg, sw_msg';

$(document).ready(function() {
 $( "#save" ).click(function() {

        $.ajax({
            type: 'POST',
            url: 'ajax/setService',
            data: $( "#theForm" ).serialize(),
            success: function( response ) {
                //console.log( response );
                document.getElementById('message').innerHTML = '<div class="alert alert-success"> <strong>Saved !</strong> </div>';
                window.setTimeout(function () {
                    $("#message").hide();
                    $("#myModal").modal("hide");


                }, 2000);
                window.location.reload();
            }

        });

    });
});

jQuery(function($) {
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').focus()
    });
    $('#myModal').on('show.bs.modal', function(e) {

        //get data-id attribute of the clicked element
        var rowId = $(e.relatedTarget).data('row-id');

        //populate the textbox

        $(e.currentTarget).find('input[name="row-id"]').val(rowId);
        var section = $('#section').html();
        var rowId = $('#row-id').val();
        //console.log('rowId '+rowId);
        $.ajax({
            url: 'ajax/getServiceItem.php',
            type: 'POST',
            dataType: 'json',
            data: {section:section,id:rowId},
            success: function(obj) {

                $.each(obj, function (index, element) {
                    document.getElementById('service').value = element.service;
                    document.getElementById('description').innerHTML = element.description;
                    document.getElementById('errorcode').value= element.errorcode;
                    document.getElementById('recipient').value = element.recipient;
                    document.getElementById('en_msg').innerHTML = element.en_msg;
                    document.getElementById('sw_msg').innerHTML = element.sw_msg;


                });

                //console.log(obj);
            }
        });


    });

    //initiate dataTables plugin
});
  
