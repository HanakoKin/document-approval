<div class="modal fade bs-example-modal-lg" id="verifData" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Verif & Grading Data {{ $category }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <div class="box">
                            <form class="form" action="{{ route('grading'. $category, ['id' => $data->id ]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="box-body">
                                    <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Data Pasien
                                    </h4>
                                    <hr class="my-15">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Penerima Laporan</label>
                                                <input type="text" name="penerima_laporan" class="form-control"
                                                    placeholder="" value="{{ auth()->user()->nama }}">
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
                                        @if ($category === 'Lapin')
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Grade</label>
                                                <select name="grading_risiko" class="form-select">
                                                    <option selected disabled>Select grade</option>
                                                    <option value="-" hidden></option>
                                                    <option value="biru"
                                                        {{ $data->status === "Terverifikasi" && $data->grading_risiko == 'biru' ? 'selected' : '' }}>
                                                        BIRU</option>
                                                    <option value="hijau"
                                                        {{ $data->status === "Terverifikasi" && $data->grading_risiko == 'hijau' ? 'selected' : '' }}>
                                                        HIJAU</option>
                                                    <option value="kuning"
                                                        {{ $data->status === "Terverifikasi" && $data->grading_risiko == 'kuning' ? 'selected' : '' }}>
                                                        KUNING</option>
                                                    <option value="merah"
                                                        {{ $data->status === "Terverifikasi" && $data->grading_risiko == 'merah' ? 'selected' : '' }}>
                                                        MERAH</option>
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select">
                                                    <option {{ $data->status === 'Terverifikasi' ? 'selected' : '' }}
                                                        value="Terverifikasi">
                                                        Verifikasi</option>
                                                    <option {{ $data->status !== 'Terverifikasi' ? 'selected' : '' }}
                                                        value="Belum terverifikasi">
                                                        {{ $data->status === NULL ? 'Belum Verifikasi' : 'Batal Verifikasi' }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-md-10">
                                            <div class="text-center">
                                                <label class="form-label text-bold fs-16">Paraf Penerima Laporan</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="signature mb-0">
                                                    <div class="text-right  d-flex justify-content-center">
                                                        <button type="button" class="btn btn-default btn-sm me-1" id="undo"><i
                                                                class="fa fa-undo"></i> Undo</button>
                                                        <button type="button" class="btn btn-danger btn-sm" id="clear"><i
                                                                class="fa fa-eraser"></i> Clear</button>
                                                    </div>
                                                    <div class="wrapper mt-2">
                                                        <canvas id="signature-pad" class="signature-pad b-5 border-dark"
                                                            width="571" height="255"></canvas>
                                                    </div>

                                                    <div class="form-control-feedback"><small>Pastikan menekan tombol <code>Preview &
                                                                Confirm</code> sebelum mengisi form selanjutnya!</small></div>

                                                    <div class="button mt-2">
                                                        <button type="button" class="btn btn-info btn-sm" id="save-png"><i
                                                                class="fas fa-check-circle"></i> Preview &
                                                            Confirm</button>
                                                    </div>
                                                    <!-- Modal untuk tampil preview tanda tangan-->
                                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
                                                        aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">Preview Tanda Tangan</h4>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
@include('script.verLapSignature')
