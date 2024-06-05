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

                        <div class="document-progress">
                            @if ($type === 'sent')
                                <h4 class="">The memo was sent to receivers at
                                    <span
                                        class="text-decoration-underline">{{ Carbon\Carbon::parse($memo->updated_at)->setTimezone('Asia/Jakarta')->format('j F Y, g:i A') }}</span>
                                </h4>
                            @else
                                <h4 class="">This memo was sent by {{ $memo->sender->name }}</h4>
                            @endif
                            <hr>
                        </div>


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
                                    <h3>{{ $memo->subject }}</h3>
                                    <h3>{{ $memo->no_doc }}</h3>
                                </div>
                                <div class="col-1 my-1">
                                    <p class="my-1">Kepada</p>
                                    <p class="my-1">Dari</p>
                                    <p class="my-1">Tembusan</p>
                                </div>
                                <div class="col-11 my-1">
                                    <p class="my-1">: {{ $memo->receiver[0]->name }}</p>
                                    <p class="my-1">: {{ $memo->sender->name }}</p>
                                    <p class="my-1">
                                        @foreach ($memo->tembusan as $index => $tembusan)
                                            @if ($index === 0)
                                                <li style="list-style-type:none">: - {{ $tembusan->name }}</li>
                                            @else
                                                <li style="list-style-type:none">&nbsp;&nbsp;- {{ $tembusan->name }}</li>
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                                <hr>
                                <p class="">
                                    {!! $memo->document_text !!}
                                    {{ $memo->placeNdate }}
                                </p>

                                <div class="image">
                                    <img src="{{ $memo->signature }}" alt=""width="200">
                                </div>
                                <p>{{ $memo->sender->name }}</p>
                                <p>{{ $memo->sender->unit }}</p>
                            </div>
                            @if (isset($memo->lampiran))
                                <p>LAMPIRAN</p>
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
