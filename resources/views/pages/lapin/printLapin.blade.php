@extends('index')

@section('container')

<section class="invoice printableArea content">
    <div class="row">
        <div class="col-12">

            <div class="row">
                <div class="col-12">
                    <div class="bb-1 clearFix no-print">
                        <div class="text-end pb-15">
                            <button class="btn btn-success" type="button"> <span><i class="fa fa-print"></i> Save</span>
                            </button>
                            <button id="print2" class="btn btn-warning" type="button"> <span><i class="fa fa-print"></i>
                                    Print</span> </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center invoice-info">
                <div class="col-12">
                    <div class="box box-widget widget-user">
                        <div class="box-footer pb-0">

                            <div class="text-center">
                                <h3 class="lapinNama"></h3>
                                <h6 class="lapinNoRM"></h6>
                            </div>

                            <h4 class="box-title mt-20">Laporan Insiden</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td width="350">Nama</td>
                                            <td>: {{ $lapin->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td>No RM</td>
                                            <td>: {{ $lapin->noRM }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ruangan</td>
                                            <td>: {{ $lapin->ruangan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Umur</td>
                                            <td>: {{ $lapin->umur }}</td>
                                        </tr>
                                        <tr>
                                            <td>Penjamin</td>
                                            <td>: {{ $lapin->penjamin }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Masuk</td>
                                            <td>: {{ $lapin->tanggal_masuk }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jam Masuk</td>
                                            <td>: {{ $lapin->jam_masuk }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Kejadian</td>
                                            <td>: {{ $lapin->tanggal_kejadian }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jam Kejadian</td>
                                            <td>: {{ $lapin->jam_kejadian }}</td>
                                        </tr>
                                        <tr>
                                            <td>Insiden</td>
                                            <td>: {{ $lapin->insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kronologis</td>
                                            <td>: {{ $lapin->kronologis }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Insiden</td>
                                            <td>: {{ $lapin->jenis_insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pelapor Insiden</td>
                                            <td>: {{ $lapin->pelapor_insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Korban Insiden</td>
                                            <td>: {{ $lapin->korban_insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Insiden menyangkut pasien</td>
                                            <td>: {{ $lapin->layanan_insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Insiden</td>
                                            <td>: {{ $lapin->tempat_insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Insiden terjadi pada pasien</td>
                                            <td>: {{ $lapin->kasus_insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Unit terkait Insiden</td>
                                            <td>: {{ $lapin->unit_insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Akibat insiden terhadap pasien</td>
                                            <td>: {{ $lapin->dampak_insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tindakan cepat yang dilakukan</td>
                                            <td>: {{ $lapin->tindakan_cepat }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tindakan dilakukan oleh</td>
                                            <td>: {{ $lapin->tindakan_insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Apakah kejadian yang sama pernah terjadi?</td>
                                            <td>: {{ $lapin->kejadian_insiden }}</td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
