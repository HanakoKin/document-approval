<div class="modal fade bs-example-modal-lg" id="showUser" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="showTitle"></h4>
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

                                <div class="text-center">
                                    <h3 id="namaTitle"></h3>
                                    <h6 id="noRMTitle"></h6>
                                </div>

                                <h4 class="box-title mt-40">General Info</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td width="200">Nama</td>
                                                <td id="nama"></td>
                                            </tr>
                                            <tr>
                                                <td>Username</td>
                                                <td id="username"></td>
                                            </tr>
                                            <tr>
                                                <td>Unit</td>
                                                <td id="unit"></td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah Kasus oleh unit ini</td>
                                                <td id="totalLapin"></td>
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
