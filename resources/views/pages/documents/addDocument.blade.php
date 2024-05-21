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
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ isset($function) ? 'Edit Document' : 'Add Document' }}</li>
                        </ol>
                    </nav>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-12">
                        {{-- Form --}}
                        <form action="{{ route('addDocument') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">

                                @if (isset($function))
                                    @if (isset($document->revision_count))
                                        <input type="hidden" name="revision_count"
                                            value="{{ $document->revision_count + 1 }}">
                                    @endif
                                    <input type="hidden" name="revision_count" value="1">
                                @endif

                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i>
                                            {{ isset($function) ? 'Upload new revised of Surat Permohonan' : 'Add new Surat Permohonan' }}
                                        </h4>
                                    </div>
                                </div>

                                <hr class="my-15">

                                {{-- SENDER --}}

                                <div class="col-sm-12  my-3">
                                    <label for="subject" class="form-label text-bold">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder=""
                                        @if (isset($function)) value="{{ $document->subject }}" @endif required>
                                    <div class="invalid-feedback">
                                        Valid Subject is required.
                                    </div>
                                </div>

                                <div class="col-sm-12  my-3">
                                    <label for="description" class="form-label text-bold">Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder=""
                                        @if (isset($function)) value="{{ $document->description }} @endif">
                                    <div class="invalid-feedback">
                                        Valid Description is required.
                                    </div>
                                </div>

                                <div class="col-sm-12 my-3">
                                    <label for="receiver" class="form-label text-bold">Receiver</label>

                                    @if (isset($function))
                                        <input type="text" class="form-control" name="" placeholder=""
                                            value="{{ $document->receiver->name }}" required disabled>
                                        <input type="hidden" name="receiver" value="{{ $document->receiver_id }}">
                                    @else
                                        <select class="form-control select2" id="receiver" name="receiver">
                                            <option selected disabled>Select one receiver</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    @endif

                                </div>

                                <div class="col-sm-12 my-3">
                                    @if (isset($function))
                                        <label for="approvers" class="text-bold">Approver</label>
                                        <input type="text" class="form-control" id="approvers" name=""
                                            placeholder="" value="{{ $approverNamesString }}" required disabled>
                                        <input type="hidden" name="approvers[]" value="{{ $approverIdsString }}">
                                        <input type="hidden" name="approvers_queue[]" value="{{ $approversQueueString }}">
                                    @else
                                        <div class="form-group" id="approvers">
                                            <label for="approvers">Approver</label>

                                            <div id="approvers-container">
                                                <!-- Input akan ditambahkan secara dinamis menggunakan JavaScript -->
                                            </div>
                                        </div>
                                        <span id="add-approver-btn" class="btn btn-primary btn-sm">Add Approver</span>
                                    @endif
                                </div>

                                <div class="col-sm-12  my-3">
                                    <label for="sender" class="form-label text-bold">Sender</label>
                                    <input type="text" class="form-control" id="sender" name="" placeholder=""
                                        value="{{ Auth::user()->name }}" required readonly>
                                    <div class="invalid-feedback">
                                        Valid Sender is required.
                                    </div>
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="sender">
                                </div>

                                <div class="col-sm-12  my-3">
                                    <label for="naDoc" class="form-label text-bold">Input Document</label>
                                    <div class="selection">
                                        <ul class="nav nav-pills mb-20 d-flex justify-content-center">
                                            <li class=" nav-item me-1"> <a href="#navpills-1" class="nav-link active"
                                                    data-bs-toggle="tab" aria-expanded="false">Create Document</a> </li>
                                            <li class="nav-item"> <a href="#navpills-2" class="nav-link"
                                                    data-bs-toggle="tab" aria-expanded="false">Upload Document</a> </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-sm-12 my-3">
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div id="navpills-1" class="tab-pane active">

                                            <div class="col-sm-12  my-3">
                                                <label for="noDoc" class="form-label text-bold">No Document</label>
                                                <input type="text" class="form-control" id="noDoc" name="no_doc"
                                                    placeholder=""
                                                    @if (isset($function)) value="{{ $document->no_doc }}" readonly @endif>
                                                <div class="invalid-feedback">
                                                    Valid No Document is required.
                                                </div>
                                            </div>

                                            @if (isset($function))
                                                <textarea id="editor1" name="document_text" rows="10" cols="80">
                                                    {{ $document->document_text }}
                                                </textarea>
                                            @else
                                                <textarea id="editor1" name="document_text" rows="10" cols="80">
                                                    This is my textarea to be replaced with CKEditor.
                                                </textarea>
                                            @endif
                                            <div class="col-sm-12  my-3">
                                                <label for="placeNdate" class="form-label text-bold">Place and
                                                    Date</label>
                                                <input type="text" class="form-control" id="placeNdate"
                                                    name="placeNdate" placeholder=""
                                                    @if (isset($function)) value="{{ $document->placeNdate }}" @endif>
                                                <div class="invalid-feedback">
                                                    Valid Place and Date is required.
                                                </div>
                                            </div>
                                        </div>
                                        <div id="navpills-2" class="tab-pane">
                                            <div class="fallback">
                                                <input type="file" class="form-control mt-10" id="naDoc"
                                                    name="document_upload[]" placeholder="Document" multiple>
                                                <div class="invalid-feedback">
                                                    Valid Document is required.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-lg-8 col-12">
                                        <div class="signature">
                                            <div class="text-center">
                                                <label class="form-label text-bold fs-16">TTD Pengirim</label>
                                            </div>
                                            <div class="form-group">
                                                <div class="signature mb-3">
                                                    <div class="text-right  d-flex justify-content-center">
                                                        <button type="button" class="btn btn-default btn-sm me-1"
                                                            id="undo-sender"><i class="fa fa-undo"></i>
                                                            Undo</button>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            id="clear-sender"><i class="fa fa-eraser"></i>
                                                            Clear</button>
                                                    </div>
                                                    <div class="wrapper mt-2">
                                                        <canvas id="signature-pad-sender"
                                                            class="signature-pad b-5 border-dark" style="width: 100%;"
                                                            height="250"></canvas>
                                                    </div>

                                                    <div class="form-control-feedback"><small>Pastikan
                                                            menekan tombol <code>Preview & Confirm</code>
                                                            sebelum mengisi form selanjutnya!</small></div>

                                                    <div class="button mt-2">
                                                        <button type="button" class="btn btn-info btn-sm"
                                                            id="save-sender"><i class="fas fa-check-circle"></i> Preview &
                                                            Confirm</button>
                                                    </div>
                                                    <!-- Modal untuk tampil preview tanda tangan-->
                                                    <div class="modal fade" id="modal-sender" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myModalLabel">
                                                                        Preview
                                                                        Tanda
                                                                        Tangan</h4>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
        @include('script.document.addApprover')
        @include('script.signature.senderSignature')
    </section>
@endsection
