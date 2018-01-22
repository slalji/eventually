$( document ).ready(function() {
    var lang = {};
    lang['SW'] = 'Swahili';

    var status ={};
    status['SUCCESS'] = '<span class="label label-sm label-success">Success</span>';
    status['FAILED'] = '<span class="label label-sm label-danger">Failed</span>';
//global variables
    var phone = document.getElementById('phone').value;
    var ref = document.getElementById('ref').value;
    var groupid = document.getElementById('groupname').value;
    var startDate='';
    var endDate='';
    //groupid

    $.ajax({
        type: 'get',
        url: 'ajax/getGroup.php',
        dataType: 'json',

        success: function (response) {
            //console.log('Groupid<p>'+JSON.stringify(response));

            var str = "<option value='0'>ALL Groups</option>";
            $.each(response, function(index, element) {

                str += "<option value='"+element.groupid+"'>"+element.name+"</option>";
            });

            document.getElementById("groupname").innerHTML=str+"</select>";
            $('#groupname').html(str);
        },
        error: function(d){
            console.log('ERROR getGroup ajax: '+JSON.stringify(d));
        }
    });

        $('#dynamic_table').DataTable( {
            "ajax": "ajax/getItem.php",
            "columns": [
                { "data": "id" },
                { "data": "fulltimestamp" },
                { "data": "msisdn" },
                { "data": "account" },
                { "data": "service" },
                { "data": "reference" }
            ]
        } );

    // main content
    /*$.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'ajax/getItem',
        data: {id: groupid, phone: phone, ref: ref, startDate: startDate, endDate: endDate},
        success: function(d) {
           //console.log((d.data));
            var str='';
            $.each(d.data, function(index, element) {

                str += "<tr><td>"+element.id+"</td>"+
                "<td>"+element.fulltimestamp+
                "<td >"+element.msisdn+"</td>"+
                "<td>"+element.account+"</td>"+
                "<td>"+element.service+"</td>"+
                "<td>"+element.reference+"</td>"+
                "<td>"+element.amount+"</td>"+
                "<td>"+status[element.tstatus]+"</td>"+
                "<td>"+lang[element.lang]+"</td>"+
                "<td>"+element.groupid+"</td>"+
                "</tr>";


            });
            //console.log(str);
            //console.log(JSON.stringify(d.data));
            $('#transaction_table').innerHTML=str;
            $('#dynamic_table').DataTable({
               dom: "Bfrtip",
                data: (d.data),
                cols: (d.cols)

            });

        }
    });*/


    $("#theform").submit(function(event){
        event.preventDefault();

        if($('#calshow').is(":checked")) {

            startDate = $('#reportrange').data('daterangepicker').startDate.format('YYYY-MM-DD');
            endDate = $('#reportrange').data('daterangepicker').endDate.format('YYYY-MM-DD');
            console.log('daterange '+startDate,endDate);
        }

        console.log(groupid+' '+phone+' '+ref);

        //document.getElementById("current").innerHTML=groupid;
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: 'ajax/getItem',
            data: {id: groupid, phone: phone, ref: ref, startDate: startDate, endDate: endDate},
            success: function(d) {
                $('#dynamic_table').DataTable({
                    dom: "Bfrtip",
                    data: d.data,
                    columns: d.columns
                });
            }
        });
    });


});


jQuery(function($) {

    $("#reportrange").hide();
    $("#calshow").click(function() {
        if($(this).is(":checked")) {
            $("#reportrange").show(300);
        } else {
            $("#reportrange").hide(200);
        }
    });

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

});

$(".phone").text(function(i, text) {
    console.log('text: '+text);
    text = text.replace(/(\d\d\d)(\d\d\d)(\d\d\d\d)/, "($1) $2 $3");
    return text;
});

