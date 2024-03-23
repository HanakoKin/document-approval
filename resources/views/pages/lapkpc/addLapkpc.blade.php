@extends('index')

@section('container')
<section class="content">

    <div class="row">
        <div class="col-12">

            <div class="d-inline-block align-items-center pb-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="/lapkpc">Kelola Laporan KPCS</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Laporan KPCS</li>
                    </ol>
                </nav>
            </div>

            {{-- Form --}}
            <form action="{{ url('/lapkpc/add') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="box-body">

                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Laporan Kondisi
                                Potensial Cedera Signifikan
                            </h4>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <label for="unLap" class="form-label text-bold">Unit Kerja / Ruangan :</label>
                                <div class="form-group mb-0">
                                    <div class="form-check form-check-inline">
                                        <input type="text" class="form-control" id="unLap" name="unit_kerja"
                                            value="{{ is_null(Auth::user()->unit) ? 'TIM SKP' : Auth::user()->unit }}"
                                            required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Valid Unit Kerja is required.
                            </div>
                        </div>
                        <div class="col-md-4 ms-auto mt-3">
                            <div class="d-flex align-items-center">
                                <label for="pemLap" class="form-label text-bold">Pembuat Laporan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                <div class="form-group mb-0">
                                    <div class="form-check form-check-inline">
                                        <input type="text" class="form-control" id="pemLap" name="pembuat_laporan"
                                            value="{{ auth()->user()->nama }}"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Valid Pembuat Laporan is required.
                            </div>
                        </div>
                    </div>

                    <hr class="my-15">
                    <input type="hidden" name="status" value="Belum terverifikasi">

                    {{-- WAKTU DITEMUKAN KPCS --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label text-bold">Tanggal Ditemukan KPCS</label>
                            <div class="col-12">
                                <input class="form-control" type="date" name="tanggal_ditemukan" required
                                    data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-bold">Jam Ditemukan KPCS</label>
                            <div class="form-group">
                                <div class="col-12">
                                    <input class="form-control" type="time" name="jam_ditemukan" required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KPCS --}}
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label text-bold">KPCS</label>
                            <div class="form-group">
                                <textarea rows="5" class="form-control" name="kpc" placeholder="Bagaimana KPC terjadi"
                                    required data-validation-required-message="This field is required"></textarea>
                            </div>
                        </div>
                    </div>

                    {{-- PELAPOR KPCS --}}
                    <div class="col-md-6">
                        <label class="form-label text-bold">Orang pertama yang melaporkan insiden</label>
                        <div class="form-group">
                            <div class="radio">
                                <input name="pelapor_insiden" value="Karyawan : Dokter / Perawat / Petugas Lainnya"
                                    type="radio" id="pelIn1" required
                                    data-validation-required-message="This field is required">
                                <label for="pelIn1">Karyawan : Dokter / Perawat / Petugas Lainnya</label>
                            </div>
                            <div class="radio">
                                <input name="pelapor_insiden" value="Keluarga / Pendamping pasien" type="radio"
                                    id="pelIn2" required data-validation-required-message="This field is required">
                                <label for="pelIn2">Keluarga / Pendamping pasien</label>
                            </div>
                            <div class="radio">
                                <input name="pelapor_insiden" value="Pasien" type="radio" id="pelIn3" required
                                    data-validation-required-message="This field is required">
                                <label for="pelIn3">Pasien</label>
                            </div>
                            <div class="radio">
                                <input name="pelapor_insiden" value="Pengunjung" type="radio" id="pelIn4" required
                                    data-validation-required-message="This field is required">
                                <label for="pelIn4">Pengunjung</label>
                            </div>
                            <div class="radio">
                                <div class="input-group mt-2">
                                    <span class="input-group-addon">
                                        <input name="pelapor_insiden" type="radio" id="pelIn5" value="" required
                                            data-validation-required-message="This field is required">
                                        <label for="pelIn5" style="padding-left: 20px;height: 17px;"></label>
                                    </span>
                                    <input id="pelapor_lain" type="text" class="form-control"
                                        aria-label="Text input with radio button" placeholder="Lain-lain"
                                        onclick="selectRadio('pelIn5')"
                                        oninput="syncInputRadio('pelIn5', 'pelapor_lain')">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- LOKASI KPCS --}}
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label text-bold">Lokasi diketahui KPCS</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="tempat_insiden"
                                    placeholder="Dimana terjadinya KPC">
                            </div>
                        </div>
                    </div>

                    {{-- UNIT YANG TERKAIT --}}
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label text-bold">Unit / Departemen terkait KPCS</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="unit_insiden"
                                    placeholder="Unit / Departemen apa yang terkait dengan KPC" required
                                    data-validation-required-message="This field is required">
                            </div>
                        </div>
                    </div>

                    {{-- TINDAKAN SEGERA YANG DILAKUKAN --}}
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label text-bold">Tindakan apa yang dilakukan untuk mengatasi kondisi
                                potensi cedera selama ini?</label>
                            <div class="form-group">
                                <textarea rows="5" class="form-control" name="tindakan_cepat"
                                    placeholder="Tindakan apa saja yang sudah dilakukan" required
                                    data-validation-required-message="This field is required"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        {{-- YANG MELAKUKUKAN TINDAKAN SEGERA --}}
                        <div class="col-md-6">
                            <label class="form-label text-bold">Tindakan dilakukan oleh</label>
                            <div class="form-group">
                                <div class="row">
                                    <div class="radio">
                                        <div class="input-group mt-2">
                                            <span class="input-group-addon">
                                                <input name="tindakan_insiden" type="radio" id="tinIn1" value=""
                                                    required data-validation-required-message="This field is required">
                                                <label class="form-check-label" for="tinIn1">Tim</label>
                                            </span>
                                            <input id="anggota_tim" name="tindakan_insiden" type="hidden"
                                                class="form-control" aria-label="Text input with radio button">
                                            <input id="tindakan_tim" type="text" class="form-control"
                                                aria-label="Text input with radio button" placeholder="Terdiri dari"
                                                onclick="selectRadio('tinIn1')"
                                                oninput="syncInputRadioSpecial('tinIn1', 'anggota_tim', 'tindakan_tim')">
                                        </div>
                                    </div>
                                    <div class="radio">
                                        <input name="tindakan_insiden" type="radio" value="Dokter" id="tinIn2" required
                                            data-validation-required-message="This field is required">
                                        <label for="tinIn2">Dokter</label>
                                    </div>
                                    <div class="radio">
                                        <input name="tindakan_insiden" type="radio" value="Perawat" id="tinIn3" required
                                            data-validation-required-message="This field is required">
                                        <label for="tinIn3">Perawat</label>
                                    </div>
                                    <div class="radio">
                                        <div class="input-group mt-2">
                                            <span class="input-group-addon">
                                                <input name="tindakan_insiden" type="radio" id="tinIn4" value=""
                                                    required data-validation-required-message="This field is required">
                                                <label for="tinIn4" style="padding-left: 20px;height: 17px;"></label>
                                            </span>
                                            <input id="tindakan_lain" type="text" class="form-control"
                                                aria-label="Text input with radio button" placeholder="Petugas lainnya"
                                                onclick="selectRadio('tinIn4')"
                                                oninput="syncInputRadio('tinIn4', 'tindakan_lain')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- APAKAH PERNAH TERJADI --}}
                        <div class="col-md-6">
                            <label class="form-label text-bold">Apakah kejadian yang sama pernah terjadi?</label>
                            <div class="form-group">
                                <div class="row">
                                    <div class="radio">
                                        <input id="pernah1" name="kejadian_insiden" type="radio"
                                            class="form-check-input" value="Ya"
                                            onclick="showTextarea('textarea_pernah')" required>
                                        <label class="form-check-label" for="pernah1">Ya</label>
                                        <div id="textarea_pernah" class="d-none mb-2">
                                            <label for="ket_pernah">Kapan? dan Langkah / tindakan apa yang
                                                telah diambil pada Unit Kerja tersebut untuk mencegah terulangnya
                                                kejadian yang sama?</label>
                                            <input id="des_pernah" name="kejadian_insiden" type="hidden"
                                                class="form-control" aria-label="Text input with radio button">
                                            <textarea id="ket_pernah" class="form-control mb-2"
                                                oninput="syncInputRadioSpecial('pernah1', 'des_pernah', 'ket_pernah')"></textarea>
                                        </div>
                                    </div>
                                    <div class="radio">
                                        <input name="kejadian_insiden" type="radio" value="Tidak" id="pernah2"
                                            onclick="hideTextarea('textarea_pernah')" required
                                            data-validation-required-message="This field is required">
                                        <label for="pernah2">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6">
                                <div class="text-center">
                                    <label class="form-label text-bold fs-16">Paraf Pelapor Insiden</label>
                                </div>
                                <div class="form-group">
                                    <div class="signature mb-3">
                                        <div class="text-right  d-flex justify-content-center">
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
                            </div>
                        </div>

                    </div>

                </div>

                <div class="box-footer float-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti-save-alt"></i> Save
                    </button>
                </div>

            </form>
        </div>
    </div>
</section>

@include('script.autoSelectRadio')
@include('script.addSignature')



@endsection
