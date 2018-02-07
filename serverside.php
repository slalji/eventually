<!DOCTYPE html>
<html>
<title>Datatable Demo3  Scroller (Server side) | CoderExample</title>
<head>
    <link rel="stylesheet" type="text/css" xhref="ace/assets/css/jquery.dataTables.css">
    <script src="ace/assets/js/jquery-2.1.4.min.js"></script>

    <script src="ace/assets/js/bootstrap.min.js"></script>

    <!-- page specific plugin scripts -->
    <script src="ace/assets/js/jquery.dataTables.min.js"></script>
    <script src="ace/assets/js/jquery.dataTables.bootstrap.min.js"></script>
    <script src="ace/assets/js/dataTables.buttons.min.js"></script>
    <script src="ace/assets/js/buttons.flash.min.js"></script>
    <script src="ace/assets/js/buttons.html5.min.js"></script>
    <script src="ace/assets/js/buttons.print.min.js"></script>
    <script src="ace/assets/js/buttons.colVis.min.js"></script>
    <script src="ace/assets/js/dataTables.select.min.js"></script>


    <style>
        div.container {
            margin: 0 auto;
            max-width:760px;
        }
        div.header {
            margin: 100px auto;
            line-height:30px;
            max-width:760px;
        }
        body {
            background: #f7f7f7;
            color: #333;
            font: 90%/1.45em "Helvetica Neue",HelveticaNeue,Verdana,Arial,Helvetica,sans-serif;
        }
    </style>
</head>
<body>
<div class="header"><h1>DataTable  Scroller (Server side) </h1></div>

<table id="example" >
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>IP Address</th>

        </tr>
    </thead>
</table>
<script>
    var myTable =
        $('#example').DataTable( {
            serverSide: true,
            ajax: {
                url: 'ace/ajax/getServerSide.php',
                type: 'GET',
                data: {draw:1, limit:10, order:'autoid', sort:'desc'}
            },
            // data-toggle="modal" data-target="#exampleModal"
            "columns": [
                {"mRender": function ( data, type, row ) {
                    return '<a href="#" data-toggle="modal" data-target="#myModal" data-row-id='+row.id+'><i class="fa fa-pencil pink"></i></a>';}
                },
                { "data": "first_name" },
                { "data": "last_name" },
                { "data": "email" },
                { "data": "gender" },
                { "data": "ip_address" }



            ]//,
        } );
</script>
</body>

</html>