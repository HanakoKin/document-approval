<div class="document-progress">
    <h4 class="">Document Progress</h4>
    <div class="mb-2">
        <div class="progress position-relative" style="height: 1.5rem">

            @foreach ($document->approvals as $index => $approver)
                @php
                    $progress = ($approver->approvers_queue / $calculation['total_approval']) * 100;
                    $width = 100 / ($calculation['total_approval'] + 1);
                @endphp

                @if ($index === 0)
                    <div class="progress-bar bg-primary rounded-0" role="progressbar" style="width: {{ $width }}%;"
                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        <span class="position-absolute start-0 ps-2">1.
                            {{ $document->sender->name }}</span>
                    </div>

                    <div class="progress-bar bg-{{ $calculation['percentage'] >= $progress ? 'primary' : 'secondary' }} rounded-0"
                        role="progressbar" style="width: {{ $width }}%;" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100">
                        <span class="position-absolute start-{{ $width }} ps-2">{{ $index + 2 }}.
                            {{ $document->approvals[$index]->approver->name }}</span>
                    </div>
                @else
                    <div class="progress-bar bg-{{ $calculation['percentage'] >= $progress ? 'primary' : 'secondary' }} rounded-0"
                        role="progressbar" style="width: {{ $width }}%;" aria-valuenow="0" aria-valuemin="0"
                        aria-valuemax="100">
                        <span class="position-absolute start-{{ $width }} ps-2">{{ $index + 2 }}.
                            {{ $document->approvals[$index]->approver->name }}</span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    {{-- @dump($document->disposition !== null) --}}

    @if ($document->status === 'Published')
        @if ($document->dispositions !== null)
            <h5 class="">The document has been <span class="fw-bold text-decoration-underline">Published</span> by
                ADMIN and sent to {{ $document->receiver->name }} at
                {{ Carbon\Carbon::parse($document->updated_at)->setTimezone('Asia/Jakarta')->format('j F Y, g:i A') }}
            </h5>
        @else
            <h5 class="">The document has been <span class="fw-bold text-decoration-underline">Sent</span> to
                {{ $document->receiver->name }} at
                {{ Carbon\Carbon::parse($document->updated_at)->setTimezone('Asia/Jakarta')->format('j F Y, g:i A') }}
            </h5>
        @endif
    @elseif ($document->status === 'Disposisi')
        @if (auth()->user()->jabatan !== 'ADMIN')
            <h5 class=""><span class="fw-bold text-decoration-underline">Disposition</span> is on process, please
                wait until ADMIN approve and publish, or contact "{{ $calculation['approver_name'] }}" for approval.
            </h5>
        @endif
    @elseif ($document->status === 'Approved')
        <h5 class="">The document has been <span class="fw-bold text-decoration-underline">Approved</span> by
            ADMIN, but need next approval before published.
        </h5>
    @elseif ($document->status === 'Pending')
        <h5 class="">Please contact "{{ $calculation['approver_name'] }}" for <span
                class="fw-bold text-decoration-underline">Approval</span>.
        </h5>
    @elseif ($document->status === 'Need Revision')
        <h5 class="">"{{ $calculation['repellent']->approver->name }}" want you to <span
                class="fw-bold text-decoration-underline">Revise</span> your document.
        </h5>

        @if ($notes->count() > 0)
            <p>Dengan catatan : </p>
            @for ($i = 0; $i < $notes->count(); $i++)
                <p class="ms-20">{{ $i + 1 }}. "{{ $notes[$i]->catatan }}" dari
                    {{ $document->approvals[$i]->approver->name }}</p>
            @endfor
        @endif
    @elseif ($document->status === 'Rejected')
        <h5 class="">This Document has been <span class="fw-bold text-decoration-underline">Rejected</span> by
            "{{ $calculation['repellent']->approver->name }}"
        </h5>
    @endif
    <hr>

</div>
