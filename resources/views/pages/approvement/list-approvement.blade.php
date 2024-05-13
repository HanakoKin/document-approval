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

                {{-- Tabel Content --}}
                <div class="box">
                    <div class="box-header py-4">
                        <h4 class="box-title">Total Documents need approvement : {{ $totals }} </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-hover display margin-top-10">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Name</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Sender</th>
                                        <th scope="col">Receiver</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Approval Required</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($documents as $document)
                                        <tr class="text-center">
                                            <td>{{ $document->name }}</td>
                                            <td>{{ $document->subject }}</td>
                                            <td>{{ $document->sender->name }}</td>
                                            <td>{{ $document->receiver->name }}</td>
                                            <td>{{ $document->status }}</td>
                                            <td>{{ $document->approval_required !== 0 ? 'True' : 'False' }}</td>
                                            <td>

                                                <a class="btn btn-success btn-sm me-2 mb-2 text-decoration-none"
                                                    href="{{ route('showDocument', ['type' => $type, 'id' => $document->id]) }}">
                                                    <i class="fal fa-eye"></i> Lihat
                                                </a>

                                                @if (Auth::user()->unit === 'ADMIN')
                                                    <a class="btn btn-warning btn-sm me-2 mb-2 text-decoration-none"
                                                        href="{{ route('editDocument', $document->id) }}"><i
                                                            class="fal fa-pen"></i>
                                                        Edit
                                                    </a>

                                                    <a href="{{ route('deleteDocument', ['id' => $document->id]) }}"
                                                        data-target="document"
                                                        class="btn btn-danger btn-sm me-2 mb-2 text-decoration-none deleteBtn"><i
                                                            class="fal fa-trash-alt"></i> Delete
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- JS for Delete --}}
        @include('script.confirmation.confirm-delete')

    </section>
@endsection
