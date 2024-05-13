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
                            <li class="breadcrumb-item active" aria-current="page">Add Memo</li>
                        </ol>
                    </nav>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-12">
                        {{-- Form --}}
                        <form action="{{ route('addMemo') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Add new
                                            Memo
                                        </h4>
                                    </div>
                                </div>

                                <hr class="my-15">

                                {{-- SENDER --}}

                                <div class="col-sm-12 my-3">
                                    <label for="subject" class="form-label text-bold">Subject</label>
                                    <select class="form-control select2" id="subject" name="subject" required>
                                        <option selected disabled>Select one subject</option>
                                        <option value="MEMO INTERN">MEMO INTERN</option>
                                        <option value="SURAT TUGAS">SURAT TUGAS</option>
                                        <option value="PENGUMUMAN">PENGUMUMAN</option>
                                    </select>
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

                                <div class="col-sm-12 my-3">
                                    <label for="receiver" class="form-label text-bold">Receiver</label>
                                    <select class="form-control select2" id="receiver" name="receivers[]" multiple>
                                        {{-- <option selected disabled>Select one receiver</option> --}}
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-12 my-3">
                                    <label for="carbonCopy" class="form-label text-bold">CC</label>
                                    <select class="form-control select2" id="carbonCopy" name="carbonCopy[]" multiple>
                                        {{-- <option selected disabled>Select one or more for CC</option> --}}
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-12  my-3">
                                    <label for="description" class="form-label text-bold">Description</label>
                                    <input type="text" class="form-control" id="description" name="description"
                                        placeholder="" required>
                                    <div class="invalid-feedback">
                                        Valid Description is required.
                                    </div>
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
                                                    placeholder="">
                                                <div class="invalid-feedback">
                                                    Valid No Document is required.
                                                </div>
                                            </div>

                                            <div class="col-sm-12  my-3">
                                                <label for="editor1" class="form-label text-bold">Type your
                                                    document</label>
                                                <textarea id="editor1" name="document_text" rows="10" cols="80">This is my textarea to be replaced with CKEditor.</textarea>
                                            </div>

                                            <div class="col-sm-12  my-3">
                                                <label for="placeNdate" class="form-label text-bold">Place and
                                                    Date</label>
                                                <input type="text" class="form-control" id="placeNdate"
                                                    name="placeNdate" placeholder="">
                                                <div class="invalid-feedback">
                                                    Valid Place and Date is required.
                                                </div>
                                            </div>

                                            <div class="col-sm-12  my-3">
                                                <label for="editor2" class="form-label text-bold">Type your
                                                    lampiran</label>
                                                <textarea id="editor2" name="lampiran" rows="10" cols="80"></textarea>
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
