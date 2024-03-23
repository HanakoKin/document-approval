@extends('index')

@section('container')
    <section class="invoice printableArea content">
        <div class="row">

            @if (session()->has('success'))
                @include('script.success')
            @endif

            @if (session()->has('error'))
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
                                        <li class="breadcrumb-item"><a href="/lapin">Kelola Laporan Insiden</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Verifikasi Laporan Insiden
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

                                <button id="print2" class="btn btn-warning" type="button"> <span><i
                                            class="fa fa-print"></i> Print</span> </button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center invoice-info mt-15">
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
                                    <h4 class="box-title mt-15 text-bold">LAPORAN INSIDEN SIGNIFIKAN</h4>
                                    <h4 class="box-title mt-5 mb-20 text-bold">(INTERNAL)</h4>
                                </div>

                                <h4 class="box-title mt-20"><strong>I. DATA PASIEN </strong></h4>

                                {{-- Nama --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>Nama </h5>
                                            </div>
                                            <div class="col-9">
                                                <span>: {{ $data->nama }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- No RM & Ruangan --}}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>No RM </h5>
                                            </div>
                                            <div class="col-6">
                                                <span>: {{ $data->noRM }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>Ruangan </h5>
                                            </div>
                                            <div class="col-9">
                                                <span>: {{ $data->ruangan }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Umur --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>Umur </h5>
                                            </div>
                                            <div class="col-9">
                                                <span>: {{ $data->umur }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Jenis Kelamin --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>Jenis Kelamin </h5>
                                            </div>
                                            <div class="col-9">
                                                <span>: {{ $data->jenis_kelamin }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Penanggung biaya pasien --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>Penanggung biaya pasien</h5>
                                            </div>
                                            <div class="col-9">
                                                <span>: {{ $data->penjamin }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tanggal & Jam Masuk RS --}}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Tanggal Masuk RS</h5>
                                            </div>
                                            <div class="col-6">
                                                <span>: {{ $data->tanggal_masuk }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>Jam </h5>
                                            </div>
                                            <div class="col-9">
                                                <span>: {{ $data->jam_masuk }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="box-title mt-20"><strong>II. RINCIAN KEJADIAN</strong></h4>

                                {{-- Tanggal & Jam Kejadian Insiden --}}
                                <div class="row">
                                    <h5>1. Tanggal dan Waktu Insiden</h5>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5>Tanggal</h5>
                                            </div>
                                            <div class="col-6">
                                                <span>: {{ $data->tanggal_kejadian }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>Jam </h5>
                                            </div>
                                            <div class="col-9">
                                                <span>: {{ $data->jam_kejadian }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Insiden --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-3">
                                                <h5>2. Insiden </h5>
                                            </div>
                                            <div class="col-9">
                                                <span>: {{ $data->insiden }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Kronologis --}}
                                <div class="row">
                                    <div class="col-12">
                                        <h5>3. Kronologis :</h5>
                                    </div>
                                    <div class="col-12">
                                        <p class="ms-4">{{ $data->kronologis }}</p>
                                    </div>
                                </div>

                                {{-- Jenis Insiden --}}
                                <div class="row">
                                    <div class="col-12">
                                        <h5>4. Jenis Insiden :</h5>
                                    </div>
                                    <div class="col-12">
                                        <p class="ms-4">{{ $data->jenis_insiden }}</p>
                                    </div>
                                </div>

                                {{-- Pelapor Insiden --}}
                                <div class="row">
                                    <div class="col-12">
                                        <h5>5. Orang pertama yang melaporkan insiden :</h5>
                                    </div>
                                    <div class="col-12">
                                        <p class="ms-4">{{ $data->pelapor_insiden }}</p>
                                    </div>
                                </div>

                                {{-- Korban Insiden --}}
                                <div class="row">
                                    <div class="col-12">
                                        <h5>6. Insiden terjadi pada :</h5>
                                    </div>
                                    <div class="col-12">
                                        <p class="ms-4">{{ $data->korban_insiden }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h5>7. Insiden menyangkut pasien :</h5>
                                    </div>
                                    <div class="col-12">
                                        <p class="ms-4">{{ $data->layanan_insiden }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h5>8. Tempat Insiden :</h5>
                                    </div>
                                    <div class="col-12">
                                        <p class="ms-4">{{ $data->tempat_insiden }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h5>9. Insiden terjadi pada pasien :</h5>
                                    </div>
                                    <div class="col-12">
                                        <p class="ms-4">{{ $data->kasus_insiden }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h5>10. Unit / Departemen terkait yang menyebabkan insiden :</h5>
                                    </div>
                                    <div class="col-12">
                                        <p class="ms-4">{{ $data->unit_insiden }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h5>11. Akibat insiden terhadap pasien :</h5>
                                    </div>
                                    <div class="col-12">
                                        <p class="ms-4">{{ $data->dampak_insiden }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h5>12. Tindakan yang dilakukan segera setelah kejadian, dan hasilnya :</h5>
                                    </div>
                                    <div class="col-12">
                                        <p class="ms-4">{{ $data->tindakan_cepat }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h5>13. Tindakan dilakukan oleh :</h5>
                                    </div>
                                    <div class="col-12">
                                        <p class="ms-4">{{ $data->tindakan_insiden }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <h5>14. Apakah kejadian yang sama pernah terjadi di unit kerja lain? </h5>
                                    </div>
                                    <div class="col-12">
                                        <p class="ms-4">{{ $data->kejadian_insiden }}</p>
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
                                                <td><img src="{{ $data->paraf_pelapor }}" alt="" width="200">
                                                </td>
                                                <td>Paraf</td>
                                                <td class="min-w-200"><img src="{{ $data->paraf_penerima }}"
                                                        alt="" width="200"></td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tgl Lapor</td>
                                                <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                                <td>Tgl Terima</td>
                                                <td>{{ $data->tanggal_terima }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @if (
                                    $data->grading_risiko === 'biru' ||
                                        $data->grading_risiko === 'hijau' ||
                                        $data->grading_risiko === 'kuning' ||
                                        $data->grading_risiko === 'merah')
                                    <div class="col-md-12 mb-5">
                                        <label for="grading_risiko" class="form-label me-3 text-bold fs-20">Grading Risiko
                                            Kejadian</label>
                                        <div class="d-flex align-items-center">
                                            <div class="form-group mb-10">
                                                <div
                                                    class="form-check form-check-inline ps-0 pe-3 mb-0 me-0 ms-3 {{ $data->grading_risiko === 'biru' ? 'b-2 border-primary rounded10' : '' }}">
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="d-inline-block w-20 h-20 m-2 rounded50 {{ $data->grading_risiko === 'biru' ? 'b-5 border-primary' : 'b-2' }}">
                                                        </div>
                                                        <label for="grading1">Biru</label>
                                                    </div>
                                                </div>
                                                <div class="form-check form-check-inline ps-0 pe-3 mb-0 me-0 ms-3"
                                                    style="{{ $data->grading_risiko === 'hijau' ? 'border: 2px solid #0AD200; border-radius: 10px' : '' }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-inline-block w-20 h-20 m-2 rounded50"
                                                            style="{{ $data->grading_risiko === 'hijau' ? 'border: 5px solid #0AD200' : 'border: 2px' }}">
                                                        </div>
                                                        <label for="grading2">Hijau</label>
                                                    </div>
                                                </div>
                                                <div class="form-check form-check-inline ps-0 pe-3 mb-0 me-0 ms-3"
                                                    style="{{ $data->grading_risiko === 'kuning' ? 'border: 2px solid #FFF100; border-radius: 10px' : '' }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-inline-block w-20 h-20 m-2 rounded50"
                                                            style="{{ $data->grading_risiko === 'kuning' ? 'border: 5px solid #FFF100' : 'border: 2px' }}">
                                                        </div>
                                                        <label for="grading3">Kuning</label>
                                                    </div>
                                                </div>
                                                <div class="form-check form-check-inline ps-0 pe-3 mb-0 me-0 ms-3"
                                                    style="{{ $data->grading_risiko === 'merah' ? 'border: 2px solid #FA0001; border-radius: 10px' : '' }}">
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-inline-block w-20 h-20 m-2 rounded50"
                                                            style="{{ $data->grading_risiko === 'merah' ? 'border: 5px solid #FA0001' : 'border: 2px' }}">
                                                        </div>
                                                        <label for="grading4">Merah</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
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
