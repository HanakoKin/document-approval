@extends('index')

@section('container')
    <section class="content pt-0">

        @if (session()->has('error'))
            @include('script.alert.error')
        @endif

        <div class="row">
            <div class="col-12">

                <div class="d-inline-block align-items-center pb-2">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('users') }}">Kelola User</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                        </ol>
                    </nav>
                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-8 col-12">
                        {{-- Form --}}
                        <form action="{{ route('updateUser', ['id' => $data->id]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">

                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Data User
                                        </h4>
                                    </div>
                                </div>

                                <hr class="my-15">

                                {{-- NAMA --}}
                                <div class="col-sm-12">
                                    <label for="naUser" class="form-label text-bold">Nama</label>
                                    <input type="text" class="form-control" id="naUser" name="name"
                                        placeholder="Name" required value="{{ $data->name }}">
                                    <div class="invalid-feedback">
                                        Valid Nama is required.
                                    </div>
                                </div>

                                <div class="col-sm-12 my-3">
                                    <label for="usUser" class="form-label text-bold">Username</label>
                                    <input type="text" class="form-control" id="usUser" name="username"
                                        placeholder="Username" required value="{{ $data->username }}" disabled>
                                    <div class="invalid-feedback">
                                        Valid Username is required.
                                    </div>
                                </div>

                                <div class="col-sm-12" id="unitsChoice">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <label for="unUser" class="form-label text-bold">Unit</label>
                                            <select class="form-control select2" id="unit" name="unit"
                                                style="width: 100%">
                                                <option selected disabled>Pilih salah satu Unit</option>
                                                @foreach ($unit as $item)
                                                    <option value="{{ $item->nama }}"
                                                        {{ $item->nama == $data->unit ? 'selected' : '' }}>
                                                        {{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="box-footer float-right">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- @include('script.showUnit')
    @include('script.editUser') --}}
@endsection
