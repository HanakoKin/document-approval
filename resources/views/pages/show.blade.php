@extends('index')

@section('container')
    <section class="content">

        @if (session()->has('success'))
            @include('script.alert.success')
        @endif

        @if (session()->has('error'))
            @include('script.alert.error')
        @endif

        <div class="row">
            <div id="firstDiv" class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">{{ $boxTitle }}</h4>
                        <div class="box-controls pull-right">
                            <div class="box-header-actions">
                                <div class="lookup lookup-sm lookup-right d-none d-lg-block">
                                    <input type="text" name="s" placeholder="Search">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body vh-100">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                            <button type="button" class="btn btn-primary btn-sm checkbox-toggle"><i
                                    class="ion ion-android-checkbox-outline-blank"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm"><i
                                        class="fa-regular fa-trash"></i></button>
                                @if ($boxTitle != 'Approvement')
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-duotone fa-filters"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#"
                                                onclick="filterData('memos', '{{ $category }}')">Memo</a>
                                            <a class="dropdown-item" href="#"
                                                onclick="filterData('documents', '{{ $category }}')">Document</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" id="refreshButton" class="btn btn-primary btn-sm"><i
                                    class="fa-duotone fa-arrows-rotate"></i></button>
                        </div>
                        <div class="mailbox-messages inbox-bx">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tbody id="tableBody">
                                        @foreach ($result as $data)
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fa fa-star text-yellow"></i></a></td>
                                                <td>
                                                    <a href="{{ $data->source === 'memos' ? route('showMemo', ['type' => $category, 'id' => $data->id]) : route('showDocument', ['type' => $category, 'id' => $data->id]) }}"
                                                        class="mailbox-name mb-0 fs-16 fw-600">{{ $data->subject }}</a>
                                                    <p class="mailbox-subject mb-0">
                                                        {{ $data->sender->name }}
                                                    </p>
                                                    {{-- @dump($data->id, $data->source) --}}
                                                    <span
                                                        onclick="showPreview('{{ $data->id }}', '{{ $data->source }}')"
                                                        class="d-inline-block text-truncate max-w-800 m-0 spanTruncate">
                                                        {{ $data->description }}
                                                    </span>
                                                </td>
                                                <td class="mailbox-attachment">
                                                    @if ($data->path)
                                                        <i class="fa fa-paperclip"></i>
                                                    @endif
                                                </td>

                                                <td class="mailbox-date">
                                                    {{ Carbon\Carbon::parse($data->newest_time)->setTimezone('Asia/Jakarta')->format('j F Y, g:i A') }}
                                                </td>
                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td class="mailbox-star"><a href="#"><i
                                                        class="fa fa-star-o text-yellow"></i></a></td>
                                            <td>
                                                <p class="mailbox-name mb-0 fs-16 fw-600">Johen Doe</p>
                                                <a class="mailbox-subject" href="#"><b>Lorem Ipsum</b> - There are
                                                    many variations of Ipsum available...</a>
                                            </td>
                                            <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                                            <td class="mailbox-date">2:45 PM</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
            <div id="secondaryDiv" class="col-xl-5 col-12 d-none">
                <div class="box">
                    <div class="box-body pt-10">
                        <div class="mailbox-read-info">
                            <h4>Document Preview</h4>
                        </div>
                        <div class="mailbox-read-info clearfix mb-20">
                            <h5 id="senderInfo" class="no-margin">
                            </h5>
                        </div>
                        <!-- /.mailbox-read-info -->
                        <div class="mailbox-controls with-border clearfix">
                            <div class="float-start">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
                                    title="Print">
                                    <i class="fa fa-print"></i></button>
                            </div>
                            <div class="float-end">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
                                        data-container="body" title="Delete">
                                        <i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
                                        data-container="body" title="Reply">
                                        <i class="fa fa-reply"></i></button>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
                                        data-container="body" title="Forward">
                                        <i class="fa fa-share"></i></button>
                                </div>
                            </div>

                        </div>
                        <div id="messageContent" class="mailbox-read-message read-mail-bx">

                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="pull-right">
                            <button type="button" class="btn btn-success"><i class="fa fa-reply"></i> Reply</button>
                            <button type="button" class="btn btn-info"><i class="fa fa-share"></i> Forward</button>
                        </div>
                        <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                        <button type="button" class="btn btn-warning"><i class="fa fa-print"></i></button>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>

        @include('script.document.preview')

    </section>
@endsection
