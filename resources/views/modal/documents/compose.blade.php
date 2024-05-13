<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Choose type of document</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-10 col-12 mx-auto">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="box pull-up">
                                <div class="box-body d-flex align-items-center">
                                    <img src="{{ asset('assets/images/icons/document.png') }}" alt=""
                                        class="align-self-end h-80 w-80">
                                    <div class="d-flex flex-column flex-grow-1 ms-2">
                                        <h5 class="box-title fs-16 mb-2">Surat Permohonan</h5>
                                        <a href="{{ route('createDocument') }}">Send now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="box pull-up">
                                <div class="box-body d-flex align-items-center">
                                    <img src="{{ asset('assets/images/icons/memo.png') }}" alt=""
                                        class="align-self-end h-80 w-80">
                                    <div class="d-flex flex-column flex-grow-1 ms-2">
                                        <h5 class="box-title fs-16 mb-2">Memo</h5>
                                        <a href="{{ route('createMemo') }}">Send now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-start" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
