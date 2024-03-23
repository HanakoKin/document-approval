<div class="modal fade bs-example-modal-lg" id="showDocument" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title"></h4>
                <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-0">
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <div class="box box-widget widget-user">
                            <div class="widget-user-header bg-img"
                                style="background: url(https://source.unsplash.com/600x400?flower) center center; height: 15rem"
                                data-overlay="5">
                            </div>
                            <div class="widget-user-image mt-70">
                                <img class="rounded-circle bg-warning-light"
                                    src="https://source.unsplash.com/200x200?people" alt="User Avatar">
                            </div>
                            <div class="box-footer pb-0">

                                <h4 class="box-title mt-40">General Info</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="200">Document Name</td>
                                                <td id="name"></td>
                                            </tr>
                                            <tr>
                                                <td>Sender</td>
                                                <td id="sender"></td>
                                            </tr>
                                            <tr>
                                                <td>Receiver</td>
                                                <td id="receiver"></td>
                                            </tr>
                                            <tr>
                                                <td>Document</td>
                                                <td id="path-file"></td>
                                            </tr>
                                            <tr>
                                                <form action="" id="approval-form"></form>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger text-start"
                                        data-bs-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
