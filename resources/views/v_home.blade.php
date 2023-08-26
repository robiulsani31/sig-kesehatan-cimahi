@extends('layouts.backend')

@section('content')
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $kecamatan }}</h3>

                <p>Kecamatan</p>
              </div>
              <div class="icon">
                <i class="fas fa-landmark"></i>
              </div>
              <a href="/kecamatan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $kategori }}</h3>

                <p>Kategori Layanan</p>
              </div>
              <div class="icon">
                <i class="fas fa-tag"></i>
              </div>
              <a href="/kategori" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $tempat_layanan }}</h3>

                <p>Layanan Kesehatan</p>
              </div>
              <div class="icon">
                <i class="fas fa-hospital"></i>
              </div>
              <a href="/tempat_layanan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $user }}</h3>

                <p>User</p>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="/user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <h3 class="m-2">Pemetaan</h3>
          <div id="map" style="width: 100%; height:500px; box-shadow:5px 5px 5px #888888;"></div>

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
 
    @foreach($kec as $data)
        var data{{ $data->id_kecamatan }} = L.layerGroup();
    @endforeach
        
    var temp = L.layerGroup();
    
    
    var map = L.map('map', {
        center: [-6.882178649368701, 107.54229120658208],
        zoom: 13,
        layers: [peta2,
        @foreach ($kec as $data)
            data{{ $data->id_kecamatan }},
        @endforeach
        temp,
    ]
    });

    var baseMaps = {
    "Grayscale": peta1,
    "Satellite": peta2,
    "Streets": peta3,
    "Dark": peta4,
    };
    
    var overlayer = {
        @foreach($kec as $data)
            "{{ $data->kecamatan }}" : data{{ $data->id_kecamatan }},
        @endforeach
        "Tempat Layanan" : temp,
    };

    var layerControl = L.control.layers(baseMaps, overlayer).addTo(map);

    @foreach ($kec as $data)
        L.geoJSON(<?= $data->geojson ?>,{
            style : {
                color : 'white',
                fillColor: '{{ $data->warna }}',
                fillOpacity: '0.2'
            },
        }).addTo(data{{ $data->id_kecamatan }}).bindPopup("{{ $data->kecamatan }}");
    @endforeach

    @foreach ($temp as $data)
    var iconTempatLayanan = L.icon({
        iconUrl: '{{ asset('icon') }}/{{ $data->icon }}',
        iconSize:  [50, 50],
    });

    var informasi = '<table class="table table-bordered"><tr><td class="text-center" colspan="2"><img src="{{ asset('foto') }}/{{ $data->foto }}" width="140px"></td></tr><tbody><tr><td>Tempat Layanan</td><td>{{ $data->nama_tempat }}</td></tr><tr><td>Kategori</td><td>{{ $data->kategori }}</td></tr></tbody></table>'
        L.marker([<?= $data->posisi ?>], {icon: iconTempatLayanan})
        .addTo(temp)
        .bindPopup(informasi);
    @endforeach

});
   


</script>
@endsection
