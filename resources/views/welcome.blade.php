@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Welcome')])

@section('content')
<div class="simanja-hero">
  <div class="container text-center">
    <h1 class="hero-title"><b>{{ __('Sistem Manajemen Aset Jaringan IT') }}</b></h1>
    <p class="hero-subtitle">{{ __('Pemerintah Kabupaten Belitung Timur') }}</p>
  </div>
</div>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-4 mb-4">
      <div class="simanja-feature-card">
        <i class="material-icons">devices</i>
        <h5>Data Aset</h5>
        <p>Kelola dan pantau seluruh aset jaringan IT OPD</p>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="simanja-feature-card">
        <i class="material-icons">map</i>
        <h5>Peta Jaringan</h5>
        <p>Visualisasi sebaran jaringan fiber optik</p>
      </div>
    </div>
    <div class="col-md-4 mb-4">
      <div class="simanja-feature-card">
        <i class="material-icons">apartment</i>
        <h5>Data OPD</h5>
        <p>Informasi perangkat daerah terintegrasi</p>
      </div>
    </div>
  </div>
</div>
@endsection