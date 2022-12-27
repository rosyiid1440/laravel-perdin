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
                        <div class="card-body">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="pengajuan-baru-tab" data-toggle="tab"
                                        href="#pengajuan-baru" role="tab" aria-controls="pengajuan-baru"
                                        aria-selected="true">Pengajuan Baru</a>
                                    <a class="nav-item nav-link" id="history-pengajuan-tab" data-toggle="tab"
                                        href="#history-pengajuan" role="tab" aria-controls="history-pengajuan"
                                        aria-selected="false">history
                                        Pengajuan</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="pengajuan-baru" role="tabpanel"
                                    aria-labelledby="pengajuan-baru-tab">
                                    <table class="table table-bordered mt-3">
                                        <thead class="thead-dark">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kota</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ $item->kotaasal->nama_kota }} <i
                                                            class="fas fa-long-arrow-alt-right"></i>
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
                                                            <button type="button" class="btn btn-outline-primary"
                                                                data-toggle="modal" data-target="#exampleModal"
                                                                id="show"
                                                                data-val="{{ $item->id }}|{{ $item->user->name }}|{{ $item->kotaasal->nama_kota }}|{{ $item->kotatujuan->nama_kota }}|{{ $tanggalawal->format('d F Y') }}|{{ $tanggalakhir->format('d F Y') }}|{{ $item->keterangan }}|{{ $sisa }}|{{ $item->jarak }}|{{ $item->nominal }}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="history-pengajuan" role="tabpanel"
                                    aria-labelledby="history-pengajuan-tab">
                                    <table class="table table-bordered mt-3">
                                        <thead class="thead-dark">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Kota</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($history as $key => $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->user->name }}</td>
                                                    <td>{{ $item->kotaasal->nama_kota }} <i
                                                            class="fas fa-long-arrow-alt-right"></i>
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
                                                            <button type="button" class="btn btn-outline-primary"
                                                                data-toggle="modal" data-target="#exampleModal">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
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
                                </div>
                            </div>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <h5 class="modal-title" id="exampleModalLabel">Approval Pengajuan Perdin</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="" class="form-label is-invalid">Nama</label>
                                                <input type="text" class="form-control" name="name" disabled
                                                    id="nama" />
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label is-invalid">Kota</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="kota_asal" disabled
                                                            id="kota_asal" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="kota_tujuan"
                                                            disabled id="kota_tujuan" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label">Tanggal</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control " name="tanggal_awal"
                                                            placeholder="Tanggal Awal" id="tanggal_awal" disabled
                                                            id="tanggal_awal">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" name="tanggal_akhir"
                                                            placeholder="Tanggal Akhir" id="tanggal_akhir" disabled
                                                            id="tanggal_akhir">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="form-label">Keterangan</label>
                                                <textArea type="text" class="form-control name="keterangan" disabled id="keterangan"></textArea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-10 mx-auto">
                                                    <div class="card">
                                                        <div class="card-body bg-light text-center">
                                                            <table class="table">
                                                                <thead>
                                                                    <th>Total Hari</th>
                                                                    <th>Jarak Tempuh</th>
                                                                    <th>Total Uang Perdin</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <h3 class="text-primary" id="totalHari"></h3>
                                                                        </td>
                                                                        <td>
                                                                            <h3 class="text-primary" id="totalJarak"></h3>
                                                                            <p id="nominal"></p>
                                                                        </td>
                                                                        <td>
                                                                            <h3 class="text-primary" id="totalNominal">
                                                                            </h3>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer mx-auto">
                                            <form action="{{ url('pegawai/pengajuan-perdin') }}" class="form"
                                                method="post" id="formRejected">
                                                @csrf
                                                @method('patch')
                                                <button type="submit" class="btn btn-danger">Reject</button>
                                            </form>
                                            <form action="{{ url('pegawai/pengajuan-perdin') }}" class="form"
                                                method="post" id="formApproved">
                                                @csrf
                                                @method('patch')
                                                <button type="submit" class="btn btn-primary">Approve</button>
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
    </div>
@endsection

@section('js')
    <script>
        function formatRupiah(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        $(document).on('click', '#show', function() {
            val = $(this).data('val').split("|");
            $("#nama").val(val[1]);
            $("#kota_asal").val(val[2]);
            $("#kota_tujuan").val(val[3]);
            $("#tanggal_awal").val(val[4]);
            $("#tanggal_akhir").val(val[5]);
            $("#keterangan").val(val[6]);
            $("#totalHari").html(val[7] + " Hari");
            $("#totalJarak").html(val[8] + " KM");
            $("#nominal").html(formatRupiah(val[9] * 1, 'Rp. ') + "- /Hari");
            $("#totalNominal").html(formatRupiah(val[9] * val[7], 'Rp. '));

            $('#formApproved').attr('action', "{{ url('sdm/pengajuan-perdin/approve') }}" + "/" + val[0]);
            $('#formRejected').attr('action', "{{ url('sdm/pengajuan-perdin/reject') }}" + "/" + val[0]);
        });
    </script>
@endsection
