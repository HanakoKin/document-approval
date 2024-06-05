@if ($document->path !== null)
    @php
        $paths = explode(' - ', $document->path);
    @endphp

    @foreach ($paths as $path)
        @if (Str::endsWith($path, ['.jpg', '.jpeg', '.png', '.gif', '.bmp']))
            <img src="{{ Storage::url($path) }}" alt="Document Image">
        @elseif(Str::endsWith($path, ['.pdf']))
            <embed src="{{ asset(Storage::url($path)) }}" type="application/pdf" width="100%" height="600px">
        @else
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
                        <td class="min-w-200 pb-0"><img src="{{ $signature[0] }}" alt="" width="200"></td>
                        @for ($i = 0; $i < $approval; $i++)
                            <td class="min-w-200 pb-0">
                                @if (isset($signature[$i + 1]))
                                    <img src="{{ $signature[$i + 1] }}" alt="" width="200">
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
    </div>
@endif
