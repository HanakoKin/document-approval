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
                        <li class="breadcrumb-item"><a href="/lapin">Kelola Laporan Insiden</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Laporan Insiden</li>
                    </ol>
                </nav>
            </div>

            {{-- Form --}}
            <form action="{{ route('updateLapin', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data"
                onsubmit="return validasiForm()" id="formId">
                @csrf

                <div class="box-body">

                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Data Pasien</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <label for="editUnLap" class="form-label text-bold">Unit Kerja / Ruangan :</label>
                                <div class="form-group mb-0">
                                    <div class="form-check form-check-inline">
                                        <input type="text" class="form-control" id="editUnLap" name="unit_kerja"
                                            value="{{ $data->unit_kerja }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Valid Unit Kerja is required.
                            </div>
                        </div>
                        <div class="col-md-4 ms-auto mt-3">
                            <div class="d-flex align-items-center">
                                <label for="editPemLap" class="form-label text-bold">Pembuat Laporan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                <div class="form-group mb-0">
                                    <div class="form-check form-check-inline">
                                        <input type="text" class="form-control" id="editPemLap" name="pembuat_laporan"
                                            value="{{ $data->pembuat_laporan }}"
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

                    {{-- NAMA --}}
                    <div class="col-md-12">
                        <label for="editNaLap" class="form-label text-bold">Nama</label>
                        <input type="text" class="form-control" id="editNaLap" name="nama"
                            placeholder="Input patient name" required readonly
                            data-validation-required-message="This field is required" value="{{ $data->nama }}">
                    </div>

                    {{-- NO RM --}}
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label for="editNoRMLap" class="form-label text-bold">No RM</label>
                            <input type="text" class="form-control" id="editNoRMLap" name="noRM"
                                placeholder="Input Medical Record" required readonly
                                data-validation-required-message="This field is required" value="{{ $data->noRM }}">
                        </div>
                        <div class="col-md-6">
                            <label for="editRuLap" class="form-label text-bold">Ruangan</label>
                            {{-- <input type="text" class="form-control" id="editRuLap" name="ruangan"
                                placeholder="Which room you want?" required readonly
                                data-validation-required-message="This field is required" value="{{ $data->ruangan }}">
                            --}}
                            <select class="form-control select2" id="editRuLap" name="ruangan" style="width: 100%;">
                                @foreach ($ruangan as $item)
                                <option value="{{ $item->nama }}"
                                    {{ $item->nama  == $data->ruangan ? 'selected' : ''  }}>{{ $item->nama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">

                        {{-- JENIS KELAMIN --}}
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <label for="jenis_kelamin" class="form-label me-3 text-bold">Jenis Kelamin</label>
                                <div class="form-group mb-0">
                                    <div class="form-check form-check-inline">
                                        <input name="jenis_kelamin" type="radio" value="Laki-laki" id="jekel1" required
                                            data-validation-required-message="This field is required"
                                            {{ $data->jenis_kelamin === 'Laki-laki' ? 'checked' : '' }}
                                            onclick="return false" style="pointer-events: none">
                                        <label for="jekel1">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input name="jenis_kelamin" type="radio" value="Perempuan" id="jekel2" required
                                            data-validation-required-message="This field is required"
                                            {{ $data->jenis_kelamin === 'Perempuan' ? 'checked' : '' }}
                                            onclick="return false" style="pointer-events: none">
                                        <label for="jekel2">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- TANGGAL LAHIR --}}
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <label for="talah" class="form-label text-bold">Tanggal Lahir</label>
                                <div class="form-group mb-0">
                                    <div class="form-check form-check-inline">
                                        <input type="date" class="form-control" id="talah" name="tanggal_lahir"
                                            value="{{ $data->tanggal_lahir }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        {{-- UMUR --}}
                        <div class="col-md-6">
                            <label for="umur" class="form-label text-bold">Umur</label>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input name="umur" value="0 - 1 bulan" type="radio" id="umur1" required
                                                data-validation-required-message="This field is required"
                                                {{ $data->umur === '0 - 1 bulan' ? 'checked' : '' }}
                                                onclick="return false" style="pointer-events: none">
                                            <label for="umur1">0 - 1 bulan</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input name="umur" value="> 1 bulan - 1 tahun" type="radio" id="umur2"
                                                required data-validation-required-message="This field is required"
                                                {{ $data->umur === '> 1 bulan - 1 tahun' ? 'checked' : '' }}
                                                onclick="return false" style="pointer-events: none">
                                            <label for="umur1">> 1 bulan - 1 tahun</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input name="umur" value="> 1 tahun - 5 tahun" type="radio" id="umur3"
                                                required data-validation-required-message="This field is required"
                                                {{ $data->umur === '> 1 tahun - 5 tahun' ? 'checked' : '' }}
                                                onclick="return false" style="pointer-events: none">
                                            <label for="umur2">> 1 tahun - 5 tahun</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input name="umur" value="> 5 tahun - 15 tahun" type="radio" id="umur4"
                                                required data-validation-required-message="This field is required"
                                                {{ $data->umur === '> 5 tahun - 15 tahun<' ? 'checked' : '' }}
                                                onclick="return false" style="pointer-events: none">
                                            <label for="umur3">> 5 tahun - 15 tahun</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input name="umur" value="> 15 tahun - 30 tahun" type="radio" id="umur5"
                                                required data-validation-required-message="This field is required"
                                                {{ $data->umur === '> 15 tahun - 30 tahun' ? 'checked' : '' }}
                                                onclick="return false" style="pointer-events: none">
                                            <label for="umur4">> 15 tahun - 30 tahun</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input name="umur" value="> 30 tahun - 65 tahun" type="radio" id="umur6"
                                                required data-validation-required-message="This field is required"
                                                {{ $data->umur === '> 30 tahun - 65 tahun' ? 'checked' : '' }}
                                                onclick="return false" style="pointer-events: none">
                                            <label for="umur5">> 30 tahun - 65 tahun</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input name="umur" value="> 65 tahun" type="radio" id="umur7" required
                                                data-validation-required-message="This field is required"
                                                {{ $data->umur === '> 65 tahun' ? 'checked' : '' }}
                                                onclick="return false" style="pointer-events: none">
                                            <label for="umur6">> 65 tahun</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- PENJAMIN --}}
                        <div class="col-md-6">
                            <label for="editPenLap" class="form-label text-bold">Penjamin</label>
                            <input type="text" class="form-control" id="editPenLap" name="penjamin" placeholder=""
                                required readonly data-validation-required-message="This field is required"
                                value="{{ $data->penjamin }}">
                        </div>

                    </div>

                    {{-- WAKTU MASUK RS --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label text-bold">Tanggal Masuk</label>
                            <div class="col-12">
                                <input class="form-control" type="date" name="tanggal_masuk" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $data->tanggal_masuk }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-bold">Jam Masuk</label>
                            <div class="col-12">
                                <input class="form-control" type="time" name="jam_masuk" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $data->jam_masuk }}" readonly>
                            </div>
                        </div>
                    </div>

                    <h4 class="box-title text-info mb-0 mt-30"><i class="fal fa-books-medical"></i> Rincian Kejadian
                    </h4>
                    <hr class="my-15">

                    {{-- WAKTU INSINDEN --}}
                    <p class="mt-3 mb-0 text-bold">1. Tanggal dan Waktu Insiden</p>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label class="form-label text-bold">Tanggal:</label>
                            <input class="form-control" type="date" name="tanggal_kejadian" required
                                data-validation-required-message="This field is required"
                                value="{{ $data->tanggal_kejadian }}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label class="form-label text-bold">Jam:</label>
                            <input class="form-control" type="time" name="jam_kejadian" required
                                data-validation-required-message="This field is required"
                                value="{{ $data->jam_kejadian }}">
                        </div>
                    </div>

                    {{-- INSIDEN --}}
                    <div class="col-md-12 my-3">
                        <label for="editInLap" class="form-label text-bold">2. Insiden</label>
                        <input type="text" class="form-control" id="editInLap" name="insiden"
                            placeholder="Type the incident" required
                            data-validation-required-message="This field is required" value="{{ $data->insiden }}">
                    </div>

                    {{-- KRONOLOGIS --}}
                    <div class="col-md-12">
                        <label for="editKronoLap" class="form-label text-bold">3. Kronologis Insiden</label>
                        <textarea rows="3" class="form-control" id="editKronoLap" name="kronologis"
                            placeholder="How is it happen" required
                            data-validation-required-message="This field is required">{{ $data->kronologis }}</textarea>
                    </div>

                    {{-- JENIS INSIDEN --}}
                    <div class="col-md-12 my-3">
                        <label class="form-label text-bold">4. Jenis Insiden</label>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input name="jenis_insiden" value="Kondisi Potensial Cedera Signifikan / KPCS"
                                            type="radio" id="jenIn1" required
                                            data-validation-required-message="This field is required"
                                            {{ $data->jenis_insiden === 'Kondisi Potensial Cedera Signifikan / KPCS' ? 'checked' : '' }}>
                                        <label for="jenIn1">Kondisi Potensial Cedera Signifikan / KPCS</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input name="jenis_insiden" value="Kejadian Tidak Diharapkan / KTD" type="radio"
                                            id="jenIn2" required
                                            data-validation-required-message="This field is required"
                                            {{ $data->jenis_insiden === 'Kejadian Tidak Diharapkan / KTD' ? 'checked' : '' }}>
                                        <label for="jenIn2">Kejadian Tidak Diharapkan / KTD</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input name="jenis_insiden" value="Kejadian Nyaris Cedera / KNC" type="radio"
                                            id="jenIn3" required
                                            data-validation-required-message="This field is required"
                                            {{ $data->jenis_insiden === 'Kejadian Nyaris Cedera / KNC' ? 'checked' : '' }}>
                                        <label for="jenIn3">Kejadian Nyaris Cedera / KNC</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input name="jenis_insiden" value="Sentinel" type="radio" id="jenIn4" required
                                            data-validation-required-message="This field is required"
                                            {{ $data->jenis_insiden === 'Sentinel' ? 'checked' : '' }}>
                                        <label for="jenIn4">Sentinel</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input name="jenis_insiden" value="Kejadian Tidak Cedera / KTC" type="radio"
                                            id="jenIn5" required
                                            data-validation-required-message="This field is required"
                                            {{ $data->jenis_insiden === 'Kejadian Tidak Cedera / KTC' ? 'checked' : '' }}>
                                        <label for="jenIn5">Kejadian Tidak Cedera / KTC</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PELAPOR INSIDEN --}}
                    <div class="col-md-12">
                        <label for="pelapor_insiden" class="form-label me-3 text-bold">5. Orang Pertama yang Melaporkan
                            Insiden</label>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input name="pelapor_insiden"
                                            value="Karyawan : Dokter / Perawat / Petugas Lainnya" type="radio"
                                            id="pelIn1" required
                                            data-validation-required-message="This field is required"
                                            {{ $data->pelapor_insiden === 'Karyawan ( Dokter / Perawat / Petugas Lainnya )' ? 'checked' : '' }}>
                                        <label for="pelIn1">Karyawan ( Dokter / Perawat / Petugas Lainnya )</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input name="pelapor_insiden" value="Keluarga / Pendamping" type="radio"
                                            id="pelIn2" required
                                            data-validation-required-message="This field is required"
                                            {{ $data->pelapor_insiden === 'Keluarga / Pendamping' ? 'checked' : '' }}>
                                        <label for="pelIn2">Keluarga / Pendamping</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input name="pelapor_insiden" value="Pasien" type="radio" id="pelIn3" required
                                            data-validation-required-message="This field is required"
                                            {{ $data->pelapor_insiden === 'Pasien' ? 'checked' : '' }}>
                                        <label for="pelIn3">Pasien</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input name="pelapor_insiden" value="Pengunjung" type="radio" id="pelIn4"
                                            required data-validation-required-message="This field is required"
                                            {{ $data->pelapor_insiden === 'Pengunjung' ? 'checked' : '' }}>
                                        <label for="pelIn4">Pengunjung</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-25 mt-2 p-0">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <input name="pelapor_insiden" type="radio" id="pelIn5" value="" required
                                                    data-validation-required-message="This field is required"
                                                    {{ $data->pelapor_insiden !== 'Karyawan ( Dokter / Perawat / Petugas Lainnya )' && $data->pelapor_insiden !== 'Pasien' && $data->pelapor_insiden !== 'Keluarga / Pendamping' ? 'checked' : '' }}>
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
                        </div>
                    </div>

                    {{-- KORBAN INSIDEN --}}
                    <div class="col-md-12">
                        <label for="korban_insiden" class="form-label text-bold">6. Insiden terjadi pada</label>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input name="korban_insiden" type="radio" class="form-check-input"
                                            value="Pasien" id="korIn1" required
                                            data-validation-required-message="This field is required"
                                            {{ $data->korban_insiden === 'Pasien' ? 'checked' : '' }}>
                                        <label for="korIn1">Pasien</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-25 p-0">
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <input name="korban_insiden" type="radio"
                                                    class="form-check-input mt-0 ms-0" id="korIn2" value="" required
                                                    data-validation-required-message="This field is required"
                                                    {{ $data->korban_insiden !== 'Pasien' ? 'checked' : '' }}>
                                                <label class="mb-2" for="korIn2"
                                                    style="padding-left: 20px;height: 17px;"></label>
                                            </div>
                                            <input id="korban_lain" type="text" class="form-control"
                                                aria-label="Text input with radio button" placeholder="Lain-lain"
                                                onclick="selectRadio('korIn2')"
                                                oninput="syncInputRadio('korIn2', 'korban_lain')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- LAYANAN INSIDEN --}}
                    <div class="col-md-12">
                        <label for="layanan_insiden" class="form-label text-bold">7. Insiden menyangkut pasien</label>
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <div class="form-check form-check-inlne ms-3">
                                <input name="layanan_insiden" type="radio" value="Pasien rawat inap" id="layIn1"
                                    required data-validation-required-message="This field is required"
                                    {{ $data->layanan_insiden === 'Pasien Rawat Inap' ? 'checked' : '' }}>
                                <label for="layIn1">Pasien rawat inap</label>
                            </div>
                            <div class="form-check form-check-inlne ms-3">
                                <input name="layanan_insiden" type="radio" value="Pasien rawat jalan" id="layIn2"
                                    required data-validation-required-message="This field is required"
                                    {{ $data->layanan_insiden === 'Pasien Rawat Jalan' ? 'checked' : '' }}>
                                <label for="layIn1">Pasien rawat jalan</label>
                            </div>
                            <div class="form-check form-check-inlne ms-3">
                                <input name="layanan_insiden" type="radio" value="Pasien UGD" id="layIn3" required
                                    data-validation-required-message="This field is required"
                                    {{ $data->layanan_insiden === 'Pasien UGD' ? 'checked' : '' }}>
                                <label for="layIn3">Pasien UGD</label>
                            </div>
                            <div class="form-check form-check-inlne p-0">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <input name="layanan_insiden" type="radio" id="layIn4" value="" required
                                            data-validation-required-message="This field is required"
                                            {{ $data->layanan_insiden !== 'Pasien Rawat Inap' && $data->layanan_insiden !== 'Pasien Rawat Jalan' && $data->layanan_insiden !== 'Pasien UGD' ? 'checked' : '' }}>
                                        <label for="layIn4" style="padding-left: 20px;height: 17px;"></label>
                                    </span>
                                    <input id="layanan_lain" type="text" class="form-control"
                                        aria-label="Text input with radio button" placeholder="Lain-lain"
                                        onclick="selectRadio('layIn4')"
                                        oninput="syncInputRadio('layIn4', 'layanan_lain')">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- LOKASI INSIDEN --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="editTempLan" class="form-label text-bold">8. Tempat Insiden</label>
                                <input type="text" id="editTempLan" class="form-control" name="tempat_insiden"
                                    placeholder="Input tempat insiden" value="{{ $data->tempat_insiden }}">
                            </div>
                        </div>
                    </div>

                    {{-- INSIDEN YANG TERJADI PADA PASIEN --}}
                    <div class="col-md-12">
                        <label for="kasus_insiden" class="form-label text-bold">9. Insiden terjadi pada pasien ( sesuai
                            kasus penyakit / spesialisasi )</label>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" name="kasus_insiden[]"
                                            value="Penyakit Dalam dan Subspesialisasinya" id="insiden1"
                                            {{ in_array('Penyakit Dalam dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                        <label for="insiden1">Penyakit Dalam dan Subspesialisasinya</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" name="kasus_insiden[]"
                                            value="Anak dan Subspesialisasinya" id="insiden2"
                                            {{ in_array('Anak dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                        <label for="insiden2">Anak dan Subspesialisasinya</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" name="kasus_insiden[]"
                                            value="Bedah dan Subspesialisasinya" id="insiden3"
                                            {{ in_array('Bedah dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                        <label for="insiden3">Bedah dan Subspesialisasinya</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" name="kasus_insiden[]"
                                            value="Obstetri Gynekologi dan Subspesialisasinya" id="insiden4"
                                            {{ in_array('Obstetri Gynekologi dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                        <label for="insiden4">Obstetri Gynekologi dan Subspesialisasinya</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" name="kasus_insiden[]" value="THT dan Subspesialisasinya"
                                            id="insiden5"
                                            {{ in_array('THT dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                        <label for="insiden5">THT dan Subspesialisasinya</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" name="kasus_insiden[]"
                                            value="Mata dan Subspesialisasinya" id="insiden6"
                                            {{ in_array('Mata dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                        <label for="insiden6">Mata dan Subspesialisasinya</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" name="kasus_insiden[]"
                                            value="Saraf dan Subspesialisasinya" id="insiden7"
                                            {{ in_array('Saraf dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                        <label for="insiden7">Saraf dan Subspesialisasinya</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" name="kasus_insiden[]"
                                            value="Anastesi dan Subspesialisasinya" id="insiden8"
                                            {{ in_array('Anastesi dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                        <label for="insiden8">Anastesi dan Subspesialisasinya</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" name="kasus_insiden[]"
                                            value="Kulit & Kelamin dan Subspesialisasinya" id="insiden9"
                                            {{ in_array('Kulit & Kelamin dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                        <label for="insiden9">Kulit & Kelamin dan Subspesialisasinya</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" name="kasus_insiden[]"
                                            value="Jantung dan Subspesialisasinya" id="insiden10"
                                            {{ in_array('Jantung dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                        <label for="insiden10">Jantung dan Subspesialisasinya</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" name="kasus_insiden[]"
                                            value="Paru dan Subspesialisasinya" id="insiden11"
                                            {{ in_array('Paru dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                        <label for="insiden11">Paru dan Subspesialisasinya</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" name="kasus_insiden[]"
                                            value="Jiwa dan Subspesialisasinya" id="insiden12"
                                            {{ in_array('Jiwa dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                        <label for="insiden12">Jiwa dan Subspesialisasinya</label>
                                    </div>

                                    <div class="form-check">
                                        <input type="checkbox" name="kasus_insiden[]"
                                            value="Orthopedi dan Subspesialisasinya" id="insiden13"
                                            {{ in_array('Orthopedi dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                        <label for="insiden12">Orthopedi dan Subspesialisasinya</label>
                                    </div>

                                    <div class="form-check">
                                        <div class="input-group mt-2">
                                            <span class="input-group-addon">
                                                <input type="checkbox" id="insiden14" name="kasus_insiden[]" value="" {{ (
                                                            collect($fixed_data_kasus_insiden)->some(function ($item) {
                                                                return !in_array($item, [
                                                                    'Penyakit Dalam dan Subspesialisasinya',
                                                                    'Anak dan Subspesialisasinya',
                                                                    'Bedah dan Subspesialisasinya',
                                                                    'Obstetri Gynekologi dan Subspesialisasinya',
                                                                    'THT dan Subspesialisasinya',
                                                                    'Mata dan Subspesialisasinya',
                                                                    'Saraf dan Subspesialisasinya',
                                                                    'Anastesi dan Subspesialisasinya',
                                                                    'Kulit & Kelamin dan Subspesialisasinya',
                                                                    'Jantung dan Subspesialisasinya',
                                                                    'Paru dan Subspesialisasinya',
                                                                    'Jiwa dan Subspesialisasinya',
                                                                    'Orthopedi dan Subspesialisasinya',
                                                                ]);
                                                            })
                                                        ) ? 'checked' : '' }}>
                                                <label for="insiden14" style="padding-left: 20px;height: 17px;"></label>
                                            </span>
                                            <input id="kasus_lain" type="text" class="form-control"
                                                aria-label="Text input with radio button" placeholder="Lain-lain"
                                                onclick="selectRadio('insiden14')"
                                                oninput="syncInputRadio('insiden14', 'kasus_lain')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- UNIT YANG TERKAIT --}}
                    <div class="col-md-12">
                        <label class="form-label text-bold">10. Unit ? Departemen terkait yang menyebabkan
                            insiden</label>
                        <input type="text" id="editUnitLap" class="form-control" name="unit_insiden"
                            placeholder="Input unit insiden" required
                            data-validation-required-message="This field is required" value="{{ $data->unit_insiden }}">
                        <div class="invalid-feedback">
                            Valid Unit Insiden is required.
                        </div>
                    </div>

                    {{-- AKIBAT TERHADAP PASIEN --}}
                    <div class="col-md-12 my-3">
                        <label class="form-label text-bold">11. Akibat insiden terhadap pasien</label>
                        <div class="form-group">
                            <div class="form-check form-check-inline ms-3">
                                <input name="dampak_insiden" type="radio" value="Kematian" id="akIn1" required
                                    data-validation-required-message="This field is required"
                                    {{ $data->dampak_insiden === 'Kematian' ? 'checked' : '' }}>
                                <label for="akIn1">Kematian</label>
                            </div>
                            <div class="form-check form-check-inline ms-3">
                                <input name="dampak_insiden" type="radio" value="Cedera Irreversibel / Cedera Berat"
                                    id="akIn2" required data-validation-required-message="This field is required"
                                    {{ $data->dampak_insiden === 'Cedera Irreversibel / Cedera Berat' ? 'checked' : '' }}>
                                <label for="akIn2">Cedera Irreversibel / Cedera Berat</label>
                            </div>
                            <div class="form-check form-check-inline ms-3">
                                <input name="dampak_insiden" type="radio" value="Cedera Reversibel / Cedera Sedang"
                                    id="akIn3" required data-validation-required-message="This field is required"
                                    {{ $data->dampak_insiden === 'Cedera Reversibel / Cedera Sedang' ? 'checked' : '' }}>
                                <label for="akIn3">Cedera Reversibel / Cedera Sedang</label>
                            </div>
                            <div class="form-check form-check-inline ms-3">
                                <input name="dampak_insiden" type="radio" value="Cedera Ringan" id="akIn4" required
                                    data-validation-required-message="This field is required"
                                    {{ $data->dampak_insiden === 'Cedera Ringan' ? 'checked' : '' }}>
                                <label for="akIn4">Cedera Ringan</label>
                            </div>
                            <div class="form-check form-check-inline ms-3">
                                <input name="dampak_insiden" type="radio" value="Tidak ada cedera" id="akIn5" required
                                    data-validation-required-message="This field is required"
                                    {{ $data->dampak_insiden === 'Tidak ada cedera' ? 'checked' : '' }}>
                                <label for="akIn5">Tidak Ada Cedera</label>
                            </div>
                        </div>
                    </div>

                    {{-- TINDAKAN SEGERA YANG DILAKUKAN --}}
                    <div class="col-md-12">
                        <label class="form-label text-bold">12. Tindakan yang dilakukan segera setelah kejadian, dan
                            hasilnya</label>
                        <textarea rows="3" id="editTinCepLap" class="form-control" name="tindakan_cepat"
                            placeholder="How is it happen" required
                            data-validation-required-message="This field is required">{{ $data->tindakan_cepat }}</textarea>
                        <div class="invalid-feedback">
                            Valid Tindakan Insiden is required.
                        </div>
                    </div>

                    {{-- YANG MELAKUKAN TINDAKAN SEGERA --}}
                    <div class="col-md-12 my-3">
                        <label for="tindakan_insiden" class="form-label text-bold">13. Tindakan dilakukan oleh</label>
                        <div class="form-group">
                            <div class="form-check ps-0">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <input name="tindakan_insiden" type="radio" id="tinIn1" value="" required
                                            data-validation-required-message="This field is required"
                                            {{ strpos($data->tindakan_insiden, 'Tim,') !== false ? 'checked' : '' }}>
                                        <label class="form-check-label" for="tinIn1">Tim</label>
                                    </span>
                                    <input id="anggota_tim" name="tindakan_insiden" type="hidden" class="form-control"
                                        aria-label="Text input with radio button">
                                    <input id="tindakan_tim" type="text" class="form-control"
                                        aria-label="Text input with radio button" placeholder="Terdiri dari"
                                        onclick="selectRadio('tinIn1')"
                                        oninput="syncInputRadioSpecial('tinIn1', 'anggota_tim', 'tindakan_tim')">
                                </div>
                            </div>
                            <div class="form-check ms-3">
                                <input name="tindakan_insiden" type="radio" value="Dokter" id="tinIn2" required
                                    data-validation-required-message="This field is required"
                                    {{ $data->tindakan_insiden === 'Dokter' ? 'checked' : '' }}>
                                <label for="tinIn2">Dokter</label>
                            </div>
                            <div class="form-check ms-3">
                                <input name="tindakan_insiden" type="radio" value="Perawat" id="tinIn3" required
                                    data-validation-required-message="This field is required"
                                    {{ $data->tindakan_insiden === 'Perawat' ? 'checked' : '' }}>
                                <label for="tinIn3">Perawat</label>
                            </div>
                            <div class="form-check ps-0">
                                <div class="input-group mt-2">
                                    <span class="input-group-text">
                                        <input name="tindakan_insiden" type="radio" id="tinIn4" value="" required
                                            data-validation-required-message="This field is required"
                                            {{ strpos($data->tindakan_insiden, 'Tim,') === false && $data->tindakan_insiden !== 'Dokter' && $data->tindakan_insiden !== 'Perawat' ? 'checked' : '' }}>
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

                    {{-- APAKAH SUDAH PERNAH TERJADI --}}
                    <div class="col-md-12">
                        <label for="kejadian_insiden" class="form-label text-bold">14. Apakah kejadian yang sama pernah
                            terjadi?</label>
                        <div class="form-group">
                            <div class="form-check ms-3">
                                <input id="pernah1" name="kejadian_insiden" type="radio" class="form-check-input"
                                    value="Ya" onclick="showTextarea('textarea_pernah')" required
                                    {{ strpos($data->kejadian_insiden, 'Ya,') !== false ? 'checked' : '' }}>
                                <label class="form-check-label" for="pernah1">Ya</label>
                                <div id="textarea_pernah" class="d-none mb-2">
                                    <label for="ket_pernah">Kapan? dan Langkah / tindakan apa yang
                                        telah diambil pada Unit Kerja tersebut untuk mencegah terulangnya
                                        kejadian yang sama?</label>
                                    <input id="des_pernah" name="kejadian_insiden" type="hidden" class="form-control"
                                        aria-label="Text input with radio button">
                                    <textarea id="ket_pernah" class="form-control mb-2"
                                        oninput="syncInputRadioSpecial('pernah1', 'des_pernah', 'ket_pernah')"></textarea>
                                </div>
                            </div>
                            <div class="form-check ms-3">
                                <input name="kejadian_insiden" type="radio" value="Tidak" id="pernah2"
                                    onclick="hideTextarea('textarea_pernah')" required
                                    data-validation-required-message="This field is required"
                                    {{ strpos($data->kejadian_insiden, 'Ya,') === false ? 'checked' : '' }}>
                                <label for="pernah2">Tidak</label>
                            </div>
                        </div>
                    </div>


                    <hr>

                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6">
                            <div class="text-center">
                                <label class="form-label text-bold fs-16">Paraf Pelapor Insiden</label>
                            </div>
                            <div class="form-group">
                                <p>Untuk Paraf, apakah ingin memasukkan Paraf baru?</p>
                                <div class="signature-option text-right mb-3">
                                    <button type="button" class="btn btn-success btn-sm" id="new-signature"><i
                                            class="fa fa-check"></i> Ya</button>
                                    <button type="button" class="btn btn-warning btn-sm" id="old-signature"><i
                                            class="fa fa-undo"></i> Gunakan Paraf lama</button>
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

@include('script.lapinEdit')
@include('script.autoSelectRadio')
@include('script.editProcess')
@include('script.editSignature')



@endsection
