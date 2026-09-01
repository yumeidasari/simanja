@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="sm-dash-welcome">
        <div>
          <h4>Halo, {{ auth()->user()->name }} 👋</h4>
          <p>Berikut ringkasan data aset di unit kerja kamu.</p>
        </div>
      </div>

      @php
        $totalUntukPersen = $jml_aset_total > 0 ? $jml_aset_total : 1;
        $persenBaik = round(($jml_aset_baik / $totalUntukPersen) * 100);
        $persenRR = round(($jml_aset_rusak_ringan / $totalUntukPersen) * 100);
        $persenRB = round(($jml_aset_rusak_berat / $totalUntukPersen) * 100);
      @endphp

      <div class="row">
        <!-- Total aset - kartu besar di kiri -->
        <div class="col-lg-4">
          <div class="sm-aset-total-card">
            <i class="material-icons">devices</i>
            <h2>{{ $jml_aset_total }}</h2>
            <p>Total Aset Tercatat</p>
          </div>
        </div>

        <!-- Breakdown kondisi - progress bar -->
        <div class="col-lg-8">
          <div class="sm-aset-breakdown-card">
            <p class="sm-form-section-title" style="margin-bottom:20px;">Kondisi Aset</p>

            <div class="sm-progress-row">
              <div class="sm-progress-label">
                <span><i class="material-icons text-success">check_circle</i> Baik</span>
                <strong>{{ $jml_aset_baik }}</strong>
              </div>
              <div class="sm-progress-track">
                <div class="sm-progress-fill sm-progress-success" style="width: {{ $persenBaik }}%"></div>
              </div>
            </div>

            <div class="sm-progress-row">
              <div class="sm-progress-label">
                <span><i class="material-icons text-warning">warning</i> Rusak Ringan</span>
                <strong>{{ $jml_aset_rusak_ringan }}</strong>
              </div>
              <div class="sm-progress-track">
                <div class="sm-progress-fill sm-progress-warning" style="width: {{ $persenRR }}%"></div>
              </div>
            </div>

            <div class="sm-progress-row">
              <div class="sm-progress-label">
                <span><i class="material-icons text-danger">error</i> Rusak Berat</span>
                <strong>{{ $jml_aset_rusak_berat }}</strong>
              </div>
              <div class="sm-progress-track">
                <div class="sm-progress-fill sm-progress-danger" style="width: {{ $persenRB }}%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="sm-dash-shortcuts" style="margin-top:24px;">
        <a href="{{ route('aset-umum.index') }}" class="sm-shortcut-card" style="flex:1 1 100%; max-width: 100%;">
          <i class="material-icons">add_circle</i>
          <span>Kelola Data Aset Umum &rarr;</span>
        </a>
      </div>
    </div>
  </div>
@endsection