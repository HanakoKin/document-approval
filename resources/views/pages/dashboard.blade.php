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
            <div class="col-xl-5 col-lg-6 col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Your Progress</h4>
                        <ul class="box-controls pull-right d-md-flex d-none">
                            <li>
                                <button class="btn btn-primary-light px-10">View All</button>
                            </li>
                        </ul>
                    </div>
                    <div class="box-body">
                        <div class="mb-25 pb-25 bb-1">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h5 class="mb-0">Computer Science</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="w-150 mx-20">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-primary" role="progressbar"
                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="mb-0">40%</h5>
                                </div>
                            </div>
                        </div>

                        <div class="mb-25 pb-25 bb-1">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h5 class="mb-0">Mathematics</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="w-150 mx-20">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-success" role="progressbar"
                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="mb-0">75%</h5>
                                </div>
                            </div>
                        </div>

                        <div class="mb-25 pb-25 bb-1">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h5 class="mb-0">Information Techno.</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="w-150 mx-20">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-success" role="progressbar"
                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="mb-0">95%</h5>
                                </div>
                            </div>
                        </div>
                        <div class="mb-25 pb-25 bb-1">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h5 class="mb-0">Data Science</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="w-150 mx-20">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-danger" role="progressbar"
                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 19%">
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="mb-0">19%</h5>
                                </div>
                            </div>
                        </div>
                        <div class="mb-10">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h5 class="mb-0">Business</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="w-150 mx-20">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-warning" role="progressbar"
                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 35%">
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="mb-0">35%</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Time Spent on Learning</h4>
                        <ul class="box-controls pull-right d-md-flex d-none">
                            <li class="dropdown">
                                <button class="dropdown-toggle btn btn-warning-light px-10" data-bs-toggle="dropdown"
                                    href="#" aria-expanded="false">Last week</button>
                                <div class="dropdown-menu dropdown-menu-right" style="">
                                    <a class="dropdown-item active" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Yesterday</a>
                                    <a class="dropdown-item" href="#">Monthly</a>
                                    <a class="dropdown-item" href="#">Last month</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="box-body">
                        <div id="charts_widget_1_chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="box pull-up">
                    <div class="box-body bg-img bg-primary-light">
                        <div class="d-lg-flex align-items-center justify-content-between">
                            <div class="d-lg-flex align-items-center mb-30 mb-xl-0 w-p100">
                                <img src="../images/svg-icon/color-svg/custom-14.svg" class="img-fluid max-w-250"
                                    alt="" />
                                <div class="ms-30">
                                    <h2 class="mb-10">Take Advance Courses to Achive Your Goal !</h2>
                                    <p class="mb-0 text-fade fs-18">It is a long established fact that a reader will be
                                        distracted <br>of a page when looking at its layout. </p>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="waves-effect waves-light w-p100 btn btn-primary btn-lg"
                                    style="white-space: nowrap;">Start Now!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Notice board</h4>
                    </div>
                    <div class="box-body p-0">
                        <div class="media-list media-list-hover">
                            <div class="media bar-0">
                                <span class="avatar avatar-lg bg-primary-light rounded"><i class="fa fa-user"></i></span>
                                <div class="media-body fw-500">
                                    <p class="d-flex align-items-center justify-content-between">
                                        <a class="hover-success" href="#"><strong>New Teacher</strong></a>
                                        <span class="text-fade fw-500 fs-12">Just Now</span>
                                    </p>
                                    <p class="text-fade">It is a long established fact that a reader will be<span
                                            class="d-xxxl-inline-block d-none"> distracted by the readable</span>...</p>
                                </div>
                            </div>

                            <div class="media bar-0">
                                <span class="avatar avatar-lg bg-danger-light rounded"><i class="fa fa-money"></i></span>
                                <div class="media-body">
                                    <p class="d-flex align-items-center justify-content-between">
                                        <a class="hover-success" href="#"><strong> New Fees Structure</strong></a>
                                        <span class="text-fade fw-500 fs-12">Today</span>
                                    </p>
                                    <p class="text-fade">It is a long established fact that a reader will be<span
                                            class="d-xxxl-inline-block d-none"> distracted by the readable</span>...</p>
                                </div>
                            </div>

                            <div class="media bar-0">
                                <span class="avatar avatar-lg bg-success-light rounded"><i class="fa fa-book"></i></span>
                                <div class="media-body">
                                    <p class="d-flex align-items-center justify-content-between">
                                        <a class="hover-success" href="#"><strong>Updated Syllabus</strong></a>
                                        <span class="text-fade fw-500 fs-12">17 Dec 2020</span>
                                    </p>
                                    <p class="text-fade">It is a long established fact that a reader will be<span
                                            class="d-xxxl-inline-block d-none"> distracted by the readable</span>...</p>
                                </div>
                            </div>

                            <div class="media bar-0">
                                <span class="avatar avatar-lg bg-info-light rounded"><i
                                        class="fa fa-graduation-cap"></i></span>
                                <div class="media-body">
                                    <p class="d-flex align-items-center justify-content-between">
                                        <a class="hover-success" href="#"><strong>New Course</strong></a>
                                        <span class="text-fade fw-500 fs-12">27 Oct 2020</span>
                                    </p>
                                    <p class="text-fade">It is a long established fact that a reader will be<span
                                            class="d-xxxl-inline-block d-none"> distracted by the readable</span>...</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="box-footer text-center p-10">
                        <a href="#" class="btn w-p100 btn-primary-light p-5">View all</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-12">
                <div class="box bg-transparent no-shadow mb-30">
                    <div class="box-header no-border pb-0">
                        <h4 class="box-title">Courses</h4>
                        <ul class="box-controls pull-right d-md-flex d-none">
                            <li>
                                <button class="btn btn-primary-light px-10">View All</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="box mb-15 pull-up">
                    <div class="box-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="me-15 bg-warning h-50 w-50 l-h-60 rounded text-center">
                                    <span class="icon-Book-open fs-24"><span class="path1"></span><span
                                            class="path2"></span></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="#" class="text-dark hover-primary mb-1 fs-16">Informatic Course</a>
                                    <span class="text-fade">Johen Doe, 19 April</span>
                                </div>
                            </div>
                            <a href="#">
                                <span class="icon-Arrow-right fs-24"><span class="path1"></span><span
                                        class="path2"></span></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box mb-15 pull-up">
                    <div class="box-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="me-15 bg-primary h-50 w-50 l-h-60 rounded text-center">
                                    <span class="icon-Mail fs-24"></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="#" class="text-dark hover-primary mb-1 fs-16">Live Drawing</a>
                                    <span class="text-fade">Micak Doe, 12 June</span>
                                </div>
                            </div>
                            <a href="#">
                                <span class="icon-Arrow-right fs-24"><span class="path1"></span><span
                                        class="path2"></span></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box mb-15 pull-up">
                    <div class="box-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="me-15 bg-danger h-50 w-50 l-h-60 rounded text-center">
                                    <span class="icon-Book-open fs-24"><span class="path1"></span><span
                                            class="path2"></span></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="#" class="text-dark hover-primary mb-1 fs-16">Contemporary Art</a>
                                    <span class="text-fade">Potar doe, 27 July</span>
                                </div>
                            </div>
                            <a href="#">
                                <span class="icon-Arrow-right fs-24"><span class="path1"></span><span
                                        class="path2"></span></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="box mb-15 pull-up">
                    <div class="box-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="me-15 bg-info h-50 w-50 l-h-60 rounded text-center">
                                    <span class="icon-Mail fs-24"></span>
                                </div>
                                <div class="d-flex flex-column fw-500">
                                    <a href="#" class="text-dark hover-info mb-1 fs-16">Live Drawing</a>
                                    <span class="text-fade">Micak Doe, 12 June</span>
                                </div>
                            </div>
                            <a href="#">
                                <span class="icon-Arrow-right fs-24"><span class="path1"></span><span
                                        class="path2"></span></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Upcoming Classes</h4>
                        <ul class="box-controls pull-right d-md-flex d-none">
                            <li>
                                <button class="btn btn-primary-light px-10">Scheduled</button>
                            </li>
                        </ul>
                    </div>
                    <div class="box-body p-0">
                        <div class="media-list media-list-hover">
                            <div class="media bar-0">
                                <a class="align-self-start" href="#"><img
                                        class="avatar avatar-lg bg-success-light rounded"
                                        src="../images/avatar/avatar-16.png" alt="..."></a>
                                <div class="media-body">
                                    <p class="mb-0">
                                        <a class="hover-success fs-16" href="#">Johen doe</a>
                                        <span class="float-end text-fade">Class ID: <span
                                                class="fw-500">C125</span></span>
                                    </p>
                                    <h6 class="text-fade my-10">12 Dec &#8226; 2020 9:00 AM</h6>
                                    <h6>Requested for : <span class="text-success">2 Subjects</span></h6>
                                </div>
                            </div>

                            <div class="media bar-0">
                                <a class="align-self-start" href="#"><img
                                        class="avatar avatar-lg bg-success-light rounded"
                                        src="../images/avatar/avatar-15.png" alt="..."></a>
                                <div class="media-body">
                                    <p class="mb-0">
                                        <a class="hover-success fs-16" href="#">Molly doe</a>
                                        <span class="float-end text-fade">Class ID: <span
                                                class="fw-500">C225</span></span>
                                    </p>
                                    <h6 class="text-fade my-10">18 Dec &#8226; 2020 9:00 AM</h6>
                                    <h6>Requested for : <span class="text-success">4 Subjects</span></h6>
                                </div>
                            </div>

                            <div class="media bar-0">
                                <a class="align-self-start" href="#"><img
                                        class="avatar avatar-lg bg-success-light rounded"
                                        src="../images/avatar/avatar-13.png" alt="..."></a>
                                <div class="media-body">
                                    <p class="mb-0">
                                        <a class="hover-success fs-16" href="#">Akon doe</a>
                                        <span class="float-end text-fade">Class ID: <span
                                                class="fw-500">C345</span></span>
                                    </p>
                                    <h6 class="text-fade my-10">22 Dec &#8226; 2020 9:00 AM</h6>
                                    <h6>Requested for : <span class="text-success">1 Subjects</span></h6>
                                </div>
                            </div>

                            <div class="media bar-0">
                                <a class="align-self-start" href="#"><img
                                        class="avatar avatar-lg bg-success-light rounded"
                                        src="../images/avatar/avatar-12.png" alt="..."></a>
                                <div class="media-body">
                                    <p class="mb-0">
                                        <a class="hover-success fs-16" href="#">Maical doe</a>
                                        <span class="float-end text-fade">Class ID: <span
                                                class="fw-500">C185</span></span>
                                    </p>
                                    <h6 class="text-fade mt-10 mb-15">23 Dec &#8226; 2020 9:00 AM</h6>
                                    <h6>Requested for : <span class="text-success">3 Subjects</span></h6>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row fx-element-overlay">
            <div class="col-12">
                <div class="box no-shadow mb-0 bg-transparent">
                    <div class="box-header no-border px-0">
                        <h4 class="box-title">My Courses</h4>
                        <ul class="box-controls pull-right d-md-flex d-none">
                            <li>
                                <button class="btn btn-primary-light px-10">View All</button>
                            </li>
                            <li class="dropdown">
                                <button class="dropdown-toggle btn btn-primary-light px-10" data-bs-toggle="dropdown"
                                    href="#" aria-expanded="false">Most Popular</button>
                                <div class="dropdown-menu dropdown-menu-right" style="">
                                    <a class="dropdown-item active" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Yesterday</a>
                                    <a class="dropdown-item" href="#">Last week</a>
                                    <a class="dropdown-item" href="#">Last month</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="box">
                    <div class="fx-card-item">
                        <div class="fx-card-avatar fx-overlay-1"> <img src="../images/front-end-img/courses/4.jpg"
                                alt="user" class="bbrr-0 bblr-0">
                            <div class="fx-overlay">
                                <ul class="fx-info">
                                    <li><a class="btn btn-danger no-border" href="javascript:void(0);">View More</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="fx-card-content">
                            <h4 class="box-title mb-0">Manegement</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="box">
                    <div class="fx-card-item">
                        <div class="fx-card-avatar fx-overlay-1"> <img src="../images/front-end-img/courses/9.jpg"
                                alt="user" class="bbrr-0 bblr-0">
                            <div class="fx-overlay">
                                <ul class="fx-info">
                                    <li><a class="btn btn-danger no-border" href="javascript:void(0);">View More</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="fx-card-content">
                            <h4 class="box-title mb-0">Networking</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="box">
                    <div class="fx-card-item">
                        <div class="fx-card-avatar fx-overlay-1"> <img src="../images/front-end-img/courses/8.jpg"
                                alt="user" class="bbrr-0 bblr-0">
                            <div class="fx-overlay">
                                <ul class="fx-info">
                                    <li><a class="btn btn-danger no-border" href="javascript:void(0);">View More</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="fx-card-content">
                            <h4 class="box-title mb-0">Security</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="box">
                    <div class="fx-card-item">
                        <div class="fx-card-avatar fx-overlay-1"> <img src="../images/front-end-img/courses/2.jpg"
                                alt="user" class="bbrr-0 bblr-0">
                            <div class="fx-overlay">
                                <ul class="fx-info">
                                    <li><a class="btn btn-danger no-border" href="javascript:void(0);">View More</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="fx-card-content">
                            <h4 class="box-title mb-0">Language</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- @include('script.pie-chart') --}}

    {{-- @include('script.bar-chartJs') --}}

    {{-- @include('script.greeting') --}}
@endsection
