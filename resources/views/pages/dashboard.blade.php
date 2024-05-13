@extends('index')

@section('container')
    <section class="content">

        @if (session()->has('success'))
            @include('script.success')
        @endif

        @if (session()->has('error'))
            @include('script.error')
        @endif

        <div class="row">
            <div class="col-xl-2 col-lg-4 col-12">
                <button class="btn btn-danger w-p100 mb-30" type="button" alt="default" data-bs-toggle="modal"
                    data-bs-target=".bs-example-modal-lg">Compose</button>

                {{-- @include('modal.documents.compose') --}}

                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Folders</h4>
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-slide" href="#"></a></li>
                        </ul>
                    </div>
                    <div class="box-body no-padding mailbox-nav">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item"><a class="nav-link active" href="javascript:void(0)"><i
                                        class="ion ion-ios-email-outline"></i> Inbox
                                    <span class="label label-success pull-right">12</span></a></li>
                            <li class="nav-item"><a class="nav-link" href="javascript:void(0)"><i
                                        class="ion ion-paper-airplane"></i> Sent</a></li>
                            <li class="nav-item"><a class="nav-link" href="javascript:void(0)"><i
                                        class="ion ion-email-unread"></i> Drafts</a></li>
                            <li class="nav-item"><a class="nav-link" href="javascript:void(0)"><i class="ion ion-star"></i>
                                    Starred</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="javascript:void(0)"><i
                                        class="ion ion-trash-a"></i> Trash</a></li>
                        </ul>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Labels</h4>
                        <ul class="box-controls pull-right">
                            <li><a class="box-btn-slide" href="#"></a></li>
                        </ul>
                    </div>
                    <div class="box-body no-padding mailbox-nav">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item"><a class="nav-link" href="#"><i
                                        class="fa fa-circle-o text-danger"></i> Important</a></li>
                            <li class="nav-item"><a class="nav-link" href="#"><i
                                        class="fa fa-circle-o text-warning"></i> Promotions</a></li>
                            <li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-circle-o text-info"></i>
                                    Social</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-xl-6 col-lg-8 col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Inbox</h4>
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
                                        class="ion ion-trash-a"></i></button>
                                <button type="button" class="btn btn-primary btn-sm"><i class="ion ion-reply"></i></button>
                                <button type="button" class="btn btn-primary btn-sm"><i class="ion ion-share"></i></button>
                            </div>
                            <!-- /.btn-group -->
                            <div class="btn-group">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ion ion-flag margin-r-5"></i>
                                        <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ion ion-folder margin-r-5"></i>
                                        <span class="caret"></span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.btn-group -->
                            <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></button>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm"><i
                                            class="fa fa-chevron-left"></i></button>
                                    <button type="button" class="btn btn-primary btn-sm"><i
                                            class="fa fa-chevron-right"></i></button>
                                </div>
                                <!-- /.btn-group -->
                            </div>
                            <!-- /.pull-right -->
                        </div>
                        <div class="mailbox-messages inbox-bx">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tbody>
                                        @foreach ($result as $data)
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td class="mailbox-star"><a href="#"><i
                                                            class="fa fa-star text-yellow"></i></a></td>
                                                <td>
                                                    <a href="{{ $data->source === 'memos' ? route('showMemo', ['type' => 'receive', 'id' => $data->id]) : route('showDocument', ['type' => 'receive', 'id' => $data->id]) }}"
                                                        class="mailbox-name mb-0 fs-16 fw-600">{{ $data->subject }}</a>
                                                    <p class="mailbox-subject mb-0">
                                                        {{ $data->sender->name }}
                                                    </p>
                                                    <span class="d-inline-block text-truncate max-w-300 m-0">
                                                        {!! $data->document_text !!}
                                                    </span>
                                                </td>
                                                <td class="mailbox-attachment"></td>
                                                <td class="mailbox-date">
                                                    {{ Carbon\Carbon::parse($data->newest_time)->setTimezone('Asia/Jakarta')->format('h:i A') }}
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
            <div class="col-xl-4 col-12">
                <div class="box">
                    <div class="box-body pt-10">
                        <div class="mailbox-read-info">
                            <h4>Your message title goes here</h4>
                        </div>
                        <div class="mailbox-read-info clearfix mb-20">
                            <div class="float-start me-10"><a href="#"><img src="../images/1.jpg" alt="user"
                                        width="40" class="rounded-circle"></a></div>
                            <h5 class="no-margin"> Pavan kumar<br>
                                <small>From: jonathan@domain.com</small>
                                <span class="mailbox-read-time pull-right">22 JUL. 2019 08:03 PM</span>
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
                            <!-- /.btn-group -->

                        </div>
                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message read-mail-bx">
                            <p>Dear USer,</p>

                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                                Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                                ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla
                                consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                                arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu
                                pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>

                            <p>enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                                dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                                laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                                ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                                condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                                quam nunc, blandit vel, luctus pulvinar.</p>

                            <p>Thanks,<br>Jane</p>
                        </div>
                        <!-- /.mailbox-read-message -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <h5><i class="fa fa-paperclip m-r-10 m-b-10"></i> Attachments <span>(3)</span></h5>
                        <ul class="mailbox-attachments clearfix">
                            <li>
                                <div class="mailbox-attachment-info">
                                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                        Mag.pdf</a>
                                    <span class="mailbox-attachment-size">
                                        5,215 KB
                                        <a href="#" class="btn btn-primary btn-xs pull-right"><i
                                                class="fa fa-cloud-download"></i></a>
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div class="mailbox-attachment-info">
                                    <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                        Documents.docx</a>
                                    <span class="mailbox-attachment-size">
                                        2,145 KB
                                        <a href="#" class="btn btn-primary btn-xs pull-right"><i
                                                class="fa fa-cloud-download"></i></a>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-footer -->
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
    </section>

    {{-- @include('script.pie-chart') --}}

    {{-- @include('script.bar-chartJs') --}}

    {{-- @include('script.greeting') --}}
@endsection
