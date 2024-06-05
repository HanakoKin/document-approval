<div class="disposition">

    @if (auth()->user()->jabatan === 'ADMIN')
        <h5 class="text-decoration-underline">Create new Disposition</h5>
        <form action="{{ route('disposition', $document) }}" method="POST">
            @csrf

            <input type="hidden" name="doc_id" value="{{ $document->id }}">
            <input type="hidden" name="sender_id" value="{{ Auth::user()->id }}">
            <div class="form-group mt-3">
                <label for="receiver_id" class="form-label">Select disposition receiver</label>
                <select name="receiver_id" class="form-control select2" id="receiver_id">
                    <option value="" selected disabled>Select 1 Receiver</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->jabatan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6 form-group">
                <label for="disposisi" class="form-label">Input new disposition</label>
                <textarea class="form-control" name="disposisi" id="disposisi" rows="5"></textarea>
            </div>
            <button type="submit" class="d-absolute btn btn-primary"
                onclick="this.disabled = true; this.form.submit();">
                <i class="ti-save-alt"></i> Save
            </button>
        </form>
        <hr>
    @endif

    <h5>Disposition Table</h5>
    <div class="row">
        @foreach ($dispositions as $disposition)
            <div class="col-6 form-group">
                <p>Date :
                    {{ Carbon\Carbon::parse($disposition->updated_at)->setTimezone('Asia/Jakarta')->format('j F Y, g:i A') }}
                </p>
                <div class="card p-3">
                    <table>
                        <tr>
                            <td class="max-w-50">From </td>
                            <td>: {{ $disposition->sender->name }} </td>
                            <td>- {{ $disposition->sender->jabatan }}</td>
                        </tr>
                        <tr>
                            <td class="max-w-50">To </td>
                            <td>: {{ $disposition->receiver->name }} </td>
                            <td>- {{ $disposition->receiver->jabatan }}</td>
                        </tr>
                    </table>
                    <p class="">Message :</p>
                    <p class="ms-30">{{ $disposition->disposisi }}</p>

                    @foreach ($document->disposisi as $disposisi)
                        @if ($disposisi->id == $disposition->id)
                            @foreach ($disposisi->response as $response)
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <p>Reply from {{ $response->sender->name }}</p>
                                    <p>{{ Carbon\Carbon::parse($response->updated_at)->setTimezone('Asia/Jakarta')->format('j F Y, g:i A') }}
                                    </p>
                                </div>
                                <p>Message :
                                    {{ $response->response }}
                                </p>
                            @endforeach
                        @endif
                    @endforeach

                </div>
            </div>

            @if ($type === 'disposisi' && auth()->user()->jabatan !== 'ADMIN')
                <div class="col-6 form-group">
                    @if (auth()->user()->id === $disposition->receiver_id)
                        <div class="card p-3 mt-35">
                            <form action="{{ route('response', $disposition) }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="response" class="form-label block col-2">Response :</label>
                                    <div class="col-10">
                                        <textarea class="form-control" name="response" id="response" rows="2"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-2"
                                    onclick="this.disabled = true; this.form.submit();">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @endif
        @endforeach
        @if (auth()->user()->jabatan === 'ADMIN')
            <div class="mx-auto" style="width: fit-content;">
                <form action="{{ route('publish', $document) }}" method="post">
                    @csrf
                    <div class="form-group mt-10">
                        <button type="submit" class="btn btn-success submitBtn"
                            style="display: block; margin: 0 auto;">
                            <i class="fal fa-clipboard-check"></i> Publish
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    @include('script.confirmation.confirm-submit-btn')

</div>
