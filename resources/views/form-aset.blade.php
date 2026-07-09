@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'form-aset', 'title' => __('Material Dashboard')])

@section('content')
<div class="content">
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-lg-12 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('simpanAsetUmum') }}" enctype="multipart/form-data">
        @csrf

        <div class="card sm-form-card mb-3">
          <div class="card-header text-center">
            <h4 class="card-title justify-content-center">
              <i class="material-icons">devices</i>
              <strong>{{ __('Input Data Aset Diskominfo') }}</strong>
            </h4>
          </div>
          <div class="card-body">

            <p class="sm-form-section-title">Identitas Barang</p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Jenis Barang</label>
                  <select name="jenis_barang" class="form-control">
                    <option value="">--Pilih Jenis Barang</option>
                    <option value="kendaraan">Kendaraan</option>
                    <option value="elektronik">Barang Elektronik</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Nama Barang</label>
                  <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="cth. Laptop, Router, Kamera CCTV" required>
                </div>
                <div class="form-group">
                  <label for="">Merek</label>
                  <input type="text" class="form-control" id="merek" name="merek" placeholder="cth. Cisco, Dell, HP" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Kondisi Barang</label>
                  <select name="kondisi_barang" class="form-control" required>
                    <option value="">--Kondisi Barang</option>
                    <option value="baik">Baik</option>
                    <option value="rusak ringan">Rusak Ringan</option>
                    <option value="rusak berat">Rusak Berat</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Tahun Pengadaan</label>
                  <select name="thn_pengadaan" class="form-control" required>
                    <option selected="selected">--Pilih Tahun Pengadaan</option>
                    <?php
                    for($i=date('Y')+1; $i>=date('Y')-30; $i-=1){
                    echo"<option value='$i'> $i </option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <p class="sm-form-section-title">Penanggung Jawab</p>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Nama Penanggung Jawab</label>
                  <select class="form-control" id="penanggung_jawab" name="penanggung_jawab" required>
                    <option value="">--Pilih Penanggung Jawab</option>
                    @foreach($data_pegawai as $pegawai)
                      <option value="{{ $pegawai->nama }}">{{ $pegawai->nama }} ({{ $pegawai->bidang }})</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">NIP</label>
                  <input type="text" class="form-control" id="nip" name="nip" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Unit Kerja / Bidang</label>
                  <select name="id_unit_kerja" class="form-control">
                    <option value="">--Pilih Unit Kerja</option>
                    @foreach($data_bidang as $uk)
                      <option value="{{ $uk->id }}">{{ $uk->nama_unit_kerja }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <p class="sm-form-section-title">Deskripsi</p>
            <div class="form-group">
              <label for="">Deskripsi/Spesifikasi Barang</label>
              <textarea class="form-control" name="deskripsi" rows="5" placeholder="Jelaskan spesifikasi, jumlah, dan keterangan lain terkait barang..." required></textarea>
            </div>

            <p class="sm-form-section-title">Lampiran Foto</p>
            <div class="control-group after-add-more">
              <div id="display" hidden>0</div>
              <div class="form-row align-items-center">
                <div class="col-md-8">
                  <div class="sm-upload-box">
                    <label for="validate" class="mb-2 d-block">
                      <i class="material-icons">cloud_upload</i>Upload Gambar Barang
                    </label>
                    <p class="small text-muted mb-2">*Ukuran gambar maksimal <span class="text-danger">2MB</span></p>
                    <input type='file' name="file[]" class="form-control" id="validate" required>
                  </div>
                </div>
                <div class="col-md-4 text-md-right mt-3 mt-md-0">
                  <button class="btn btn-success add-more" type="button">
                    <i class="material-icons" style="font-size:16px; vertical-align:-3px;">add_circle</i>
                    Tambah Lagi
                  </button>
                </div>
              </div>
            </div>

          </div>

          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-lg">
              <i class="material-icons" style="font-size:18px; vertical-align:-4px;">save</i>
              {{ __('Simpan') }}
            </button>
          </div>
        </div>
      </form>
      <div class="copy invisible">
        <div class="control-group">
          <div class="form-row align-items-center">
            <div class="col-md-8">
              <div class="sm-upload-box">
                <input type='file' name="file[]" class="form-control" id="validate2">
              </div>
            </div>
            <div class="col-md-4 text-md-right mt-3 mt-md-0">
              <button class="btn btn-danger remove" type="button">
                <i class="material-icons" style="font-size:16px; vertical-align:-3px;">delete</i>
                Hapus
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
@push('js')
	<script>
			$(document).ready(function() {
				var clicks = 0;

				$(".add-more").click(function() {
					clicks += 1;
					if (clicks < 6) {
						var html = $(".copy").html();
						$(".after-add-more").after(html);
						document.getElementById("display").innerHTML = clicks;
					} else {
						alert("Hanya dapat menambahkan maksimal 6 lampiran!");
					}

				});

				// saat tombol remove dklik control group akan dihapus 
				$("body").on("click", ".remove", function() {
					clicks = document.getElementById("display").innerHTML - 1;
					$(this).parents(".control-group").remove();
					document.getElementById("display").innerHTML = clicks;
				});


			});
	</script>
@endpush