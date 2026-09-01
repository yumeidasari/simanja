@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="sm-dash-welcome">
        <div>
          <h4>Halo, {{ auth()->user()->name }} 👋</h4>
          <p>Berikut ringkasan data aset & jaringan IT Diskominfo Beltim.</p>
        </div>
        <div class="sm-dash-welcome-date">
          <i class="material-icons" style="font-size:16px; vertical-align:-3px;">calendar_today</i>
          {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
      </div>
      
      <div class="sm-dash-shortcuts">
        <a href="{{ route('aset-umum.index') }}" class="sm-shortcut-card">
          <i class="material-icons">devices</i>
          <span>Aset Umum</span>
        </a>
        <a href="{{ route('map') }}" class="sm-shortcut-card">
          <i class="material-icons">map</i>
          <span>Peta Jaringan FO</span>
        </a>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">apps</i>
              </div>
              <p class="card-category">Total<br>Aplikasi</p>
              <h3 class="card-title">{{$jml_aplikasi}}
                <small></small>
              </h3>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">router</i>
              </div>
              <p class="card-category">Peralatan<br>Jaringan</p>
              <h3 class="card-title">{{$jml_jaringan}}</h3>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">wifi</i>
              </div>
              <p class="card-category">Jumlah<br>Titik Wifi</p>
              <h3 class="card-title">{{$jml_wireless}}</h3>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="material-icons">account_balance</i>
              </div>
              <p class="card-category">OPD<br>yang terhubung</p>
              <h3 class="card-title">{{$jml_opd}}</h3>
            </div>
          </div>
        </div>
      </div>
	   <div class="row">
        <div class="col-md-6">
            <p class="sm-chart-title">Aplikasi berdasarkan jenis Layanan</p>
            <div id="pie-by-jenis"></div>
        </div>
		<div class="col-md-6">
            <p class="sm-chart-title">Aplikasi berdasarkan OPD</p>
            <div id="pie-by-opd"></div>
        </div>
        
    </div>
    </div>
  </div>
 
  @piechart('pie_by_jenis', 'pie-by-jenis')
  @piechart('pie_by_opd', 'pie-by-opd')
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush