@extends('index')

@section('container')
<section class="content pt-0">

    <div class="row">
        <div class="col-12">

            <div class="d-inline-block align-items-center pb-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="/lemkis">Kelola LEMKIS</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit LEMKIS</li>
                    </ol>
                </nav>
            </div>

            {{-- Form --}}
            <form action="{{ route('updateLemkis', ['id' => $data->id]) }}" method="post"
                enctype="multipart/form-data" id="formId">
                @csrf

                <div class="box-body">
                    <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Data Pasien
                    </h4>
                    <hr class="my-15">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Penyebab langsung Accident / Insiden :</label>
                                <textarea rows="5" class="form-control" name="penyebab_langsung"
                                    placeholder="How is it happen" required
                                    data-validation-required-message="This field is required">{{ $data->penyebab_langsung }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Penyebab yang melatarbelakangi insiden :</label>
                                <textarea rows="5" class="form-control" name="penyebab_awal"
                                    placeholder="How is it happen" required
                                    data-validation-required-message="This field is required">{{ $data->penyebab_awal }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table no-border mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Rekomendasi</th>
                                    <th scope="col">Yang bertanggung jawab</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Pendek :</label>
                                            <textarea rows="3" class="form-control" name="rekom_invest_pendek"
                                                placeholder="How is it happen">{{ $data->rekom_invest_pendek }}</textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_rekom_pendek"
                                                value="{{ $data->penanggung_rekom_pendek }}" placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date"
                                                value="{{ $data->tanggal_rekom_pendek }}" name="tanggal_rekom_pendek">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Menengah :</label>
                                            <textarea rows="3" class="form-control" name="rekom_invest_menengah"
                                                placeholder="How is it happen">{{ $data->rekom_invest_menengah }}</textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_rekom_menengah"
                                                value="{{ $data->penanggung_rekom_menengah }}" placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date"
                                                value="{{ $data->tanggal_rekom_menengah }}"
                                                name="tanggal_rekom_menengah">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Panjang :</label>
                                            <textarea rows="3" class="form-control" name="rekom_invest_panjang"
                                                placeholder="How is it happen">{{ $data->rekom_invest_panjang }}</textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_rekom_panjang"
                                                value="{{ $data->penanggung_rekom_panjang }}" placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date"
                                                value="{{ $data->tanggal_rekom_panjang }}"
                                                name="tanggal_rekom_panjang">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table no-border mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Tindakan yang dilakukan</th>
                                    <th scope="col">Yang bertanggung jawab</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Pendek :</label>
                                            <textarea rows="3" class="form-control" name="realisasi_invest_pendek"
                                                placeholder="How is it happen">{{ $data->realisasi_invest_pendek }}</textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_realisasi_pendek"
                                                value="{{ $data->penanggung_realisasi_pendek }}" placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date"
                                                value="{{ $data->tanggal_realisasi_pendek }}"
                                                name="tanggal_realisasi_pendek">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Menengah :</label>
                                            <textarea rows="3" class="form-control" name="realisasi_invest_menengah"
                                                placeholder="How is it happen">{{ $data->realisasi_invest_menengah }}</textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_realisasi_menengah"
                                                value="{{ $data->penanggung_realisasi_menengah }}" placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date"
                                                value="{{ $data->tanggal_realisasi_menengah }}"
                                                name="tanggal_realisasi_menengah">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Panjang :</label>
                                            <textarea rows="3" class="form-control" name="realisasi_invest_panjang"
                                                placeholder="How is it happen">{{ $data->realisasi_invest_panjang }}</textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_realisasi_panjang"
                                                value="{{ $data->penanggung_realisasi_panjang }}" placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date"
                                                value="{{ $data->tanggal_realisasi_panjang }}"
                                                name="tanggal_realisasi_panjang">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <h5>Ka.Ru, Ka.Sie, Ka.Bag Yang Melengkapi</h5>
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama_pelengkap"
                                    placeholder="Input patient name" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $data->nama_pelengkap }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanda tangan</label>
                                <p>Untuk Tanda Tangan, apakah ingin memasukkan TTD baru?</p>
                                <div class="signature-option text-right mb-3">
                                    <button type="button" class="btn btn-success btn-sm" id="new-signature"><i
                                            class="fa fa-check"></i> Ya</button>
                                    <button type="button" class="btn btn-warning btn-sm" id="old-signature"><i
                                            class="fa fa-undo"></i> Gunakan TTD lama</button>
                                </div>
                                <div class="signature mb-3 d-none">
                                    <div class="text-right d-flex justify-content-center">
                                        <button type="button" class="btn btn-default btn-sm me-1" id="undo"><i
                                                class="fa fa-undo"></i> Undo</button>
                                        <button type="button" class="btn btn-danger btn-sm" id="clear"><i
                                                class="fa fa-eraser"></i> Clear</button>
                                    </div>
                                    <div class="wrapper mt-2">
                                        <canvas id="signature-pad" class="signature-pad b-5 border-dark"
                                            style="width: 100%;" height="250"></canvas>
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
                            <div class="form-group">
                                <label class="form-label">Bagian / Peran</label>
                                <input type="text" class="form-control" name="bagian_pelengkap"
                                    placeholder="Input patient name" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $data->bagian_pelengkap }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanggal mulai investigasi</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="tanggal_mulai_invest" required
                                        data-validation-required-message="This field is required"
                                        value="{{ $data->tanggal_mulai_invest }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanggal dilengkapi</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="tanggal_dilengkapi" required
                                        data-validation-required-message="This field is required"
                                        value="{{ $data->tanggal_dilengkapi }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <h5>Bagian yang perlu diinformasikan</h5>
                                <label class="form-label">Tanggal :</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="tanggal_informasi" required
                                        data-validation-required-message="This field is required"
                                        value="{{ $data->tanggal_informasi }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Direksi RS Husada : </label>
                                <input type="text" class="form-control" name="direksi" placeholder="Input patient name"
                                    value="{{ $data->direksi }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Asdir / Manajer Keperawatan : </label>
                                <input type="text" class="form-control" name="asdir" placeholder="Input patient name"
                                    value="{{ $data->asdir }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tim Keselamatan Pasien : </label>
                                <input type="text" class="form-control" name="timkes" placeholder="Input patient name"
                                    value="{{ $data->timkes }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ka.Bag Personalia : </label>
                                <input type="text" class="form-control" name="personalia"
                                    placeholder="Input patient name" value="{{ $data->personalia }}">
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Progres hari minggu malam senin, mulai batas ini belum diberi value, sesuaikan dengan radio button yang dicek sebelumnya --}}

                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-center" scope="col" rowspan="3" width="250">
                                        TIM KESELAMATAN PASIEN
                                    </td>
                                    <td scope="col">
                                        <div class="d-flex align-items-center">
                                            <div class="row mt-10">
                                                <div class="col-10">
                                                    <div class=" form-group mb-0">
                                                        <label class="form-label">Investigasi Lengkap :</label>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group mb-0">
                                                        <div class="form-group mb-0 d-flex align-items-center">
                                                            <div class="radio me-3">
                                                                <input name="invest_lengkap" value="ya" type="radio"
                                                                    id="inLen1" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $data->invest_lengkap === 'ya' ? 'checked' : '' }}>
                                                                <label for="inLen1" class="me-1">Ya</label>
                                                            </div>
                                                            <div class="radio">
                                                                <input name="invest_lengkap" value="tidak" type="radio"
                                                                    id="inLen2" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $data->invest_lengkap === 'tidak' ? 'checked' : '' }}>
                                                                <label for="inLen2">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        <div class="d-flex align-items-center">
                                            <span>Tanggal :</span>
                                            <div class="form-group ms-3 mb-0">
                                                <input class="form-control" type="date" name="tanggal_pengesahan"
                                                    required data-validation-required-message="This field is required"
                                                    value="{{ $data->tanggal_pengesahan }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="col" colspan="2">
                                        <div class="d-flex align-items-center">
                                            <div class="row mt-10">
                                                <div class="col-8">
                                                    <div class=" form-group mb-0">
                                                        <label class="form-label">Diperlukan Investigasi lebih lanjut
                                                            :</label>
                                                    </div>
                                                </div>
                                                <div class="col-4 ps-2">
                                                    <div class="form-group mb-0">
                                                        <div class="form-group mb-0 d-flex align-items-center">
                                                            <div class="radio me-3">
                                                                <input name="invest_lanjut" value="ya" type="radio"
                                                                    id="inLan1" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $data->invest_lanjut === 'ya' ? 'checked' : '' }}>
                                                                <label for="inLan1" class="me-1">Ya</label>
                                                            </div>
                                                            <div class="radio">
                                                                <input name="invest_lanjut" value="tidak" type="radio"
                                                                    id="inLan2" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $data->invest_lanjut === 'tidak' ? 'checked' : '' }}>
                                                                <label for="inLan2">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="col" colspan="2">
                                        <div class="d-flex align-items-center">
                                            <div class="row mt-10 ms-0">
                                                <div class="col-5">
                                                    <div class=" form-group mb-0">
                                                        <label class="form-label">Investigasi setelah Grading ulang
                                                            :</label>
                                                    </div>
                                                </div>
                                                <div class="col-7 ps-3">
                                                    <div class="form-group mb-0">
                                                        <div class="form-group mb-0 d-flex align-items-left">
                                                            <div class="radio me-3">
                                                                <input name="grading_akhir" value="biru" type="radio"
                                                                    id="gradUl1" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $data->grading_akhir === 'biru' ? 'checked' : ''}}>
                                                                <label for="gradUl1" class="me-1">Biru</label>
                                                            </div>
                                                            <div class="radio me-3">
                                                                <input name="grading_akhir" value="hijau" type="radio"
                                                                    id="gradUl2" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $data->grading_akhir === 'hijau' ? 'checked' : ''}}>
                                                                <label for="gradUl2" class="me-1">Hijau</label>
                                                            </div>
                                                            <div class="radio me-3">
                                                                <input name="grading_akhir" value="kuning" type="radio"
                                                                    id="gradUl3" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $data->grading_akhir === 'kuning' ? 'checked' : ''}}>
                                                                <label for="gradUl3" class="me-1">Kuning</label>
                                                            </div>
                                                            <div class="radio">
                                                                <input name="grading_akhir" value="merah" type="radio"
                                                                    id="gradUl4" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $data->grading_akhir === 'merah' ? 'checked' : ''}}>
                                                                <label for="gradUl4">Merah</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer float-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti-save-alt"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@include('script.editSignature')


@endsection
