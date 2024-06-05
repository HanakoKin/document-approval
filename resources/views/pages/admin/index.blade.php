@extends('index')

@section('container')
    <section class="content pt-0">

        @if (session()->has('success'))
            @include('script.alert.success')
        @endif

        @if (session()->has('error'))
            @include('script.alert.error')
        @endif


        <div class="row">
            <div class="col-xl-12 col-12">

                <div class="d-inline-block align-items-center pb-2">
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Tabel User</li>
                        </ol>
                    </nav>
                </div>

                {{-- Tabel Content --}}
                <div class="box">
                    <div class="box-header py-4">
                        <h4 class="box-title">Jumlah User : {{ $totals }} </h4>
                        <div class="box-controls pull-right d-md-flex d-none">
                            <a href="{{ route('users.create') }}" class="btn btn-info btn-sm mb-2 text-decoration-none">
                                <i class="fal fa-plus-circle"></i> Add
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-hover display margin-top-10">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Picture</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="text-center">
                                            <td><img src="https://source.unsplash.com/50x50?people" alt="User Avatar"
                                                    class="img-fluid rounded-circle mb-3" style="width: 50px;"></td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->jabatan }}</td>
                                            <td>

                                                <a class="btn btn-success btn-sm me-2 mb-2 text-decoration-none"
                                                    data-bs-toggle="modal"
                                                    onclick="showUserModal({{ json_encode($user) }})">
                                                    <i class="fal fa-eye"></i> Lihat
                                                </a>

                                                <a class="btn btn-warning btn-sm me-2 mb-2 text-decoration-none"
                                                    href="{{ route('users.edit', $user->id) }}"><i class="fal fa-pen"></i>
                                                    Edit
                                                </a>

                                                <form id="deleteForm" action="{{ route('users.destroy', $user->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm me-2 mb-2 text-decoration-none deleteBtn"
                                                        data-target="user">
                                                        <i class="fal fa-trash-alt"></i> Delete
                                                    </button>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Show Data --}}
        @include('modal.admin.userShow')

        {{-- JS for Modal --}}
        @include('script.admin.userShow')

        {{-- JS for Delete --}}
        @include('script.confirmation.confirm-delete-btn')
        {{-- @include('script.confirmation.confirm-delete') --}}

    </section>
@endsection
