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
                        <form action="{{ route('addDocument') }}" method="post" enctype="multipart/form-data">
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

                                {{-- SUBJECT --}}

                                <div class="col-sm-12  my-3">
                                    <label for="subject" class="form-label text-bold">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject"
                                        placeholder="Input subject" required>
                                    <div class="invalid-feedback">
                                        Valid Subject is required.
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
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div id="navpills-1" class="tab-pane active">
                                                <textarea id="editor1" name="document_text" rows="10" cols="80">
                                                                            This is my textarea to be replaced with CKEditor.
                                                    </textarea>
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
                                    <select class="form-control" id="receiver" name="receiver">
                                        <option selected disabled>Select one or more receiver</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-12 my-3">
                                    <div class="form-group" id="approvers">
                                        <label for="approvers">Approver:</label>
                                        <div id="approvers-container">
                                            <!-- Input akan ditambahkan secara dinamis menggunakan JavaScript -->
                                        </div>
                                    </div>
                                </div>

                                <span id="add-approver-btn" class="btn btn-primary btn-sm">Add Approver</span>

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
    </section>
@endsection
