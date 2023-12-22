@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'form-aset', 'title' => __('Material Dashboard')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-md-9 ml-auto mr-auto mb-3 text-center">
      <h3>{{ __('') }} </h3>
    </div>
    <div class="col-lg-12 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('simpanAsetUmum') }}" enctype="multipart/form-data">
        @csrf

        <div class="card card-hidden mb-3">
          <div class="card-header card-header-rose text-center">
            <h4 class="card-title"><strong>{{ __('Input Data Aset DISKOTIKDANSA') }}</strong></h4>
            
          </div>
          <div class="card-body">
		  <div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="">Jenis Barang</label>
						<br>
						<select name="jenis_barang" class="form-control">
							<option value="">--Pilih Jenis Barang</option>
							<option value="kendaraan">Kendaraan</option>
							<option value="elektronik">Barang Elektronik</option>
						</select>
					</div>
			
					<div class="form-group">
						<label for="">Nama Barang</label>
						<br>
						<input type="text" class="form-control" id="nama_barang" name="nama_barang"  required>
					</div>
					<div class="form-group">
						<label for="">Merek</label>
						<br>
						<input type="text" class="form-control" id="merek" name="merek"  required>
					</div>
					<div class="form-group">
						<label for="">Kondisi Barang</label>
						<br>
						<select name="kondisi_barang" class="form-control" required>
							<option value="">--Kondisi Barang</option>
							<option value="baik">Baik</option>
							<option value="rusak ringan">Rusak Ringan</option>
							<option value="rusak berat">Rusak Berat</option>
						</select>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="">Tahun Pengadaan</label>
						<br>
						<select name="thn_pengadaan" class="form-control" required>
							<option selected="selected">--Pilih Tahun Pengadaan</option>
								<?php
								for($i=date('Y')+1; $i>=date('Y')-30; $i-=1){
								echo"<option value='$i'> $i </option>";
								}
								?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Nama Penanggung Jawab</label>
						<br>
						<input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" required>
					</div>
					
					<div class="form-group">
						<label for="">NIP</label>
						<br>
						<input type="text" class="form-control" id="nip" name="nip"  required>
					</div>
					<div class="form-group">
						<label for="">Unit Kerja / Bidang</label>
						<br>
						<select name="id_unit_kerja" class="form-control">
							<option value="">--Pilih Unit Kerja</option>
							@foreach($data_bidang as $uk)
								<option value="{{ $uk->id }}">{{ $uk->nama_unit_kerja }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
				<br>
				<div class="form-group">
					<label for="">Deskripsi/Spesifikasi Barang</label>
					<br>
					<textarea class="form-control" name="deskripsi" rows="6" required></textarea>
				</div>
				
				
				<div class="control-group after-add-more">
					<div id="display" hidden>0</div>
                        <div class="form-row">
							<div class=" col-md-8" >
                                <label for="">Upload Gambar Barang</label>
                                    <p class="small text-muted pl-2">*Ukuran gambar
                                        <span class="text-danger">maksimal 2MB</span><br />
                                    </p>
															
									<input type='file' name="file[]" class="form-control"  id="validate" required><br>
								
                            </div>

                            <div class="col">
                                <label for="" class="text-white">. </label>
                                <br><br><br>
                                <button class="btn btn-success add-more" type="button">
                                                + Tambah Lagi
                                </button>
							</div>
						</div>
						<div class="row">
							<div class="col"></div>
                        </div>
                </div>
				
          </div>
		  
          <div class="card-footer justify-content-center">
		  
            <button type="submit" class="btn btn-primary btn-lg">{{ __('Simpan') }}</button>
          </div>
        </div>
      </form>
							<div class="copy invisible">
                                <div class="control-group">
                                    <div class="form-row">
                                        <div class="col-md-8">
                                            <input type='file' name="file[]" class="form-control"
                                                id="validate2"><br>
                                        </div>

                                        <div class="col">
                                            <label for="" class="text-white">. </label>
                                            <button class="btn btn-danger remove" type="button">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col"></div>
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
