@extends('template.adminlte.layouts.app')

@section('title', 'Pengajuan Perdin')

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Pengajuan Perdin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengajuan Perdin</li>
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
                                + Tambah Perdin
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <th>No</th>
                                    <th>Kota</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kotaasal->nama_kota }} <i class="fas fa-long-arrow-alt-right"></i>
                                                {{ $item->kotatujuan->nama_kota }}</td>
                                            <td>
                                                @php
                                                    $tanggalawal = \Carbon\Carbon::create($item->tanggal_awal);
                                                    $tanggalakhir = \Carbon\Carbon::create($item->tanggal_akhir);
                                                    $sisa = $tanggalawal->diffInDays($tanggalakhir) + 1;
                                                @endphp
                                                {{ $tanggalawal->format('d F') }} -
                                                {{ $tanggalakhir->format('d F, Y') }} <span
                                                    class="text-dark">({{ $sisa }}
                                                    Hari)</span>
                                            </td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>
                                                @if ($item->status == 'pending')
                                                    <span class="badge badge-warning">{{ $item->status }}</span>
                                                @elseif($item->status == 'approved')
                                                    <span class="badge badge-primary">{{ $item->status }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="tambahModal" aria-labelledby="tambahModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah Perdin</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('pegawai/pengajuan-perdin') }}" class="form" method="post"
                                            id="form">
                                            @csrf
                                            <div id="method"></div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="" class="form-label is-invalid">Kota</label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <select type="text"
                                                                class="form-control @error('kota_asal') is-invalid @enderror"
                                                                name="kota_asal">
                                                                <option value="">- Pilih Kota Asal -</option>
                                                                @foreach ($kota as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->nama_kota }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select type="text"
                                                                class="form-control @error('kota_tujuan') is-invalid @enderror"
                                                                name="kota_tujuan">
                                                                <option value="">- Pilih Kota Tujuan -</option>
                                                                @foreach ($kota as $val)
                                                                    <option value="{{ $val->id }}">
                                                                        {{ $val->nama_kota }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @error('kota_asal')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    @error('kota_tujuan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Tanggal</label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <input type="date"
                                                                class="form-control @error('tanggal_awal') is-invalid @enderror"
                                                                name="tanggal_awal" placeholder="Tanggal Awal"
                                                                id="tanggal_awal">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="date"
                                                                class="form-control @error('tanggal_akhir') is-invalid @enderror"
                                                                name="tanggal_akhir" placeholder="Tanggal Akhir"
                                                                id="tanggal_akhir">
                                                        </div>
                                                    </div>
                                                    @error('tanggal_awal')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    @error('tanggal_akhir')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Keterangan</label>
                                                    <textArea type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"></textArea>
                                                    @error('keterangan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5 mx-auto">
                                                        <div class="card">
                                                            <div class="card-body bg-light text-center">
                                                                <h3>Total Perjalanan Dinas</h3>
                                                                <h2 class="text-primary" id="totalHari">0 Hari</h2>
                                                            </div>
                                                        </div>
                                                    </div>
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
            $("#tambahModalLabel").html("Tambah Pengajuan Perdin");
            $('#totalHari').html("0 Hari");
        });

        $('#tanggal_awal').change(function() {
            var startDate = $(this).val();
            var endDate = $("#tanggal_akhir").val();

            const diffInMs = new Date(endDate) - new Date(startDate)
            const diffInDays = diffInMs / (1000 * 60 * 60 * 24);

            if (isNaN(diffInDays)) {

            } else {
                $('#totalHari').html(diffInDays + 1 + " Hari");
            }
        });
        $("#tanggal_akhir").change(function() {
            var startDate = $("#tanggal_awal").val();
            var endDate = $(this).val();

            const diffInMs = new Date(endDate) - new Date(startDate)
            const diffInDays = diffInMs / (1000 * 60 * 60 * 24);

            if (isNaN(diffInDays)) {

            } else {
                $('#totalHari').html(diffInDays + 1 + " Hari");
            }
        })
    </script>
@endsection
