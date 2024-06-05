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
                            <li class="breadcrumb-item active" aria-current="page">Tabel Approvement</li>
                        </ol>
                    </nav>
                </div>

                <div class="box">
                    <div class="box-body">

                        @foreach ($document->approvals as $approver)
                            @if (auth()->user()->id === $approver->approver_id && $approver->approval_status !== 'Approved')
                                @php
                                    $approval_status = true;
                                @endphp
                            @endif
                        @endforeach

                        @if (!(($type === 'approval' && isset($approval_status)) || $type === 'receive'))
                            @include('pages.documents.components.progress-bar')
                        @endif

                        @if ($dispositions->count() > 0 || (auth()->user()->jabatan === 'ADMIN' && $type === 'disposisi'))
                            @include('pages.documents.components.disposition-process')
                            <hr>
                        @endif

                        <br>

                        <div class="p-3">
                            @include('pages.documents.components.show-file')
                        </div>

                        <br>
                        <hr>
                        <br>

                        @if ($type === 'approval' && $document->approval_required && isset($approval_status))
                            @include('pages.documents.components.approval-process')
                        @endif

                    </div>
                </div>
            </div>
        </div>

        @include('script.signature.addSignature')

    </section>
@endsection
