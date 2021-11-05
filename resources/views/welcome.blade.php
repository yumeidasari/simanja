@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Welcome')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <h1 class="text-white text-center"><b>{{ __('Sistem Manajemen Aset Jaringan IT')}}<br>{{__('Pemerintah Kabupaten Belitung Timur') }}</b></h1>
      </div>
  </div>
</div>
@endsection
