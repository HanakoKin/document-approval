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

                <div class="d-inline-block align-items-center pb-2">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Tabel Sensus Harian untuk Admission
                            </li>
                        </ol>
                    </nav>
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
                        <form action="{{ url('/submit-admission') }}" method="post" id="form-submit"
                            enctype="multipart/form-data">
                            @csrf

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
                                    <tbody id="tableBody">
                                        {{-- @foreach ($question as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <label>{{ $item }}</label>
                                                </td>
                                                @for ($i = 1; $i <= $totalDay; $i++)
                                                    <td><input type="number" class="form-control p-2"
                                                            value="{{ isset($mainArray[$index][$i - 1]) ? $mainArray[$index][$i - 1] : '0' }}"
                                                            min="0" id="" name="sensus[]"
                                                            style="width: 70px">
                                                    </td>
                                                @endfor
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

    @include('script.admission.addAdmission')
@endsection
