@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Welcome'), 'guestLayout' => true])

@section('content')
<div class="simanja-hero simanja-hero-full">
  <div class="container text-center">
    <h1 class="hero-title"><b>{{ __('Sistem Manajemen Aset Jaringan IT') }}</b></h1>
    <p class="hero-subtitle mb-4">{{ __('Pemerintah Kabupaten Belitung Timur') }}</p>
    <a href="{{ route('login') }}" class="btn-hero-cta">{{ __('Masuk ke Sistem') }}</a>

    <div class="hero-highlights">
      <a href="{{ route('aset-umum.index') }}" class="hero-highlight-item">
         <i class="material-icons">devices</i>
         <span>Data Aset</span>
      </a>
      <a href="{{ route('map') }}" class="hero-highlight-item">
         <i class="material-icons">map</i>
         <span>Peta Jaringan</span>
      </a>
      <a href="{{ route('opd.index') }}" class="hero-highlight-item">
         <i class="material-icons">apartment</i>
         <span>Data OPD</span>
      </a>
    </div>
  </div>
</div>
@endsection