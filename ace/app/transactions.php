<div class="row">
    <div class="col-xs-12">
        <!--<h3 class="header smaller lighter blue">jQuery dataTables</h3>-->

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Transactions
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>

                    <th xclass="detail-col hidden">ID</th>
                    <th>Date</th>
                    <th>Phone#</th>
                    <th xclass="hidden-480">Account</th>

                    <th>
                        Service
                    </th>
                    <th class="hidden-480">References</th>

                    <th>Amount</th>
                    <th>Status</th>
                    <th>Language</th>
                    <th>Group</th>
                </tr>
                </thead>

                <tbody id="transaction_table">

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    /*$(document).ready(function() {
        $(function () {
            $('input[name="reportrange"]').daterangepicker();
        });
        $(function () {

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
    });
    $('#reportrange').change( function() {
        alert();
        myTable.draw();
    } );
     function() {
     var date = $("#reportrange").val();
     alert(date);
     //var replaced = date.split(' ').join('')
     //$("#partialtable").load('@(Url.Action("GetDateResults", "Temps", null, Request.Url.Scheme))?date=' + replaced);
     });


    // Re-draw the table when the a date range filter changes
    $('.date-range-filter').change(function() {
        myTable.draw();
    });
    */
</script>
