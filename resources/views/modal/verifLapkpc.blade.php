<div class="modal fade bs-example-modal-lg" id="verifLapkpc" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Verif & Grading Data Lapkpc</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <div class="box">
                            <form class="form" action="{{ route('grading', ['id' => $lapkpc->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="box-body">
                                    <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Data Pasien
                                    </h4>
                                    <hr class="my-15">
                                    <input type="hidden" name="status" value="Terverifikasi">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Penerima Laporan</label>
                                                <input type="text" name="penerima_laporan" class="form-control"
                                                    placeholder="" value="{{ auth()->user()->nama }}" disabled>
                                                <input type="hidden" name="penerima_laporan"
                                                    value="{{ auth()->user()->nama }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Tanggal Terima</label>
                                                <input type="date" name="tanggal_terima" id="tanggal_terima"
                                                    class="form-control" placeholder="" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Grade</label>
                                                <select name="grading_risiko" class="form-select">
                                                    <option selected disabled>Select grade</option>
                                                    <option value="biru">BIRU</option>
                                                    <option value="hijau">HIJAU</option>
                                                    <option value="kuning">KUNING</option>
                                                    <option value="merah">MERAH</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti-save-alt"></i> Save
                                    </button>
                                    <button type="button" class="btn btn-danger text-start"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('script.verifDateData')
