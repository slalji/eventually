$(document).ready(function() {
    var section = $('#section').html();
    $.ajax({
        type: 'GET',
        url: 'ajax/getService',
        data:{section:'servicemsg'},
        success: function(data) {

            var obj = jQuery.parseJSON(data);

            var str = '<option value=0>Select Service</option>';
            $.each(obj, function (index, value) {
                str += "<option value=" + value['service'] + ">" + value['service'] + "</option>";
            });
            document.getElementById('service').innerHTML = str;
            //console.log($('#service').html());
        }
    });
    // Save Form Data insert to setService
    $( "#save" ).click(function() {

        $.ajax({
            type: 'POST',
            url: 'ajax/setService',
            data: $( "#theForm" ).serialize(),
            success: function( response ) {
                console.log( response );
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
        console.log('rowId '+rowId);
        $.ajax({
            url: 'ajax/getServiceItem.php',
            type: 'GET',
            dataType: 'json',
            data: {section:section,id:rowId},
            success: function(obj) {

                $.each(obj, function (index, element) {
                    document.getElementById('description').innerHTML = element.description;
                    document.getElementById('errorcode').value= element.errorcode;
                    document.getElementById('recipient').value = element.recipient;
                    document.getElementById('en_msg').innerHTML = element.en_msg;
                    document.getElementById('sw_msg').innerHTML = element.sw_msg;
                    var country = document.getElementById("service");
                    console.log(element.errorcode);
                    var option = $('#service').children('option[value="'+ element.service +'"]');
                    option.attr('selected', 'selected');

                });

                //console.log(obj);
            }
        });


    });

    //initiate dataTables plugin

    // New record
    $('a.editor_create').on('click', function (e) {
        e.preventDefault();

        editor.create( {
            title: 'Create new record',
            buttons: 'Add'
        } );
    } );

    // Edit record
    $('#dynamic-table').on('click', 'a.editor_edit', function (e) {
        e.preventDefault();

        editor.edit( $(this).closest('tr'), {
            title: 'Edit record',
            buttons: 'Update'
        } );
    } );

    // Delete a record
    $('#dynamic-table').on('click', 'a.editor_remove', function (e) {
        e.preventDefault();

        editor.remove( $(this).closest('tr'), {
            title: 'Delete record',
            message: 'Are you sure you wish to remove this record?',
            buttons: 'Delete'
        } );
    } );
    var section = $('#section').html();
    console.log(section);
    var myTable =
        $('#dynamic-table').DataTable( {
            //serverSide: true,
            bAutoWidth: false,
            ajax: {
                url: 'ajax/getItem.php',
                type: 'GET',
                dataType: 'json',
                data: {section:section}
            },
           // data-toggle="modal" data-target="#exampleModal"
            "columns": [
                {"mRender": function ( data, type, row ) {
                    return '<a href="#" data-toggle="modal" data-target="#myModal" data-row-id='+row.id+'><i class="fa fa-pencil pink"></i></a>';}
                },
                { "data": "id" },
                { "data": "service" },
                { "data": "description" },
                { "data": "errorcode" },
                { "data": "recipient" },
                { "data": "en_msg" },
                { "data": "sw_msg" }



            ]//,
            //"dom": '<"toolbar">frtip'
        } );
    //$("div.toolbar").html('<input type="text" id="min-date" class="form-control date-range-filter" data-date-format="yyyy-mm-dd" placeholder="Date Ranage:"> ');
    $("div.toolbar").html('<div id="reportrange_old" class="pull-left" style="border-radus:5px ;background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%"> <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;<span></span> <b class="caret"></b></div');

  //NO DATE RANGE

    //$('#my-table_filter').hide();

    $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

    new $.fn.dataTable.Buttons( myTable, {
        buttons: [
            {
                "extend": "colvis",
                "text": "<i class='fa fa-eye-slash bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                "className": "btn btn-white btn-primary btn-bold",
                //columns: ':not(:first):not(:last)'
                columns: ':not(:first)'
            },
            {
                "extend": "copy",
                "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                "className": "btn btn-white btn-primary btn-bold"
            },
            {
                "extend": "csv",
                "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to CSV</span>",
                "className": "btn btn-white btn-primary btn-bold"
            },
            {
                "extend": "excel",
                "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                "className": "btn btn-white btn-primary btn-bold"
            },
            {
                "extend": "pdf",
                "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                "className": "btn btn-white btn-primary btn-bold"
            },
            {
                "extend": "print",
                "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                "className": "btn btn-white btn-primary btn-bold",
                autoPrint: false,
                message: 'This print was produced using the Print button for DataTables'
            }
        ]
    } );
    myTable.buttons().container().appendTo( $('.tableTools-container') );

    //style the message box
    var defaultCopyAction = myTable.button(1).action();
    myTable.button(1).action(function (e, dt, button, config) {
        defaultCopyAction(e, dt, button, config);
        $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
    });


    var defaultColvisAction = myTable.button(0).action();
    myTable.button(0).action(function (e, dt, button, config) {

        defaultColvisAction(e, dt, button, config);


        if($('.dt-button-collection > .dropdown-menu').length == 0) {
            $('.dt-button-collection')
                .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                .find('a').attr('href', '#').wrap("<li />")
        }
        $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
    });

    ////

    setTimeout(function() {
        $($('.tableTools-container')).find('a.dt-button').each(function() {
            var div = $(this).find(' > div').first();
            if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
            else $(this).tooltip({container: 'body', title: $(this).text()});
        });
    }, 500);





    /********************************/
    //add tooltip for small view action buttons in dropdown menu
    $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

    //tooltip placement on right or left
    function tooltip_placement(context, source) {
        var $source = $(source);
        var $parent = $source.closest('table')
        var off1 = $parent.offset();
        var w1 = $parent.width();

        var off2 = $source.offset();
        //var w2 = $source.width();

        if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
        return 'left';
    }




    /***************/
    $('.show-details-btn').on('click', function(e) {
        e.preventDefault();
        $(this).closest('tr').next().toggleClass('open');
        $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
    });
    /***************/





    /**
     //add horizontal scrollbars to a simple table
     $('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
     {
       horizontal: true,
       styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
       size: 2000,
       mouseWheelLock: true
     }
     ).css('padding-top', '12px');
     */


})

