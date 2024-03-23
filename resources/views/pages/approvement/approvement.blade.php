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
                    <div class="box-header py-4">
                        <h4 class="box-title">Jumlah Approvement : </h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if (Str::endsWith($document->path, ['.jpg', '.jpeg', '.png', '.gif', '.bmp']))
                            <!-- Jika file adalah gambar -->
                            <img src="{{ Storage::url($document->path) }}" alt="Document Image">
                        @elseif(Str::endsWith($document->path, ['.pdf']))
                            <!-- Jika file adalah PDF -->
                            <embed src="{{ asset(Storage::url($document->path)) }}" type="application/pdf" width="100%"
                                height="600px">
                        @else
                            <!-- Jika file adalah dokumen atau format lainnya -->
                            <a href="{{ Storage::url($document->path) }}" target="_blank">View Document</a>
                        @endif

                        @if ($type === 'approval')
                            @if ($document->approval_required)
                                <!-- Jika persetujuan diperlukan -->
                                <form action="{{ route('approve.document', $document->id) }}" method="POST">
                                    @csrf
                                    <div class="box-body">
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="id">
                                        <label for="approval_status">Berikan status ke dokumen di atas</label>
                                        <div class="form-group mt-3">
                                            <select name="approval_status" class="form-control" id="approval_status">
                                                <option selected disabled>Pilih salah satu</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Need Revision">Need Revision</option>
                                                <option value="Rejected">Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="box-footer float-right">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="ti-save-alt"></i> Save
                                        </button>
                                    </div>

                                </form>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
