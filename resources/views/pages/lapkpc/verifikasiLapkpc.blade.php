@extends('index')

@section('container')

<section class="invoice printableArea content">
    <div class="row">

        @if(session()->has('success'))
        @include('script.success')
        @endif

        @if(session()->has('error'))
        @include('script.error')
        @endif

        <div class="col-12">

            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center clearFix no-print">
                        <div class="d-block align-items-center pb-0">
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i
                                                class="mdi mdi-home-outline"></i></a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/lapkpc">Kelola Laporan KPCS</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Verifikasi Laporan KPCS
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-block">

                            @if (Auth::user()->role !== 'user')
                            <button class="btn btn-success" data-bs-toggle="modal"
                                onclick="showVerifModal({{ json_encode($data) }})">
                                <i class="fal fa-eye"></i> Verifikasi
                            </button>
                            @endif

                            <button id="print2" class="btn btn-warning" type="button"> <span><i class="fa fa-print"></i>
                                    Print</span> </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center invoice-info">
                <div class="col-12">
                    <div class="box box-widget widget-user shadow-none">
                        <div class="box-footer py-0 border-0">
                            <div class="d-flex justify-content-between align-items-center m-20">
                                <img src="{{ asset('assets/images/Husada.png') }}" width="70" alt="">
                                <div class="">
                                    <h4>Unit Kerja / Ruangan:</h4>
                                    <span>{{ $data->unit_kerja }}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <h4 class="b-4 text-center d-inline-block p-3 rounded10 border-dark">
                                    RAHASIA, TIDAK BOLEH DIFOTOCOPY, DILAPORKAN MAXIMAL 2x24 JAM
                                </h4>
                            </div>
                            <div class="text-center">
                                <h4 class="box-title text-bold mt-20">LAPORAN KONDISI POTENSIAL CEDERA SIGNIFIKAN (KPCS)
                                </h4>
                                <h4 class="box-title text-bold mt-5 mb-20">(INTERNAL)</h4>
                            </div>

                            {{-- Tanggal & Jam ditemukan insiden --}}
                            <div class="row">
                                <h5>1. Tanggal dan Waktu ditemukan Kondisi Potensi Cedera (KPC)</h5>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Tanggal</h5>
                                        </div>
                                        <div class="col-6">
                                            <span>: {{ $data->tanggal_ditemukan }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Jam </h5>
                                        </div>
                                        <div class="col-9">
                                            <span>: {{ $data->jam_ditemukan }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Insiden KPC --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>2. KPC :</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-9">
                                            <p class="ms-4">{{ $data->kpc }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Pelapor Insiden --}}
                            <div class="row">
                                <div class="col-12">
                                    <h5>3. Orang pertama yang melaporkan Insiden :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->pelapor_insiden }}</p>
                                </div>
                            </div>

                            {{-- Lokasi Insiden --}}
                            <div class="row">
                                <div class="col-12">
                                    <h5>4. Lokasi Insiden :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->tempat_insiden }}</p>
                                </div>
                            </div>

                            {{-- Unit Insiden --}}
                            <div class="row">
                                <div class="col-12">
                                    <h5>5. Unit / Departemen terkait KPC :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->unit_insiden }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>6. Tindakan apa yang dilakukan untuk mengatasi kondisi potensi cedera selama ini
                                        :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->tindakan_cepat }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>7. Tindakan dilakukan oleh :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->tindakan_insiden }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>8. Apakah kejadian yang sama pernah terjadi di Unit Kerja lain? :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->kejadian_insiden }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Pembuat Laporan</td>
                                    <td>{{ $data->pembuat_laporan }}</td>
                                    <td>Penerima Laporan</td>
                                    <td>{{ $data->penerima_laporan }}</td>
                                </tr>
                                <tr>
                                    <td>Paraf</td>
                                    <td><img src="{{ $data->paraf_pelapor }}" alt="" width="200"></td>
                                    <td>Paraf</td>
                                    <td class="min-w-200"><img src="{{ $data->paraf_penerima }}" alt="" width="200"></td></td>
                                </tr>
                                <tr>
                                    <td>Tgl Lapor</td>
                                    <td>{{ $data->created_at->format('Y-m-d') }}</td>
                                    <td>Tgl Terima</td>
                                    <td>{{ $data->tanggal_terima }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Modal Verification --}}
@include('modal.verifData')

{{-- JS for Showing Modal --}}
@include('script.popupVerif')

@endsection
