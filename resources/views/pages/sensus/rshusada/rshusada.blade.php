@extends('index')

@section('container')
    <section class="content pt-0">

        @if (session()->has('success'))
            @include('script.success')
        @endif

        @if (session()->has('error'))
            @include('script.error')
        @endif

        <div class="row">
            <div class="col-xl-12 col-12">

                <div class="d-flex align-items-center justify-content-between py-2">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Tabel Sensus Harian untuk RS Husada
                            </li>
                        </ol>
                    </nav>
                    <div class="d-flex">
                        <a href="{{ url('/sensus/admission/add') }}" class="btn btn-info btn-sm mb-2 text-decoration-none">
                            <i class="fal fa-plus-circle"></i> Add
                        </a>
                    </div>
                </div>

                {{-- Tabel Content --}}
                <div class="box">
                    <div class="box-header py-3">
                        <div class="col-md-12 d-flex justify-content-between">
                            <button id="prevBtn"
                                class="waves-effect waves-light btn btn-sm btn-outline btn-rounded btn-info"><i
                                    class="fas fa-caret-circle-left"></i> Previous Month</button>
                            <div class="d-flex">
                                <h4 class="me-4">Tabel Sensus Harian <span id="h4Caption"></span></h4>
                            </div>
                            <button id="nextBtn"
                                class="waves-effect waves-light btn btn-sm btn-outline btn-rounded btn-info">Next Month <i
                                    class="fas fa-caret-circle-right"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-bordered table-hover display margin-top-10">
                                <thead class="text-center">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2" class="min-w-200">Insiden</th>
                                        <th id="jml_tgl">Tanggal</th>
                                    </tr>
                                    <tr id="tableHeader"></tr>
                                </thead>
                                <tbody id="tableBody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('script.rshusada.rshusada')
@endsection
