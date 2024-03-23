@extends('index')

@section('container')
<section class="content pt-0">
    <div class="row">
        <div class="col-xl-12 col-12">
            <nav>
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tabel LEMKIS</li>
                </ol>
            </nav>
            <div class="box">
                <div class="box-header py-4">
                    <h4 class="box-title">Tabel Lembar Kerja Investigasi Sederhana</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover display margin-top-10 w-p100">
                            <thead class="text-center">
                                <tr>
                                    <th rowspan="2" class="min-w-200">Unit Kerja Pelapor</th>
                                    <th rowspan="2" class="min-w-300">Penyebab Langsung</th>
                                    <th rowspan="2" class="min-w-300">Penyebab Awal</th>
                                    <th colspan="3">Rekomendasi Jangka Pendek</th>
                                    <th colspan="3">Rekomendasi Jangka Menengah</th>
                                    <th colspan="3">Rekomendasi Jangka Panjang</th>
                                    <th colspan="3">Tindakan Jangka Pendek</th>
                                    <th colspan="3">Tindakan Jangka Menengah</th>
                                    <th colspan="3">Tindakan Jangka Panjang</th>
                                    <th colspan="5">Ka.Ru, Ka.Sie, Ka.Bag Yang Melengkapi</th>
                                    <th colspan="5">Bagian yang perlu diinformasikan</th>
                                    <th colspan="4">Tim Keselamatan Pasien</th>
                                </tr>
                                <tr>
                                    <th class="min-w-300">Rekomendasi</th>
                                    <th class="min-w-150">Penanggung Jawab</th>
                                    <th class="min-w-150">Tanggal</th>
                                    <th class="min-w-300">Rekomendasi</th>
                                    <th class="min-w-150">Penanggung Jawab</th>
                                    <th class="min-w-150">Tanggal</th>
                                    <th class="min-w-300">Rekomendasi</th>
                                    <th class="min-w-150">Penanggung Jawab</th>
                                    <th class="min-w-150">Tanggal</th>
                                    <th class="min-w-300">Tindakan</th>
                                    <th class="min-w-150">Penanggung Jawab</th>
                                    <th class="min-w-150">Tanggal</th>
                                    <th class="min-w-300">Tindakan</th>
                                    <th class="min-w-150">Penanggung Jawab</th>
                                    <th class="min-w-150">Tanggal</th>
                                    <th class="min-w-300">Tindakan</th>
                                    <th class="min-w-150">Penanggung Jawab</th>
                                    <th class="min-w-150">Tanggal</th>
                                    <th class="min-w-150">Nama</th>
                                    <th class="min-w-150">Tanda tangan</th>
                                    <th class="min-w-150">Bagian / Peran</th>
                                    <th class="min-w-150">Tanggal Mulai Investigasi</th>
                                    <th class="min-w-150">Tanggal Dilengkapi</th>
                                    <th class="min-w-150">Tanggal Diinformasikan</th>
                                    <th class="min-w-150">Direksi RS Husada</th>
                                    <th class="min-w-150">Asdir / Manajer Keperawatan</th>
                                    <th class="min-w-150">Tim Keselamatan Pasien</th>
                                    <th class="min-w-150">Ka.Bag Personalia</th>
                                    <th class="min-w-150">Investigasi Lengkap</th>
                                    <th class="min-w-150">Tanggal Pengesahan</th>
                                    <th class="min-w-150">Kelanjutan Investigasi</th>
                                    <th class="min-w-150">Grading Ulang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lemkis as $item)
                                <tr>
                                    <td> {{ $item->unit_kerja }} </td>
                                    <td> {{ $item->penyebab_langsung }} </td>
                                    <td> {{ $item->penyebab_awal }} </td>
                                    <td> {{ $item->rekom_invest_pendek }} </td>
                                    <td> {{ $item->penanggung_invest_pendek }} </td>
                                    <td> {{ $item->tanggal_invest_pendek }} </td>
                                    <td> {{ $item->rekom_invest_menengah }} </td>
                                    <td> {{ $item->penanggung_invest_menengah }} </td>
                                    <td> {{ $item->tanggal_invest_menengah }} </td>
                                    <td> {{ $item->rekom_invest_panjang }} </td>
                                    <td> {{ $item->penanggung_invest_panjang }} </td>
                                    <td> {{ $item->tanggal_invest_panjang }} </td>
                                    <td> {{ $item->realisasi_invest_pendek }} </td>
                                    <td> {{ $item->penanggung_realisasi_pendek }} </td>
                                    <td> {{ $item->tanggal_realisasi_pendek }} </td>
                                    <td> {{ $item->realisasi_invest_menengah }} </td>
                                    <td> {{ $item->penanggung_realisasi_menengah }} </td>
                                    <td> {{ $item->tanggal_realisasi_menengah }} </td>
                                    <td> {{ $item->realisasi_invest_panjang }} </td>
                                    <td> {{ $item->penanggung_realisasi_panjang }} </td>
                                    <td> {{ $item->tanggal_realisasi_panjang }} </td>
                                    <td> {{ $item->nama_pelengkap }} </td>
                                    <td> {{ $item->ttd_pelengkap }} </td>
                                    <td> {{ $item->bagian_pelengkap }} </td>
                                    <td> {{ $item->tanggal_mulai_invest }} </td>
                                    <td> {{ $item->tanggal_dilengkapi }} </td>
                                    <td> {{ $item->tanggal_informasi }} </td>
                                    <td> {{ $item->direksi }} </td>
                                    <td> {{ $item->asdir }} </td>
                                    <td> {{ $item->timkes }} </td>
                                    <td> {{ $item->personalia }} </td>
                                    <td> {{ $item->invest_lengkap }} </td>
                                    <td> {{ $item->tanggal_pengesahan }} </td>
                                    <td> {{ $item->invest_lanjut }} </td>
                                    <td> {{ $item->grading_akhir }} </td>
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
