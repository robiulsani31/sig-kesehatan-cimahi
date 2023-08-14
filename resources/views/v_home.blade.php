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
@endsection
