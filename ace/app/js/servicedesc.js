var section = $('#section').html();
var cols =' id, service, service_en, service_sw ';

$(document).ready(function() {

    // Save Form Data insert to setService
    $( "#save" ).click(function() {

        $.ajax({
            type: 'POST',
            url: 'ajax/setServiceDesc',
            data: $( "#theForm" ).serialize(),
            success: function( response ) {
                //console.log( response );
                document.getElementById('message').innerHTML = '<div class="alert alert-success"> <strong>Saved !</strong> </div>';
                window.setTimeout(function () {
                    $("#message").hide();
                    $("#myModal").modal("hide");
                }, 2000);
                window.location.reload();
            },
            error: function( response ) {
                alert('error '+JSON.stringify(response.responseText));
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
                    document.getElementById('service_en').innerHTML = element.service_en;
                    document.getElementById('service_sw').innerHTML = element.service_sw;
            });

                //console.log(obj);
            }
        });


    });

    //initiate dataTables plugin

  
})

