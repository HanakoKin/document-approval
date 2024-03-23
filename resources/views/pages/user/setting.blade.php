@extends('index')

@section('container')

<section class="content pt-0">

    @if(session()->has('success'))
    @include('script.success')
    @endif

    @if(session()->has('error'))
    @include('script.error')
    @endif

    <div class="row">
        <div class="col-xl-12 col-12">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-7 col-12">
                    <div class="box">
                        <div class="text-white box-body bg-img text-center pt-50 pb-20"
                            style="background-image: url(https://source.unsplash.com/600x400?flower);" data-overlay="5">
                            <a href="#">
                                <img class="avatar avatar-xxl rounded-circle bg-warning-light"
                                    src="https://source.unsplash.com/200x200?people" alt="">
                            </a>
                            <h5 class="my-2"><a class="text-white" href="#">{{ $user->nama }}</a></h5>
                            <span>{{ !$user->unit ? 'Admin' : $user->unit }}</span>
                        </div>
                        <ul class="flexbox flex-justified text-center p-20">
                            <li class="be-1 bs-1 border-light">
                                <span class="text-muted">Jumlah kasus</span><br>
                                <span class="fs-20">{{ $total }} kasus</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7 col-12">
                    <div class="box">
                        <form class="form" action="{{ route('changePassword') }}" method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            <div class="box-body">
                                <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Edit Data</h4>
                                <hr class="my-15">
                                <div class="row">
                                    <div class="col-md-12 col-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" id="name" name="nama"
                                                class="form-control" placeholder="" value="{{ $user->nama }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-6">
                                        <div class="form-group">
                                            <label for="current_password" class="form-label">Current Password</label>
                                            <input type="password" id="current_password" name="current_password"
                                                class="form-control" placeholder="Current Password">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-6">
                                        <div class="form-group">
                                            <label for="new_password" class="form-label">New Password</label>
                                            <input type="password" id="new_password" name="new_password"
                                                class="form-control" placeholder="New Password">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-6">
                                        <div class="form-group">
                                            <label for="confirm_password" class="form-label">Confirm Password</label>
                                            <input type="password" id="confirm_password" name="confirm_password"
                                                class="form-control" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
