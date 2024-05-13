@extends('index')

@section('container')
    <section class="content pt-0">

        @if (session()->has('success'))
            @include('script.alert.success')
        @endif

        @if (session()->has('error'))
            @include('script.alert.error')
        @endif


        <div class="row">
            <div class="col-xl-12 col-12">

                <div class="d-inline-block align-items-center pb-2">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tabel Document</li>
                        </ol>
                    </nav>
                </div>

                <div class="col-md-6 col-12 mx-auto">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="box pull-up">
                                <div class="box-body d-flex align-items-center">
                                    <img src="{{ asset('assets/images/medical-nurse.png') }}" alt=""
                                        class="align-self-end h-80 w-80">
                                    <div class="d-flex flex-column flex-grow-1">
                                        <h5 class="box-title fs-16 mb-2">Sasaran Keselamatan Pasien</h5>
                                        <a href="/skp">Go to SKP</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="box pull-up">
                                <div class="box-body d-flex align-items-center">
                                    <img src="{{ asset('assets/images/medical-doctor.png') }}" alt=""
                                        class="align-self-end h-80 w-80">
                                    <div class="d-flex flex-column flex-grow-1">
                                        <h5 class="box-title fs-16 mb-2">Clinical Pathway</h5>
                                        <a href="{{ url('/memo', 'sent') }}">Go to CP</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection
