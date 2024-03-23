@extends('index')

@section('container')
<section class="content pt-0">
    <div class="row">
        <div class="col-xl-12 col-12">
            <nav>
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tabel Laporan KPCS</li>
                </ol>
            </nav>
            <div class="box">
                <div class="box-header py-4">
                    <h4 class="box-title">Tabel Laporan KPCS</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover display margin-top-10 w-p100">
                            <thead class="text-center">
                                <tr>
                                    <th class="min-w-200">Unit Kerja Pelapor</th>
                                    <th class="min-w-300">Kondisi Potensial Cedera</th>
                                    <th class="min-w-150">Tanggal Ditemukan</th>
                                    <th class="min-w-120">Jam Ditemukan</th>
                                    <th class="min-w-150">Pelapor Insiden</th>
                                    <th class="min-w-150">Tempat Insiden</th>
                                    <th class="min-w-150">Unit Insiden</th>
                                    <th class="min-w-300">Tindakan Cepat</th>
                                    <th class="min-w-200">Tindakan Insiden</th>
                                    <th class="min-w-300">Kejadian Insiden</th>
                                    <th class="min-w-150">Status</th>
                                    <th class="min-w-150">Pembuat Laporan</th>
                                    <th class="min-w-150">Tanggal Lapor</th>
                                    <th class="min-w-150">Penerima laporan</th>
                                    <th class="min-w-150">Tanggal Terima</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lapkpcs as $lapkpc)
                                <tr>
                                    <td> {{ $lapkpc->unit_kerja }} </td>
                                    <td> {{ $lapkpc->kpc }} </td>
                                    <td> {{ $lapkpc->tanggal_ditemukan }} </td>
                                    <td> {{ $lapkpc->jam_ditemukan }} </td>
                                    <td> {{ $lapkpc->pelapor_insiden }} </td>
                                    <td> {{ $lapkpc->tempat_insiden }} </td>
                                    <td> {{ $lapkpc->unit_insiden }} </td>
                                    <td> {{ $lapkpc->tindakan_cepat }} </td>
                                    <td> {{ $lapkpc->tindakan_insiden }} </td>
                                    <td> {{ $lapkpc->kejadian_insiden }} </td>
                                    <td> {{ $lapkpc->status }} </td>
                                    <td> {{ $lapkpc->pembuat_laporan }} </td>
                                    <td> {{ $lapkpc->created_at }} </td>
                                    <td> {{ $lapkpc->penerima_laporan }} </td>
                                    <td> {{ $lapkpc->tanggal_terima }} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
@endsection
