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

                {{-- Tabel Content --}}
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box-body">

                        @if ($document->path !== null)
                            @php
                                $paths = explode(' - ', $document->path);
                            @endphp

                            @foreach ($paths as $path)
                                @if (Str::endsWith($path, ['.jpg', '.jpeg', '.png', '.gif', '.bmp']))
                                    <!-- Jika file adalah gambar -->
                                    <img src="{{ Storage::url($path) }}" alt="Document Image">
                                @elseif(Str::endsWith($path, ['.pdf']))
                                    <!-- Jika file adalah PDF -->

                                    <embed src="{{ asset(Storage::url($path)) }}" type="application/pdf" width="100%"
                                        height="600px">
                                @else
                                    <!-- Jika file adalah dokumen atau format lainnya -->
                                    <a href="{{ Storage::url($path) }}" target="_blank">View Document</a>
                                @endif
                            @endforeach
                        @else
                            <div class="output_document">
                                <p>
                                    No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $document->no_doc }}
                                    <br>
                                    Lamp&nbsp;&nbsp;&nbsp;: {{ $document->description }}
                                    <br>
                                    Hal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $document->subject }}
                                    <br>
                                </p>
                                <p>
                                    Kepada Yth
                                    <br>
                                    {{ $document->receiver->unit }}
                                    <br>
                                    {{ $document->receiver->name }}
                                    <br>
                                    Di tempat
                                </p>
                                <p class="">
                                    {!! $document->document_text !!}
                                    {{ $document->placeNdate }}
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center">
                                        <tbody>
                                            <tr>
                                                <td class="min-w-200 pb-0"><img src="{{ $signature[0] }}" alt=""
                                                        width="200"></td>
                                                @for ($i = 0; $i < $approval; $i++)
                                                    <td class="min-w-200 pb-0">
                                                        @if (isset($signature[$i + 1]))
                                                            <img src="{{ $signature[$i + 1] }}" alt=""
                                                                width="200">
                                                        @endif
                                                    </td>
                                                @endfor
                                            </tr>
                                            <tr>
                                                <td class="py-0 text-decoration-underline">{{ $document->sender->name }}
                                                </td>
                                                @for ($i = 0; $i < $approval; $i++)
                                                    <td class="py-0 text-decoration-underline">
                                                        {{ $document->approvals[$i]->approver->name }}
                                                    </td>
                                                @endfor
                                            </tr>
                                            <tr>
                                                <td class="pt-0">{{ $document->sender->unit }}</td>
                                                @for ($i = 0; $i < $approval; $i++)
                                                    <td class="pt-0">
                                                        {{ $document->approvals[$i]->approver->unit }}
                                                    </td>
                                                @endfor
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                {{-- <div class="row d-flex justify-content-between">
                                    <div class="col-3">
                                        <img src="{{ $signature[0] }}" alt="" width="200">
                                        <p>{{ $document->sender->name }}</p>
                                        <p>{{ $document->sender->unit }}</p>
                                    </div>
                                    @for ($i = 0; $i < $approval; $i++)
                                        <div class="col-3">
                                            @if (isset($signature[$i + 1]))
                                                <img src="{{ $signature[$i + 1] }}" alt="" width="200">
                                            @endif
                                            <p>{{ $document->approvals[$i]->approver->name }}</p>
                                            <p>{{ $document->approvals[$i]->approver->unit }}</p>
                                        </div>
                                    @endfor
                                </div> --}}
                            </div>
                        @endif

                        <br>
                        <hr>
                        <br>

                        @if ($type === 'approval' && $document->approval_required)
                            <!-- Jika persetujuan diperlukan -->

                            <form action="{{ route('approve.document', $document->id) }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ Auth::user()->id }}" name="id">
                                <label for="approval_status">Berikan feedback terhadap dokumen di atas</label>
                                <div class="form-group mt-3">
                                    <select name="approval_status" class="form-control" id="approval_status">
                                        <option selected disabled>Pilih salah satu</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Need Revision">Need Revision</option>
                                        <option value="Rejected">Rejected</option>
                                    </select>
                                </div>

                                <div id="signature_pad" class="row justify-content-center d-none">

                                    @for ($i = 0; $i < $approval; $i++)
                                        @if (Auth::user()->unit === 'ADMIN' || Auth::user()->id == $document->approvals[$i]->approver_id)
                                            <div class="col-lg-4 col-12">
                                                <div class="form-group">
                                                    <label for="nama_{{ $i }}" class="form-label">Nama
                                                        Penyetuju
                                                        {{ $i + 1 }}</label>
                                                    <input type="text" id="nama_{{ $i }}"
                                                        class="form-control" name=""
                                                        value="{{ $document->approvals[$i]->approver->name }}" readonly>
                                                </div>
                                                <div class="signature">
                                                    <div class="text-center">
                                                        <label class="form-label text-bold fs-16">TTD Penyetuju
                                                            {{ $i + 1 }}</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="signature mb-3">
                                                            <div class="text-right  d-flex justify-content-center">
                                                                <button type="button" class="btn btn-default btn-sm me-1"
                                                                    id="undo-{{ $i }}"><i
                                                                        class="fa fa-undo"></i>
                                                                    Undo</button>
                                                                <button type="button" class="btn btn-danger btn-sm"
                                                                    id="clear-{{ $i }}"><i
                                                                        class="fa fa-eraser"></i>
                                                                    Clear</button>
                                                            </div>
                                                            <div class="wrapper mt-2">
                                                                <canvas id="signature-pad-{{ $i }}"
                                                                    class="signature-pad b-5 border-dark"
                                                                    style="width: 100%;" height="250"></canvas>
                                                            </div>

                                                            <div class="form-control-feedback"><small>Pastikan
                                                                    menekan tombol <code>Preview & Confirm</code>
                                                                    sebelum mengisi form selanjutnya!</small></div>

                                                            <div class="button mt-2">
                                                                <button type="button" class="btn btn-info btn-sm"
                                                                    id="save-{{ $i }}"><i
                                                                        class="fas fa-check-circle"></i> Preview &
                                                                    Confirm</button>
                                                            </div>
                                                            <!-- Modal untuk tampil preview tanda tangan-->
                                                            <div class="modal fade" id="modal-{{ $i }}"
                                                                tabindex="-1" role="dialog"
                                                                aria-labelledby="myModalLabel">
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
                                        @endif
                                    @endfor
                                </div>


                                <div class="col-md-6 col-12 my-3">
                                    <label for="catatan" class="form-label">Berikan catatan (apabila
                                        diperlukan)</label>
                                    <textarea class="form-control" name="catatan" id="catatan" cols="10" rows="10"></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="ti-save-alt"></i> Save
                                </button>

                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @include('script.signature.addSignature')

    </section>
@endsection
