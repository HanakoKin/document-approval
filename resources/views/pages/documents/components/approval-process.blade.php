<form action="{{ route('approve', $document->id) }}" method="POST">
    @csrf
    <input type="hidden" value="{{ Auth::user()->id }}" name="id">
    <label for="approval_status">Berikan feedback terhadap dokumen di atas</label>
    <div class="form-group mt-3">
        <select name="approval_status" class="form-control" id="approval_status">
            <option selected disabled>Pilih salah satu</option>
            <option value="Approved">Approved</option>
            <option value="Need Revision">Need Revision</option>
            <option value="Rejected">Rejected</option>
        </select>
    </div>

    <div id="signature_pad" class="row justify-content-center d-none">

        @for ($i = 0; $i < $approval; $i++)
            @if (Auth::user()->id == $document->approvals[$i]->approver_id)
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="nama_{{ $i }}" class="form-label">
                            Nama Penyetuju {{ $i + 1 }}
                        </label>
                        <input type="text" id="nama_{{ $i }}" class="form-control" name=""
                            value="{{ $document->approvals[$i]->approver->name }}" readonly>
                    </div>
                    <div class="signature">
                        <div class="text-center">
                            <label class="form-label text-bold fs-16">
                                TTD Penyetuju {{ $i + 1 }}
                            </label>
                        </div>
                        <div class="form-group">
                            <div class="signature mb-3">
                                <div class="text-right d-flex justify-content-center">
                                    <button type="button" class="btn btn-default btn-sm me-1"
                                        id="undo-{{ $i }}">
                                        <i class="fa fa-undo"></i> Undo
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" id="clear-{{ $i }}">
                                        <i class="fa fa-eraser"></i> Clear
                                    </button>
                                </div>
                                <div class="wrapper mt-2">
                                    <canvas id="signature-pad-{{ $i }}" class="signature-pad b-5 border-dark"
                                        style="width: 100%;" height="250"></canvas>
                                </div>
                                <div class="form-control-feedback">
                                    <small>Pastikan menekan tombol <code>Preview &
                                            Confirm</code>
                                        sebelum mengisi form selanjutnya!
                                    </small>
                                </div>
                                <div class="button mt-2">
                                    <button type="button" class="btn btn-info btn-sm" id="save-{{ $i }}">
                                        <i class="fas fa-check-circle"></i> Preview & Confirm
                                    </button>
                                </div>
                                <!-- Modal untuk tampil preview tanda tangan-->
                                <div class="modal fade" id="modal-{{ $i }}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">
                                                    Preview Tanda Tangan
                                                </h4>
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
            @endif
        @endfor

    </div>

    <hr>

    <div class="col-12 my-3">
        <div class="row">
            <div class="col-6 form-group">
                <label for="response" class="form-label">Berikan catatan (apabila
                    diperlukan)</label>
                <textarea class="form-control" name="response" id="response" rows="5"></textarea>
            </div>
            <div class="col-6 form-group">
                <label for="" class="form-label">Apakah dokumen akan di <span
                        class="fw-bold">Disposisi</span>?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="disposisi_status_yes" value="1"
                        name="disposisi_status">
                    <label class="form-check-label" for="disposisi_status_yes">Ya</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="disposisi_status_no" value="0"
                        name="disposisi_status">
                    <label class="form-check-label" for="disposisi_status_no">Tidak</label>
                </div>
            </div>

        </div>
    </div>

    <button type="submit" class="btn btn-primary" onclick="this.disabled = true; this.form.submit();">
        <i class="ti-save-alt"></i> Save
    </button>

</form>
