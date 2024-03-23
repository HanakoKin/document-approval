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
                        <li class="breadcrumb-item active" aria-current="page">Tambah LEMKIS</li>
                    </ol>
                </nav>
            </div>

            {{-- Form --}}
            <form action="{{ url('/lemkis/add') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="box-body">
                    <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Data Pasien
                    </h4>

                    <hr class="my-15">

                    <input type="hidden" name="lapin_id" value="{{ $lapin->id }}">
                    <input type="hidden" name="unit_kerja" value="{{ $lapin->unit_kerja }}">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="naLap" class="form-label text-bold">Nama</label>
                            <input type="text" class="form-control" id="naLap" name="nama" placeholder=""
                                value="{{ $lapin->nama }}" disabled>
                            <div class="invalid-feedback">
                                Valid Nama is required.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="inLap" class="form-label text-bold">Insiden</label>
                            <input type="text" class="form-control" id="inLap" name="insiden" placeholder=""
                                value="{{ $lapin->insiden }}" disabled>
                            <div class="invalid-feedback">
                                Valid Insiden is required.
                            </div>
                        </div>
                    </div>

                    <h4 class="box-title text-info mb-0 mt-30"><i class="fal fa-books-medical"></i> Rincian Lembar Kerja
                        Investigasi Sederhana
                    </h4>
                    <hr class="my-15">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Penyebab langsung Accident / Insiden :</label>
                                <textarea rows="5" class="form-control" name="penyebab_langsung"
                                    placeholder="Apa penyebab langsung dari insiden" required
                                    data-validation-required-message="This field is required"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Penyebab yang melatarbelakangi insiden :</label>
                                <textarea rows="5" class="form-control" name="penyebab_awal"
                                    placeholder="Apa yang menyebabkan insiden" required
                                    data-validation-required-message="This field is required"></textarea>
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
                                                placeholder=""></textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_rekom_pendek"
                                                placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date" name="tanggal_rekom_pendek">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Menengah :</label>
                                            <textarea rows="3" class="form-control" name="rekom_invest_menengah"
                                                placeholder=""></textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_rekom_menengah"
                                                placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date" name="tanggal_rekom_menengah">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Panjang :</label>
                                            <textarea rows="3" class="form-control" name="rekom_invest_panjang"
                                                placeholder=""></textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_rekom_panjang"
                                                placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date" name="tanggal_rekom_panjang">
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
                                                placeholder=""></textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_realisasi_pendek"
                                                placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date" name="tanggal_realisasi_pendek">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Menengah :</label>
                                            <textarea rows="3" class="form-control" name="realisasi_invest_menengah"
                                                placeholder=""></textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_realisasi_menengah"
                                                placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date" name="tanggal_realisasi_menengah">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Panjang :</label>
                                            <textarea rows="3" class="form-control" name="realisasi_invest_panjang"
                                                placeholder=""></textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_realisasi_panjang"
                                                placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date" name="tanggal_realisasi_panjang">
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
                                    placeholder="Input nama yang melengkapi" required
                                    data-validation-required-message="This field is required">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Tanda tangan</label>
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
                            <div class="form-group">
                                <label class="form-label">Bagian / Peran</label>
                                <input type="text" class="form-control" name="bagian_pelengkap"
                                    placeholder="Input bagian / peran yang melengkapi" required
                                    data-validation-required-message="This field is required">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanggal mulai investigasi</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="tanggal_mulai_invest" required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanggal dilengkapi</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="tanggal_dilengkapi" required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <h5>Bagian yang perlu diinformasikan</h5>
                                <label class="form-label">Tanggal :</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="tanggal_informasi" required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Direksi RS Husada : </label>
                                <input type="text" class="form-control" name="direksi" placeholder="Input nama direksi">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Asdir / Manajer Keperawatan : </label>
                                <input type="text" class="form-control" name="asdir"
                                    placeholder="Input nama Asdir / Manajer Keperawatan">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tim Keselamatan Pasien : </label>
                                <input type="text" class="form-control" name="timkes"
                                    placeholder="Input nama Tim Keselamatan Pasien">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ka.Bag Personalia : </label>
                                <input type="text" class="form-control" name="personalia"
                                    placeholder="Input nama dari Personalia">
                            </div>
                        </div>
                    </div>

                    <hr>

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
                                                                    data-validation-required-message="This field is required">
                                                                <label for="inLen1" class="me-1">Ya</label>
                                                            </div>
                                                            <div class="radio">
                                                                <input name="invest_lengkap" value="tidak" type="radio"
                                                                    id="inLen2" required
                                                                    data-validation-required-message="This field is required">
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
                                                    required data-validation-required-message="This field is required">
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
                                                                    data-validation-required-message="This field is required">
                                                                <label for="inLan1" class="me-1">Ya</label>
                                                            </div>
                                                            <div class="radio">
                                                                <input name="invest_lanjut" value="tidak" type="radio"
                                                                    id="inLan2" required
                                                                    data-validation-required-message="This field is required">
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
                                                                    data-validation-required-message="This field is required">
                                                                <label for="gradUl1" class="me-1">Biru</label>
                                                            </div>
                                                            <div class="radio me-3">
                                                                <input name="grading_akhir" value="hijau" type="radio"
                                                                    id="gradUl2" required
                                                                    data-validation-required-message="This field is required">
                                                                <label for="gradUl2" class="me-1">Hijau</label>
                                                            </div>
                                                            <div class="radio me-3">
                                                                <input name="grading_akhir" value="kuning" type="radio"
                                                                    id="gradUl3" required
                                                                    data-validation-required-message="This field is required">
                                                                <label for="gradUl3" class="me-1">Kuning</label>
                                                            </div>
                                                            <div class="radio">
                                                                <input name="grading_akhir" value="merah" type="radio"
                                                                    id="gradUl4" required
                                                                    data-validation-required-message="This field is required">
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

@include('script.lapinAdd')
@include('script.addSignature')


@endsection
