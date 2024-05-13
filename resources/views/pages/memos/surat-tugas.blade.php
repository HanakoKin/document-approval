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
                            <li class="breadcrumb-item active" aria-current="page">Show Memo</li>
                        </ol>
                    </nav>
                </div>

                {{-- Tabel Content --}}
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box-body">

                        @if ($memo->path !== null)
                            @php
                                $paths = explode(' - ', $memo->path);
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
                            <div class="row">
                                <div class="text-center mb-30">
                                    <h3 class="fw-bold text-decoration-underline">{{ $memo->subject }}</h3>
                                    <h3>{{ $memo->no_doc }}</h3>
                                </div>
                                <p>Direksi RS Husada, dengan ini memberi tugas kepada : </p>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="fw-bold text-center">
                                            <td>No.</td>
                                            <td>Nama</td>
                                            <td>NIK</td>
                                            <td>Jabatan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($memo->receiver as $receiver)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="min-w-300">{{ $receiver->name }}</td>
                                                <td class="min-w-250">{{ $receiver->NIK }}</td>
                                                <td class="min-w-300">{{ $receiver->jabatan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <p class="">
                                    {!! $memo->document_text !!}
                                    {{ $memo->placeNdate }}
                                </p>

                                <div class="image">
                                    <img src="{{ $memo->signature }}" alt=""width="200">
                                </div>
                                <p>{{ $memo->sender->name }}</p>
                                <p>{{ $memo->sender->jabatan }}</p>

                                <div class="my-3">
                                    <p class="my-1">Tembusan : </p>
                                    <p class="my-1">
                                        @foreach ($memo->tembusan as $index => $tembusan)
                                            @if ($index === 0)
                                                <li style="list-style-type:none">&nbsp;- {{ $tembusan->name }}</li>
                                            @else
                                                <li style="list-style-type:none">&nbsp;- {{ $tembusan->name }}</li>
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                            </div>

                            @if (isset($memo->lampiran))
                                <hr>
                                <div class="row mb-20">
                                    {!! $memo->lampiran !!}
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
