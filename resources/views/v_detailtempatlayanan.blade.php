@extends('layouts.frontend')

@section('content')

<div class="col-sm-6">
    <div id="map" style="width: 100%; height:400px; box-shadow:10px 10px 10px #888888;"></div>
</div>
<div class="col-sm-6">
    <img src="{{ asset('foto') }}/{{ $tempat->foto }}" width="100%" height="400px">
</div>
<div class="col-sm-12">
    <br><br>
    <table class="table table-bordered">
        <tr>
            <td width="300px">Nama Tempat</td>
            <td width="20px">:</td>
            <td>{{ $tempat->nama_tempat }}</td>
        </tr>
        <tr>
            <td>Kategori</td>
            <td>:</td>
            <td>{{ $tempat->kategori }}</td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td>{{ $tempat->kecamatan }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $tempat->alamat }}</td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td width="20px">:</td>
            <td>{!! $tempat->deskripsi !!}</td>
        </tr>
    </table>

    <button type="button" class="btn btn-outline-dark" onclick="goBack()">Close</button>
    
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
        center: [{{ $tempat->posisi }}],
        zoom: 14,
        layers: [peta2],
    });

    var baseMaps = {
    "Grayscale": peta1,
    "Satellite": peta2,
    "Streets": peta3,
    "Dark": peta4,
    };

    var layerControl = L.control.layers(baseMaps).addTo(map);

    var iconTempatLayanan = L.icon({
        iconUrl: '{{ asset('icon') }}/{{ $tempat->icon }}',
        iconSize:  [50, 50],
    });

        L.marker([<?= $tempat->posisi ?>], {icon: iconTempatLayanan})
        .addTo(map)

    function goBack() {
        window.history.back();
    }
</script>
@endsection