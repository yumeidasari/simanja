@extends('layouts.app', ['activePage' => 'aset-umum', 'titlePage' => __('Detail Aset Umum')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
			@if(Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message')}}
            </div>
			@endif
			@if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
			@endif
                <div class="card">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title ">{{ __('Detail Aset Umum') }}</h4>
                        <p class="card-category">{{ $data[0]->nama_aset }} {{ $data[0]->merek}}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
							<div class="col-5">
							<!-- IMPORT FILE -->
							{{--							
								<form action="{{route('alat.import')}}" method="post" enctype="multipart/form-data">
							    @csrf
                                  <input type="file" name="file" >
								  <input type="submit" value="Import" class="btn btn-sm btn-rose">
							    </form>
							--}}
							<!--END -->
							</div>
							
							<div class="col-5">
							<!--Form pencarian -->
							{{--
								<form action="{{url('aset-umum')}}" method="GET">
                                    
									<div class="input-group custom-search-form">
									<input type="text" class="form-control" name="search" placeholder="Search...">
									<span class="input-group-btn">
										<span class="input-group-btn">
											<button class="btn btn-sm btn-rose" type="submit"><i class="fa fa-search"></i></button>
										</span>
									</span>
									</div>
                    
								</form>
							--}}	
							</div>
						</div>
					<form action="{{route('updateAsetUmum', $data[0]->id )}}" method="post" enctype="multipart/form-data">
						@csrf
						@method('put')
						<div class="row">
								<div class="col">
									<div class="form-group">
										<label for="">Jenis Barang</label>
										<br>
										<select class="form-control" name="jenis_barang" >
										  <option value="">--Pilih Jenis Barang</option>
										  <option {{$data[0]->jenis_aset == "kendaraan" ? "selected" : ""}} value="kendaraan">Kendaraan</option>
										  <option {{$data[0]->jenis_aset == "elektronik" ? "selected" : ""}} value="elektronik">Barang Elektronik</option>
										</select>
										
									</div>
							
									<div class="form-group">
										<label for="">Nama Barang</label>
										<br>
										<input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $data[0]->nama_aset }}"  required>
									</div>
									<div class="form-group">
										<label for="">Merek</label>
										<br>
										<input type="text" class="form-control" id="merek" name="merek" value="{{ $data[0]->merek }}"  required>
									</div>
									<div class="form-group">
										<label for="">Kondisi Barang</label>
										<br>
										<select class="form-control" name="kondisi_barang" >
										  <option value="">--Pilih Kondisi Barang</option>
										  <option {{$data[0]->kondisi_aset == "baik" ? "selected" : ""}} value="baik">Baik</option>
										  <option {{$data[0]->kondisi_aset == "rusak ringan" ? "selected" : ""}} value="rusak ringan">Rusak Ringan</option>
										  <option {{$data[0]->kondisi_aset == "rusak berat" ? "selected" : ""}} value="rusak berat">Rusak Berat</option>
										  
										</select>
										
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="">Tahun Pengadaan</label>
										<br>
										<input type="text" class="form-control" id="thn_pengadaan" name="thn_pengadaan" value="{{ $data[0]->thn_pengadaan }}" required readonly>
									</div>
									<div class="form-group">
										<label for="">Nama Penanggung Jawab</label>
										<br>
										<input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" 
											value="{{ $data[0]->penanggung_jawab }}" required>
									</div>
									
									<div class="form-group">
										<label for="">NIP</label>
										<br>
										<input type="text" class="form-control" id="nip" name="nip" value="{{ $data[0]->nip }}" required>
									</div>
									<div class="form-group">
										<label for="">Unit Kerja / Bidang</label>
										<br>
										<select class="form-control" name="id_unit_kerja" >
										  <option value="">--Pilih Unit Kerja</option>
										  @foreach($data_bidang as $uk)
											<option {{$data[0]->id_unit_kerja == $uk->id ? "selected" : ""}} value="{{ $uk->id }}">{{ $uk->nama_unit_kerja }}</option>
										  @endforeach
										</select>
										
									</div>
								</div>
						</div>
								<br>
							<div class="form-group">
									<label for="">Deskripsi/Spesifikasi Barang</label>
									<br>
									<textarea class="form-control" name="deskripsi" rows="6" required>{{ $data[0]->deskripsi }}</textarea>
							</div>
							<div class="form-group">
							@if(count($gambar) > 0)
								@foreach ($gambar as $lamp)
									@if ($lamp->id_aset_kantor == $data[0]->id)
										<img src="{{asset("storage/" . $lamp->file_lampiran)}}" alt="Avatar" style="width:50%">
									@endif
								@endforeach
							@else
								-- Tidak Tersedia
							@endif
							</div>

							<div class="control-group after-add-more">
								<div id="display" hidden>0</div>
								<div class="form-row">
										<div class=" col-md-8" >
											<label for="">Upload Gambar Kegiatan</label>
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

						<br>

		  
							<button type="submit" class="btn btn-primary">{{ __('Simpan Perubahan') }}</button>
							<a type="button" class="btn btn-warning" href="{{url('aset-umum')}}"> << Kembali</a>
						
					</form>
  
                    </div>
                </div> <!--end card-->
                
            </div>
        </div> <!--end row-->
    </div>  <!-- end container-fluid-->
</div> <!--end content-->
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
