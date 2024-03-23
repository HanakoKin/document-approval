@extends('index')

@section('container')
<section class="content pt-0">
    <div class="row">
        <div class="col-xl-12 col-12">
            <nav>
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tabel Laporan Insiden</li>
                </ol>
            </nav>
            <div class="box">
                <div class="box-header py-4">
                    <h4 class="box-title">Tabel Laporan Insiden</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover display margin-top-10">
                            <thead class="text-center">
                                <tr>
                                    <th class="min-w-200">Unit Kerja Pelapor</th>
                                    <th class="min-w-200">Name</th>
                                    <th class="min-w-100">No Register</th>
                                    <th class="min-w-150">Ruangan</th>
                                    <th class="min-w-150">Umur</th>
                                    <th class="min-w-150">Jenis Kelamin
                                    </th>
                                    <th class="min-w-100">Penjamin</th>
                                    <th class="min-w-100">Tanggal Masuk</th>
                                    <th class="min-w-100">Jam Masuk</th>
                                    <th class="min-w-120">Tanggal Kejadian</th>
                                    <th class="min-w-100">Jam Kejadian</th>
                                    <th class="min-w-150">Insiden</th>
                                    <th class="min-w-300">Kronologis</th>
                                    <th class="min-w-150">Jenis Insiden</th>
                                    <th class="min-w-150">Pelapor Insiden</th>
                                    <th class="min-w-150">Korban Insiden</th>
                                    <th class="min-w-150">Layanan Insiden</th>
                                    <th class="min-w-150">Tempat Insiden</th>
                                    <th class="min-w-200">Kasus Insiden</th>
                                    <th class="min-w-100">Unit Insiden</th>
                                    <th class="min-w-200">Dampak Insiden</th>
                                    <th class="min-w-300">Tindakan Cepat
                                    </th>
                                    <th class="min-w-200">Tindakan Insiden</th>
                                    <th class="min-w-300">Kejadian
                                        Insiden</th>
                                    <th class="min-w-150">Status</th>
                                    <th class="min-w-150">Pembuat Laporan</th>
                                    <th class="min-w-150">Tanggal Lapor</th>
                                    <th class="min-w-150">Penerima Laporan</th>
                                    <th class="min-w-150">Tanggal Terima</th>
                                    <th class="min-w-150">Grading</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lapins as $lapin)
                                <tr>
                                    <td> {{ $lapin->unit_kerja }} </td>
                                    <td> {{ $lapin->nama }} </td>
                                    <td> {{ $lapin->noRM }} </td>
                                    <td> {{ $lapin->ruangan }} </td>
                                    <td> {{ $lapin->umur }} </td>
                                    <td> {{ $lapin->jenis_kelamin }} </td>
                                    <td> {{ $lapin->penjamin }} </td>
                                    <td> {{ $lapin->tanggal_masuk }} </td>
                                    <td> {{ $lapin->jam_masuk }} </td>
                                    <td> {{ $lapin->tanggal_kejadian }} </td>
                                    <td> {{ $lapin->jam_kejadian }} </td>
                                    <td> {{ $lapin->insiden }} </td>
                                    <td> {{ $lapin->kronologis }} </td>
                                    <td> {{ $lapin->jenis_insiden }} </td>
                                    <td> {{ $lapin->pelapor_insiden }} </td>
                                    <td> {{ $lapin->korban_insiden }} </td>
                                    <td> {{ $lapin->layanan_insiden }} </td>
                                    <td> {{ $lapin->tempat_insiden }} </td>
                                    <td> {{ $lapin->kasus_insiden }} </td>
                                    <td> {{ $lapin->unit_insiden }} </td>
                                    <td> {{ $lapin->dampak_insiden }} </td>
                                    <td> {{ $lapin->tindakan_cepat }} </td>
                                    <td> {{ $lapin->tindakan_insiden }} </td>
                                    <td> {{ $lapin->kejadian_insiden }} </td>
                                    <td> {{ $lapin->status }} </td>
                                    <td> {{ $lapin->pembuat_laporan }} </td>
                                    <td> {{ $lapin->created_at }} </td>
                                    <td> {{ $lapin->penerima_laporan }} </td>
                                    <td> {{ $lapin->tanggal_terima }} </td>
                                    <td> {{ $lapin->grading_risiko ? ucfirst(trans($lapin->grading_risiko)) : '' }}
                                    </td>
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
