<div class="row">
    <div class="col-xs-12">
        <!--<h3 class="header smaller lighter blue">jQuery dataTables</h3>-->

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            Service Description
        </div>

        <!-- div.table-responsive -->

        <!-- div.dataTables_borderWrap -->
        <div>
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>

                    <th></th>
                    <th xclass="detail-col hidden">ID</th>
                    <th>Service</th>
                    <th class="hidden-480">Service English</th>
                    <th>Service Swahili</th>


                </tr>
                </thead>

                <tbody >

                </tbody>
            </table>
          <!-- start modal-->
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Update Service Description</h5>
                            <div class="message" id="message"></div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="col-xs-12 col-sm-9">
                                <form id="theForm" method="post" action="#">

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-6">
                                        <table>
                                            <tr>
                                                <td></td>
                                                <td><input type="hidden"  name="row-id" id="row-id" value=""/></td>
                                            </tr>
                                        <tr>
                                            <td><label>Service</label></td>
                                            <td><select id="service" name="service" class="form-control" >

                                                </select></td>
                                        </tr>
                                            <tr>
                                                <td><label>English</label></td>
                                                <td> <textarea name="service_en" id="service_en" value="" placeholder="English" rows="5" cols="20"></textarea></td>
                                            </tr>

                                            <tr>
                                                <td><label>Swahili</label></td>
                                                <td> <textarea name="service_sw" id="service_sw" value="" placeholder="Swahili" rows="5" cols="20"></textarea></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="save" value="save" name="submit">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal-->
        </div>
    </div>
</div>

