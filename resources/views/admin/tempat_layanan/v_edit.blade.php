@extends('layouts.backend')

@section('content')

<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data</h3>
        </div>
        <form action="/tempat_layanan/update/{{ ($tempat_layanan->id_tempat) }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Tempat</label>
                            <input name="nama_tempat" value="{{ $tempat_layanan->nama_tempat }}" class="form-control" placeholder="Nama Tempat">
                            <div class="text-danger">
                                @error('nama_tempat')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="id_kategori" class="form-control">
                                <option value="{{ $tempat_layanan->id_kategori }}">{{ $tempat_layanan->kategori }}</option>
                                @foreach($kategori as $data)
                                    <option value="{{ $data->id_kategori}}">{{ $data->kategori }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('id_kategori')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select name="id_kecamatan" class="form-control">
                                <option value="{{ $tempat_layanan->id_kecamatan }}">{{ $tempat_layanan->kecamatan }}</option>
                                @foreach($kecamatan as $data)
                                    <option value="{{ $data->id_kecamatan}}">{{ $data->kecamatan }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('id_kecamatan')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="alamat" value="{{ $tempat_layanan->alamat }}" class="form-control" placeholder="Alamat">
                            <div class="text-danger">
                                @error('alamat')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Posisi Tempat</label>
                            <input name="posisi" id="posisi" value="{{ $tempat_layanan->posisi }}" class="form-control" placeholder="Posisi Tempat">
                            <div class="text-danger">
                                @error('posisi')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label>Foto Tempat</label>
                            <input type="file" name="foto" class="form-control" accept="image/jpeg, image/png">
                            <div class="text-danger">
                                @error('foto')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label>Map</label> <label class="text-danger">(Drag and Drop Atau Klik Map Untuk Menentukan Tempat Layanan Kesehatan)</label>
                        <div id="map" style="width: 100%; height:300px;"></div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" rows="10">{{ $tempat_layanan->deskripsi }}</textarea>
                            <div class="text-danger">
                                @error('deskripsi')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
            <a href="/tempat_layanan" class="btn btn-warning float-right">Cancel</a>
        </div>
        </form>
    </div>
</div>

<script>
    var peta1 = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	    maxZoom: 20,
	    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var peta2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	    maxZoom: 19,
        attribution: 'Tiles &copy; IGP, UPR-EGP, and the GIS User Community'
    });

    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
	    maxZoom: 20,
	    attribution: '&copy; OpenStreetMap France | &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var peta4 = L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
	    maxZoom: 20,
	    attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
    });

    var map = L.map('map', {
        center: [{{ $tempat_layanan->posisi }}],
        zoom: 14,
        layers: [peta1],
    });

    var baseMaps = {
    "Grayscale": peta1,
    "Satellite": peta2,
    "Streets": peta3,
    "Dark": peta4,
    };

    var layerControl = L.control.layers(baseMaps).addTo(map);

    //mengambil titik koordinat
    var curLocation = [{{ $tempat_layanan->posisi }}];
    map.attributionControl.setPrefix(false);

    var marker = new L.marker(curLocation,{
        draggable : 'true',
    });

    map.addLayer(marker);

    //mengambil koordinat saat di drag and drop
    marker.on('dragend',function(event){
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            draggable : 'true',
        }).bindPopup(position).update();
        $("#posisi").val(position.lat + " , " + position.lng).keyup();
    });

    //mengambil koordinat ketika di klik
    var posisi = document.querySelector("[name=posisi]");
    map.on("click", function(event){
        var lat = event.latlng.lat;
        var lng = event.latlng.lng;

        if (!marker) {
            marker = L.marker(event.latlng).addTo(map);
        }else{
            marker.setLatLng(event.latlng);
        }
        posisi.value = lat + " , " + lng
    });


</script>



@endsection

