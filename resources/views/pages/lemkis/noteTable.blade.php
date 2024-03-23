@extends('index')

@section('container')
<section class="content pt-0">
    <div class="row">
        <div class="col-xl-12 col-12">
            <nav>
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="/lemkis">Kelola LEMKIS</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tabel Catatan Tambahan</li>
                </ol>
            </nav>
            <div class="box">
                <div class="box-header py-4">
                    <h4 class="box-title">Tabel Catatan Tambahan untuk {{ $data->lapin->nama }} -
                        {{ $data->lapin->noRM }}</h4>
                    <div class="box-controls pull-right d-md-flex d-none">
                        <a href="{{ url('/lemkis/addNote' , $data->id) }}"
                            class="btn btn-info btn-sm mb-2 text-decoration-none">
                            <i class="fas fa-tools"></i> Manage
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover display margin-top-10 w-p100">
                            <thead class="text-center">
                                <tr>
                                    <td class="">Catatan</td>
                                    <td class="min-w-150">Tanggal</td>
                                    <td class="min-w-150">Narasumber</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fixed_data_catatan as $catatan)
                                <tr>
                                    <td>{{ $catatan }}</td>
                                    <td>{{ $fixed_data_tanggal[$loop->index] }}</td>
                                    <td>{{ $fixed_data_narasumber[$loop->index] }}</td>
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
