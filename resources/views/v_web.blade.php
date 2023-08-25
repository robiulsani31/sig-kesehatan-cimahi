@extends('layouts.frontend')
@section('content')


<div id="map" style="width: 100%; height:700px; box-shadow:10px 10px 10px #888888;"></div>

<script>
    navigator.geolocation.getCurrentPosition(function(location) {
        var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);

       var curlocation = location.coords.latitude + location.coords.longitude;

        // console.log(location.coords.latitude, location.coords.longitude);

    //map view
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
 
    @foreach($kecamatan as $data)
        var data{{ $data->id_kecamatan }} = L.layerGroup();
    @endforeach
        
    var tempat_layanan = L.layerGroup();
    
    
    var map = L.map('map', {
        center: [-6.882178649368701, 107.54229120658208],
        zoom: 13,
        layers: [peta2,
        @foreach ($kecamatan as $data)
            data{{ $data->id_kecamatan }},
        @endforeach
        tempat_layanan,
    ]
    });

    var baseMaps = {
    "Grayscale": peta1,
    "Satellite": peta2,
    "Streets": peta3,
    "Dark": peta4,
    };
    
    var overlayer = {
        @foreach($kecamatan as $data)
            "{{ $data->kecamatan }}" : data{{ $data->id_kecamatan }},
        @endforeach
        "Tempat Layanan" : tempat_layanan,
    };

    var layerControl = L.control.layers(baseMaps, overlayer).addTo(map);

    @foreach ($kecamatan as $data)
        L.geoJSON(<?= $data->geojson ?>,{
            style : {
                color : 'white',
                fillColor: '{{ $data->warna }}',
                fillOpacity: '0.2'
            },
        }).addTo(data{{ $data->id_kecamatan }}).bindPopup("{{ $data->kecamatan }}");
    @endforeach

    @foreach ($tempat_layanan as $data)
    var iconTempatLayanan = L.icon({
        iconUrl: '{{ asset('icon') }}/{{ $data->icon }}',
        iconSize:  [50, 50],
    });

    var informasi = '<table class="table table-bordered"><tr><td class="text-center" colspan="2"><img src="{{ asset('foto') }}/{{ $data->foto }}" width="140px"></td></tr><tbody><tr><td>Tempat Layanan</td><td>{{ $data->nama_tempat }}</td></tr><tr><td>Kategori</td><td>{{ $data->kategori }}</td></tr><tr><td class="text-center"><a href="/detailtempatlayanan/{{ $data->id_tempat }}" class="btn btn-sm btn-outline-primary">Detail</a></td><td class="text-center"><a href="https://www.google.com/maps/dir/?api=1&origin+ curlocation + &destination={{ urlencode($data->posisi) }}" class="btn btn-sm btn-outline-success" target="_blank">Rute</a></td></tr></tbody></table>'
        L.marker([<?= $data->posisi ?>], {icon: iconTempatLayanan})
        .addTo(tempat_layanan)
        .bindPopup(informasi);
    @endforeach

});
   


</script>

@endsection
