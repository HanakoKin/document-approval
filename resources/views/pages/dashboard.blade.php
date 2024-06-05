@extends('index')

@section('container')
    <section class="content">

        @if (session()->has('success'))
            @include('script.alert.success')
        @endif

        @if (session()->has('error'))
            @include('script.alert.error')
        @endif

        <div class="row">

            <div class="col-lg-8 col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="d-flex justify-content-between">
                            <button id="prevBtn"
                                class="waves-effect waves-light btn btn-sm btn-outline btn-rounded btn-info"><i
                                    class="fas fa-caret-circle-left"></i></button>
                            <div class="d-flex">
                                <h4 class="me-4">All Documents <span id="yearDisplay"></span></h4>
                            </div>
                            <button id="nextBtn"
                                class="waves-effect waves-light btn btn-sm btn-outline btn-rounded btn-info"><i
                                    class="fas fa-caret-circle-right"></i></button>
                        </div>
                        <div>
                            <canvas id="line-chart1" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <a id="mr_link" class="box box-link-shadow text-center pull-up"
                                    href="{{ route('shortcut', ['type' => 'memo', 'category' => 'receive', 'year' => '2024']) }}">
                                    <div class="box-body py-25 bg-info-light px-5">
                                        <p class="fw-600 text-info">Memo's Received</p>
                                    </div>
                                    <div class="box-body">
                                        <h1 id="memo_received" class="countnm fs-50 m-0"></h1>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a id="ms_link" class="box box-link-shadow text-center pull-up"
                                    href="{{ route('shortcut', ['type' => 'memo', 'category' => 'sent', 'year' => '2024']) }}">
                                    <div class="box-body py-25 bg-info-light px-5">
                                        <p class="fw-600 text-info">Memo's Sent</p>
                                    </div>
                                    <div class="box-body">
                                        <h1 id="memo_sent" class="countnm fs-50 m-0"></h1>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <a id="da_link" class="box box-link-shadow text-center pull-up"
                                    href="{{ route('shortcut', ['type' => 'document', 'category' => 'approved', 'year' => '2024']) }}">
                                    <div class="box-body py-25 bg-info-light px-5">
                                        <p class="fw-600 text-info">Document's Approved</p>
                                    </div>
                                    <div class="box-body">
                                        <h1 id="documents_approved" class="countnm fs-50 m-0"></h1>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a id="dp_link" class="box box-link-shadow text-center pull-up"
                                    href="{{ route('shortcut', ['type' => 'document', 'category' => 'pending', 'year' => '2024']) }}">
                                    <div class="box-body py-25 bg-info-light px-5">
                                        <p class="fw-600 text-info">Document's Pending</p>
                                    </div>
                                    <div class="box-body">
                                        <h1 id="documents_pending" class="countnm fs-50 m-0"></h1>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 d-flex">
                                <a id="dna_link"
                                    class="box box-link-shadow text-center flex-fill d-flex flex-column pull-up"
                                    href="{{ route('shortcut', ['type' => 'document', 'category' => 'approval', 'year' => '2024']) }}">
                                    <div class="box-body py-25 bg-info-light px-5">
                                        <p class="fw-600 text-info">Document's Need Approval</p>
                                    </div>
                                    <div class="box-body mt-auto">
                                        <h1 id="documents_need_approval" class="countnm fs-50 m-0"></h1>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 d-flex">
                                <a id="dr_link"
                                    class="box box-link-shadow text-center flex-fill d-flex flex-column pull-up"
                                    href="{{ route('shortcut', ['type' => 'document', 'category' => 'receive', 'year' => '2024']) }}">
                                    <div class="box-body py-25 bg-info-light px-5">
                                        <p class="fw-600 text-info">Document's Received</p>
                                    </div>
                                    <div class="box-body mt-auto">
                                        <h1 id="documents_received" class="countnm fs-50 m-0"></h1>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('script.chart.line-chart')
@endsection
