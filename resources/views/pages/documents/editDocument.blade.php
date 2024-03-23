@extends('index')

@section('container')
    <section class="content pt-0">

        @if (session()->has('error'))
            @include('script.alert.error')
        @endif

        <div class="row">
            <div class="col-12">

                <div class="d-inline-block align-items-center pb-2">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i
                                        class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Document</li>
                        </ol>
                    </nav>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-12">
                        {{-- Form --}}
                        <form action="{{ route('updateDocument', $document->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Document
                                            Data
                                        </h4>
                                    </div>
                                </div>

                                <hr class="my-15">

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#viewDocumentModal">
                                    View Document
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="viewDocumentModal" tabindex="-1"
                                    aria-labelledby="viewDocumentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewDocumentModalLabel">Old Document</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if (Str::endsWith($document->path, ['.jpg', '.jpeg', '.png', '.gif', '.bmp']))
                                                    <!-- Jika file adalah gambar -->
                                                    <img src="{{ Storage::url($document->path) }}" alt="Document Image">
                                                @elseif(Str::endsWith($document->path, ['.pdf']))
                                                    <!-- Jika file adalah PDF -->
                                                    <embed src="{{ asset(Storage::url($document->path)) }}"
                                                        type="application/pdf" width="100%" height="600px">
                                                @else
                                                    <!-- Jika file adalah dokumen atau format lainnya -->
                                                    <a href="{{ Storage::url($document->path) }}" target="_blank">View Old
                                                        Document</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12  my-3">
                                    <label for="naDoc" class="form-label text-bold">Input New Document</label>
                                    <input type="file" class="form-control" id="naDoc" name="document"
                                        placeholder="Document" required>
                                    <div class="invalid-feedback">
                                        Valid Document is required.
                                    </div>
                                </div>

                                <div class="col-sm-12  my-3">
                                    <label for="sender" class="form-label text-bold">Sender</label>
                                    <input type="text" class="form-control" id="sender" name="" placeholder=""
                                        value="{{ $document->sender->name }}" required readonly>
                                </div>

                                <div class="col-sm-12 my-3">
                                    <label for="receiver" class="form-label text-bold">Receiver</label>
                                    <input type="text" class="form-control" id="receiver" name="" placeholder=""
                                        value="{{ $document->receiver->name }}" required readonly>
                                </div>

                                <div class="col-sm-12 my-3">
                                    <label for="approvers" class="form-label text-bold">Approver</label>
                                    <input type="text" class="form-control" id="approvers" name="" placeholder=""
                                        value="{{ $approverNamesString }}" required readonly>
                                </div>

                            </div>

                            <div class="box-footer float-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- @include('script.document.addApprover') --}}
    </section>
@endsection
