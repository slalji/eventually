$( document ).ready(function() {
    

});

jQuery(function($) {
   if (section != 'servicemsg' && section != 'servicedesc' && section != 'settings'){
    var myTable =
        $('#dynamic-table').DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [[ 1, 'desc' ]],

            bAutoWidth: false,
            ajax: {
                url: "ajax/getServerSide.php", // json datasource
                data: {section: section, cols: cols},
                type: "post"  // method  , by default get

            },
            "dom": '<"toolbar">frtip'
        } );
   }
   else if (section == 'servicemsg'){
    var myTable =
        $('#dynamic-table').DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [[ 1, 'desc' ]],

            bAutoWidth: false,
            ajax: {
                url: "ajax/getServerSide.php", // json datasource
                data: {section: section, cols: cols},
                type: "post"  // method  , by default get

            },
           // data-toggle="modal" data-target="#exampleModal"
            "columns": [
                
                {  },
                {  },
                {  },
                { },
                {  },
                {  },
                { },
                {"mRender": function ( data, type, row ) {
                    return '<a href="#" data-toggle="modal" data-target="#myModal" data-row-id='+row[0]+'><i class="fa fa-pencil pink"></i></a>';}
                }



            ],
            "dom": '<"toolbar">frtip'
        } );

   }
   else if (section == 'servicedesc' || section == 'settings'){
    var myTable =
    $('#dynamic-table').DataTable( {
            "processing": true,
            "serverSide": true,
            "order": [[ 1, 'desc' ]],

            bAutoWidth: false,
            ajax: {
                url: "ajax/getServerSide.php", // json datasource
                data: {section: section, cols: cols},
                type: "post"  // method  , by default get

            },
       // data-toggle="modal" data-target="#exampleModal"
        "columns": [
            
            {  },
            {  },
            {  },
            {  },
            {"mRender": function ( data, type, row ) {
                return '<a href="#" data-toggle="modal" data-target="#myModal" data-row-id='+row[0]+'><i class="fa fa-pencil pink"></i></a>';}
            }          ],
        "dom": '<"toolbar">lfrtip' //NO DATE RANGE
    } );
   }
   
    
    $("div.toolbar").html('<div class="dataTables_length"></div><div id="reportrange" class="pull-left" style="border-radus:5px ;background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 30%"> <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;<span id="date-text"></span> <b class="caret"></b></div>');

    if ($('#date-text').innerHTML !== ''){
    
    //$('#my-table_filter').hide();

    $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

    new $.fn.dataTable.Buttons( myTable, {
        buttons: [
            {
                "extend": "colvis",
                "text": "<i class='fa fa-eye-slash bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                "className": "btn btn-white   btn-bold",
                //columns: ':not(:first):not(:last)'
                columns: ':not(:first)'
            },
            {
                "extend": "copy",
                "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                "className": "btn btn-white   btn-bold"
            },
            {
                "extend": "copy",
                "text": "<i class='fa fa-font bigger-110 red'></i> <span class='hidden'>Toggle font size</span>",
                "className": "btn btn-white btn-bold",
                "action": function (e, dt, node, config)
                    {
                       
                        if( $("td").css('font-size') == '14px') {
                            $('td').css('font-size','11px');  
                        }
                        else
                            $('td').css('font-size','14px');
                    }
            },
            {
                "extend": "",
                "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden' id=export>Export to CSV </span>",
                "className": "btn btn-white   btn-bold",
                "action": function (e, dt, node, config)
                {
                   var searchthis = $('#date-text').html();
                  $.ajax({
                    "url": "ajax/download.php",
                    "data":{data:searchthis, section: section, cols: cols},
                    "type":"post",
                    "success": function(res, status, xhr) {
                        $('#loading').html('');
                         // document.location.href ="ajax/download.php";
                         var csvData = new Blob([res], {type: 'text/csv;charset=utf-8;'});
                                     var csvURL = window.URL.createObjectURL(csvData);
                                     var tempLink = document.createElement('a');
                                     tempLink.href = csvURL;
                                     tempLink.setAttribute('download', 'export.csv');
                                     tempLink.click();
                                     
                      },
                      "error": function(res, status, xhr) {
                         alert('Err:' ); 
                      }
                  }); 
                }
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
    }
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

// Date range script - Start of the sscript
    $("#reportrange").daterangepicker({
        autoUpdateInput: false,
        locale: {
            "cancelLabel": "Clear"
        },       
        "dateLimit": {
            "days": 14
        },
    });
    $("#reportrange").on('apply.daterangepicker', function(ev, picker) {
        start = picker.startDate.format('YYYY-MM-DD');
        end =  picker.endDate.format('YYYY-MM-DD');

        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
        document.getElementById('date-text').innerHTML = start +' | ' + end;
        myTable.columns(0).search(start + ' | ' +end).draw();
        //myTable.draw();
        //alert();
    });

    $("#reportrange").on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        myTable.draw();
    });
// Date range script - END of the script

    $.fn.dataTableExt.afnFiltering.push(
        function( oSettings, aData, iDataIndex ) {

            var grab_daterange = $("#reportrange").val();
            var give_results_daterange = grab_daterange.split(" to ");
            var filterstart = give_results_daterange[0];
            var filterend = give_results_daterange[1];
            var iStartDateCol = 1; //using column 2 in this instance
            var iEndDateCol = 1;
            var tabledatestart = aData[iStartDateCol];
            var tabledateend= aData[iEndDateCol];


            if ( !filterstart && !filterend )
            {
                return true;
            }
            else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && filterend === "")
            {
                return true;
            }
            else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isAfter(tabledatestart)) && filterstart === "")
            {
                return true;
            }
            else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && (moment(filterend).isSame(tabledateend) || moment(filterend).isAfter(tabledateend)))
            {
                return true;
            }
            return false;
        }
    );

//End of the datable




});


