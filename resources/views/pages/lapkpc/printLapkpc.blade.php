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

                            <h4 class="box-title mt-10">Laporan Kejadian Potensi Cedera</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td width="350">KPC</td>
                                            <td>: {{ $lapkpc->kpc }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Ditemukan KPC</td>
                                            <td>: {{ $lapkpc->tanggal_ditemukan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jam Ditemukan KPC</td>
                                            <td>: {{ $lapkpc->jam_ditemukan }}</td>
                                        </tr>
                                        <tr>
                                            <td>Pelapor Insiden</td>
                                            <td>: {{ $lapkpc->pelapor_insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Insiden</td>
                                            <td>: {{ $lapkpc->tempat_insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Unit Insiden</td>
                                            <td>: {{ $lapkpc->unit_insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tindakan Cepat</td>
                                            <td>: {{ $lapkpc->tindakan_cepat }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tindakan Insiden</td>
                                            <td>: {{ $lapkpc->tindakan_insiden }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kejadian Insiden</td>
                                            <td>: {{ $lapkpc->kejadian_insiden }}</td>
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
