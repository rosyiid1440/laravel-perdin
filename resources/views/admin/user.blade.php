@extends('template.adminlte.layouts.app')

@section('title', 'Master User')

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Master User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header text-right">
                            <button type="button" class="btn btn btn-outline-primary" data-toggle="modal"
                                data-target="#tambahModal" id="btnTambah">
                                + Tambah User
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Password</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->role->nama_role }}</td>
                                            <td>
                                                @if ($item->role->id != 1)
                                                    <form action="{{ url('admin/user/reset-password/' . $item->id) }}"
                                                        class="form" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-outline-warning"
                                                            onclick="return confirm('Apakah anda yakin ingin mereset password ini ?')">Reset
                                                            Password</button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->role->id != 1)
                                                    <button type="button" class="btn btn btn-outline-warning"
                                                        data-toggle="modal" data-target="#editModal" id="btnEdit"
                                                        data-val="{{ $item->id }}|{{ $item->username }}|{{ $item->name }}|{{ $item->email }}|{{ $item->role_id }}"><i
                                                            class="fas fa-edit"></i></button>
                                                    <form action="{{ url('admin/user/' . $item->id) }}"
                                                        class="d-inline form" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-outline-danger"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('admin/user') }}" class="form" method="post"
                                            id="form">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="" class="form-label is-invalid">Username</label>
                                                    <input type="text"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        name="username" />
                                                    @error('username')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Nama</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name">
                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Email</label>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email">
                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Password</label>
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password">
                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Konfirmasi Password</label>
                                                    <input type="password"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        name="password_confirmation">
                                                    @error('password_confirmation')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Role</label>
                                                    <select type="text"
                                                        class="form-control @error('role_id') is-invalid @enderror"
                                                        name="role_id">
                                                        <option value="">- Pilih -</option>
                                                        @foreach ($role as $item)
                                                            @if ($item->id != 1)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->nama_role }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('role_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="" class="form" method="post" id="formEdit">
                                            @csrf
                                            @method('patch')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="" class="form-label is-invalid">Username</label>
                                                    <input type="text"
                                                        class="form-control @error('edit_username') is-invalid @enderror"
                                                        name="edit_username" />
                                                    @error('edit_username')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Nama</label>
                                                    <input type="text"
                                                        class="form-control @error('edit_name') is-invalid @enderror"
                                                        name="edit_name">
                                                    @error('edit_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Email</label>
                                                    <input type="email"
                                                        class="form-control @error('edit_email') is-invalid @enderror"
                                                        name="edit_email" disabled>
                                                    @error('edit_email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Role</label>
                                                    <select type="text"
                                                        class="form-control @error('edit_role_id') is-invalid @enderror"
                                                        name="edit_role_id">
                                                        <option value="">- Pilih -</option>
                                                        @foreach ($role as $item)
                                                            @if ($item->id != 1)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->nama_role }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                    @error('edit_role_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#btnTambah').click(function() {
            $("#form")[0].reset();
            $("#tambahModalLabel").html("Tambah User");
        });

        $(document).on('click', '#btnEdit', function() {
            val = $(this).data('val').split("|");

            $("[name='edit_username']").val(val[1]);
            $("[name='edit_name']").val(val[2]);
            $("[name='edit_email']").val(val[3]);
            $("[name='edit_role_id']").val(val[4]);
            $('#formEdit').attr('action', "{{ url('admin/user') }}" + "/" + val[0]);

            console.log(val);
        })
    </script>
@endsection
