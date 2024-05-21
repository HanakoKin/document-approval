@extends('auth.main')

@section('container')
    @if (session()->has('success'))
        @include('script.alert.success')
    @endif

    @if (session()->has('error'))
        @include('script.alert.error')
    @endif


    <div class="d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="container-sm">
            <div class="row justify-content-center bg-white rounded50 shadow-lg">
                <div class="col-12 col-md-10">
                    <div class="content-top-agile p-3 p-md-20 pb-0">
                        <h2 class="text-primary text-center">Let's Get Started</h2>
                        <p class="mb-0 text-center">Sign in to continue to Document Approval HUSADA.</p>
                    </div>
                </div>
                <div class="col-12 col-md-10">
                    <div class="p-3 p-md-40">
                        <form action="{{ route('authenticate') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-transparent"><i class="fal fa-user"></i></span>
                                    <input type="text" name="username" class="form-control ps-15 bg-transparent"
                                        placeholder="Username" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-transparent"><i class="fal fa-key"></i></span>
                                    <input type="password" name="password" class="form-control ps-15 bg-transparent"
                                        placeholder="Password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-danger mt-3 mt-md-10">SIGN IN</button>
                                </div>
                            </div>
                        </form>
                        <div class="text-center">
                            <p class="mt-15 mb-0">Don't have an account? <a href="/register"
                                    class="text-warning ms-0 ms-md-5">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
