@extends('template.adminlte.layouts.app')

@section('title', 'Master Kota')

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Master Kota</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Master Kota</li>
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
                                + Tambah Kota
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <th>No</th>
                                    <th>Nama Kota</th>
                                    <th>Provinsi</th>
                                    <th>Pulau</th>
                                    <th>Luar Negeri</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_kota }}</td>
                                            <td>{{ $item->provinsi }}</td>
                                            <td>{{ $item->pulau }}</td>
                                            <td>{{ $item->luar_negeri }}</td>
                                            <td>{{ $item->latitude }}</td>
                                            <td>{{ $item->longitude }}</td>
                                            <td>
                                                <button type="button" class="btn btn btn-outline-warning"
                                                    data-toggle="modal" data-target="#tambahModal" id="btnEdit"
                                                    data-val="{{ $item->id }}|{{ $item->nama_kota }}|{{ $item->provinsi }}|{{ $item->pulau }}|{{ $item->luar_negeri }}|{{ $item->latitude }}|{{ $item->longitude }}"><i
                                                        class="fas fa-edit"></i></button>
                                                <form action="{{ url('admin/master-kota/' . $item->id) }}"
                                                    class="d-inline form" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="tambahModal" aria-labelledby="tambahModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tambahModalLabel">Tambah Kota</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ url('admin/master-kota') }}" class="form" method="post"
                                            id="form">
                                            @csrf
                                            <div id="method"></div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="" class="form-label is-invalid">Nama Kota</label>
                                                    <input type="text"
                                                        class="form-control @error('nama_kota') is-invalid @enderror"
                                                        name="nama_kota" />
                                                    @error('nama_kota')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Provinsi</label>
                                                    <input type="text"
                                                        class="form-control @error('provinsi') is-invalid @enderror"
                                                        name="provinsi">
                                                    @error('provinsi')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Pulau</label>
                                                    <input type="text"
                                                        class="form-control @error('pulau') is-invalid @enderror"
                                                        name="pulau">
                                                    @error('pulau')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="form-label">Luar negeri</label>
                                                    <select type="text"
                                                        class="form-control @error('luar_negeri') is-invalid @enderror"
                                                        name="luar_negeri">
                                                        <option value="">- Pilih -</option>
                                                        <option value="Ya">Ya</option>
                                                        <option value="Tidak">Tidak</option>
                                                    </select>
                                                    @error('luar_negeri')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">Latitude</label>
                                                            <input type="text"
                                                                class="form-control @error('latitude') is-invalid @enderror"
                                                                name="latitude">
                                                            @error('latitude')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">Longitude</label>
                                                            <input type="text"
                                                                class="form-control @error('longitude') is-invalid @enderror"
                                                                name="longitude">
                                                            @error('longitude')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="lokasi_koordinat_proyek">Lokasi
                                                                Koordinat</label>
                                                            <div id="map" style="height: 300px; width:100%;"></div>
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
        var lokasi;
        var map = L.map('map').setView([51.5021160, -0.1738929], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy;'
        }).addTo(map);

        L.control.search({
                url: 'https://nominatim.openstreetmap.org/search?format=json&q={s}',
                propertyName: 'display_name',
                jsonpParam: 'json_callback',
                propertyLoc: ['lat', 'lon'],
                autoCollapse: true,
                autoType: false,
                minLength: 2,
                moveToLocation: function(latlng, title, map) {
                    let latitude = latlng.lat.toString().substring(0, 10);
                    let longitude = latlng.lng.toString().substring(0, 10);
                    var popupContentkerja = "Lokasi : " + latitude + ", " + longitude + ".";
                    lokasi = L.marker([latitude, longitude]).addTo(map);
                    lokasi.bindPopup(popupContentkerja)
                        .openPopup();
                    console.log(latitude + ', ' + longitude);
                    $("[name='latitude']").val(latitude);
                    $("[name='longitude']").val(longitude);
                }
            })
            .addTo(map);

        map.on('click', function(e) {
            let latitude = e.latlng.lat.toString().substring(0, 10);
            let longitude = e.latlng.lng.toString().substring(0, 10);
            if (lokasi != undefined) {
                map.removeLayer(lokasi);
            };
            var popupContentkerja = "Lokasi : " + latitude + ", " + longitude + ".";
            lokasi = L.marker([latitude, longitude]).addTo(map);
            lokasi.bindPopup(popupContentkerja)
                .openPopup();
            console.log(latitude + ', ' + longitude);
            $("[name='latitude']").val(latitude);
            $("[name='longitude']").val(longitude);
        });

        $('body').on('shown.bs.modal', function(e) {
            setTimeout(function() {
                map.invalidateSize()
            }, 500);
        })

        $('#btnTambah').click(function() {
            $("#form")[0].reset();
            $("#tambahModalLabel").html("Tambah Kota");
        });

        $(document).on('click', '#btnEdit', function() {
            val = $(this).data('val').split("|");
            $("#tambahModalLabel").html("Edit Kota");
            $('#method').html('<input type="hidden" name="_method" value="patch">');

            $("[name='nama_kota']").val(val[1]);
            $("[name='provinsi']").val(val[2]);
            $("[name='pulau']").val(val[3]);
            $("[name='luar_negeri']").val(val[4]);
            $("[name='latitude']").val(val[5]);
            $("[name='longitude']").val(val[6]);
            $('#form').attr('action', "{{ url('admin/master-kota') }}" + "/" + val[0]);

            console.log(val);
            map.setView([val[5], val[6]], 13);
            if (lokasi != undefined) {
                map.removeLayer(lokasi);
            };
            var popupContent = "Lokasi : " + val[5] + ", " + val[6] + ".";
            lokasi = L.marker([val[5], val[6]]).addTo(map);
            lokasi.bindPopup(popupContent)
                .openPopup();
        })
    </script>
@endsection
