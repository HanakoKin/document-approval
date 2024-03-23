@extends('auth.main')

@section('container')

@if(session()->has('success'))
@include('script.success')
@endif

@if(session()->has('error'))
@include('script.error')
@endif

<div class="d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="container-sm">
        <div class="row d-flex justify-content-center bg-white rounded50 shadow-lg">
            <div class="col-12 col-md-10">
                <div class="content-top-agile p-20 pb-0">
                    <h2 class="text-primary">Get started with Us</h2>
                    <p class="mb-0">Register a new account</p>
                </div>
            </div>
            <div class="col-12 col-md-10">
                <div class="p-40">
                    <form action="/register" method="post">
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
                                <span class="input-group-text bg-transparent"><i class="fal fa-user-tie"></i></span>
                                <input type="text" name="nama" class="form-control ps-15 bg-transparent"
                                    placeholder="Full Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-transparent"><i class="fal fa-key"></i></span>
                                <input type="password" name="password" class="form-control ps-15 bg-transparent"
                                    placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group" id="roleSelector">
                            <div class="input-group mb-3">
                                <select class="form-control" name="role" required>
                                    <option selected disabled>Select one Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3 d-none" id="unitsChoice">
                                <select class="form-control select2" id="unit" name="unit" style="width: 100%">
                                    <option selected disabled>Pilih salah satu Unit</option>
                                    @foreach ($unit as $item)
                                    <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-info margin-top-10">SIGN UP</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center">
                        <p class="mt-15 mb-0">Already have an account?<a href="/login" class="text-danger ms-5"> Sign
                                In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('script.showUnit')

@endsection
