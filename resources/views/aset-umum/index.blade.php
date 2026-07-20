@extends('layouts.app', ['activePage' => 'aset-umum', 'titlePage' => __('Aset Umum')])

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
                        <h4 class="card-title ">{{ __('Aset Umum') }}</h4>
                        <p class="card-category">{{ __('Form untuk mengelola data aset umum Diskomifo') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-center">
							<div class="col-md-6">
							<!--Form pencarian -->
							
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
								
							</div>
							
							<div class="col-md-6 text-right">

								<a title="cetak laporan PDF" href="{{ route('aset-umum.laporan') }}" class="btn btn-sm btn-rose">
									<i class="material-icons">picture_as_pdf</i>
									<div class="ripple-container"></div>
								</a>

                                <a title="tambah data" href="#" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modalTambahAlat">
									<i class="material-icons">add</i>
									<div class="ripple-container"></div>
								</a>
								<a title="export excel" href="{{ route('aset-umum.export') }}" class="btn btn-sm btn-rose">
									<i class="material-icons">grid_on</i>
									<div class="ripple-container"></div>
								</a>							
                            </div>
							
							
							<!--Modal Input Aset Diskominfo-->
							<div class="modal fade" id="modalTambahAlat" tabindex="-1" aria-labelledby="modalTambahAlat" aria-hidden="true">
								<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
									<div class="modal-content">
										<form class="form" method="POST" action="{{ route('simpanAsetUmum') }}" enctype="multipart/form-data">
										@csrf
										<div class="card sm-form-card mb-0">
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
															<input type="text" class="form-control" name="nama_barang" placeholder="cth. Laptop, Router, Kamera CCTV" required>
														</div>
														<div class="form-group">
															<label for="">Kode Barang</label>
															<input type="text" class="form-control" name="kode_barang" placeholder="cth. KB-001, KB-002" required>
														</div>
														<div class="form-group">
															<label for="">Merek</label>
															<input type="text" class="form-control" name="merek" placeholder="cth. Cisco, Dell, HP" required>
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
															<input type="text" class="form-control" name="penanggung_jawab" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="">NIP</label>
															<input type="text" class="form-control" name="nip" required>
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
													<textarea class="form-control" name="deskripsi" rows="4" placeholder="Jelaskan spesifikasi, jumlah, dan keterangan lain terkait barang..." required></textarea>
												</div>

												<p class="sm-form-section-title">Lampiran Foto</p>
												<div class="control-group after-add-more-aset">
													<div id="displayAset" hidden>0</div>
													<div class="form-row align-items-center">
														<div class="col-md-8">
															<div class="sm-upload-box">
																<label class="mb-2 d-block">
																	<i class="material-icons">cloud_upload</i>Upload Gambar Barang
																</label>
																<p class="small text-muted mb-2">*Ukuran gambar maksimal <span class="text-danger">2MB</span></p>
																<input type='file' name="file[]" class="form-control" required>
															</div>
														</div>
														<div class="col-md-4 text-md-right mt-3 mt-md-0">
															<button class="btn btn-success add-more-aset" type="button">
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
												<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
											</div>
										</div>
										</form>
										<div class="copy-aset invisible">
											<div class="control-group">
												<div class="form-row align-items-center">
													<div class="col-md-8">
														<div class="sm-upload-box">
															<input type='file' name="file[]" class="form-control">
														</div>
													</div>
													<div class="col-md-4 text-md-right mt-3 mt-md-0">
														<button class="btn btn-danger remove-aset" type="button">
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
							<!--end Modal-->
							
                        </div>
						<hr>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
									{{--	<th>
											<b>No.</b>
										</th>
									--}}
                                        <th>
                                            <b>Jenis Barang</b>
                                        </th>
										<th>
                                            <b>Nama Barang</b>
                                        </th>
										<th>
                                            <b>Merek</b>
                                        </th>
										<th>
                                            <b>Penanggung Jawab</b>
                                        </th>
										<th>
                                            <b>Unit Kerja/Bidang</b>
                                        </th>
										<th>
                                            <b>Kondisi</b>
                                        </th>
                                        <th class="text-right">
                                            <b>Actions</b>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($semua_aset as $no => $record)
									@if (auth()->user()->role == 'USER')
										@if ($record->id_unit_kerja == auth()->user()->id_bidang)
									<tr>
									{{-- <td>{{ $semua_aset->firstItem() + $loop->index }} {{++$no + ($semua_aset->currentPage()-1) * $semua_aset->perPage()}}</td> --}}
										<td>{{ $record->jenis_aset }}</td>
										<td>
											<a rel="tooltip" href="#" class="btn btn-primary btn-link" data-toggle="modal" data-target="#modalFoto{{ $record->id }}">
												{{ $record->nama_aset }}
											</a>
										
										</td>
										<td>{{ $record->merek }}</td>
										<td>{{ $record->penanggung_jawab }}</td>
										<td>{{ $record->bidang }}</td>
										@if ($record->kondisi_aset == 'baik')
											<td><span class="badge badge-success">{{ $record->kondisi_aset }}</span></td>
										@elseif ($record->kondisi_aset == 'rusak ringan')
											<td><span class="badge badge-warning">{{ $record->kondisi_aset }}</span></td>
										@else
											<td><span class="badge badge-danger">{{ $record->kondisi_aset }}</span></td>
										@endif
										<td class="td-actions text-right">
											<a rel="tooltip" href="{{ url("/aset-umum/detail/$record->id") }}" class="btn btn-warning btn-link">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
											</a>
											<a rel="tooltip" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalHapusAlat{{ $record->id }}">
												<i class="material-icons">delete</i>
												<div class="ripple-container"></div>
											</a>
											
										</td>

									</tr>
										@endif
									@else
										<tr>
									{{-- <td>{{ $semua_aset->firstItem() + $loop->index }} {{++$no + ($semua_aset->currentPage()-1) * $semua_aset->perPage()}}</td> --}}
										<td>{{ $record->jenis_aset }}</td>
										<td>
											<a rel="tooltip" href="#" class="btn btn-primary btn-link" data-toggle="modal" data-target="#modalFoto{{ $record->id }}">
												{{ $record->nama_aset }}
											</a>
										
										</td>
										<td>{{ $record->merek }}</td>
										<td>{{ $record->penanggung_jawab }}</td>
										<td>{{ $record->bidang }}</td>
										@if ($record->kondisi_aset == 'baik')
											<td><span class="badge badge-success">{{ $record->kondisi_aset }}</span></td>
										@elseif ($record->kondisi_aset == 'rusak ringan')
											<td><span class="badge badge-warning">{{ $record->kondisi_aset }}</span></td>
										@else
											<td><span class="badge badge-danger">{{ $record->kondisi_aset }}</span></td>
										@endif
										<td class="td-actions text-right">
											<a rel="tooltip" href="{{ url("/aset-umum/detail/$record->id") }}" class="btn btn-warning btn-link">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
											</a>
											<a rel="tooltip" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalHapusAlat{{ $record->id }}">
												<i class="material-icons">delete</i>
												<div class="ripple-container"></div>
											</a>
											
										</td>

									</tr>
									@endif
									<!-- modal hapus ALAT -->
									<div class="modal fade" id="modalHapusAlat{{ $record->id }}" tabindex="-1" aria-labelledby="modalHapusAlat" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">{{ __('Delete Aset') }}</h4>
													</div>
												</div>
												<div class="modal-body">
													<h4 class="text-center">Apakah anda yakin ingin menghapus data alat: <span>{{ $record->nama_aset }} ?</span></h4>
												</div>
												
												<div class="modal-footer  ml-auto mr-auto">
													<form action="{{url("aset-umum/$record->id")}}" method="post">
													@csrf
													@method('delete')
														<button type="submit" class="btn btn-primary">Hapus data alat!</button>
														<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<!-- end modal-->

									<!-- modal foto aset -->
									<div class="modal fade" id="modalFoto{{ $record->id }}" tabindex="-1" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content" style="background:transparent; box-shadow:none;">
												<div class="modal-body text-center p-0">
													@if(isset($semua_lampiran[$record->id]))
														<img src="{{ asset('storage/'.$semua_lampiran[$record->id][0]->file_lampiran) }}" style="max-width:100%; border-radius:12px;">
													@else
														<div class="card"><div class="card-body text-center">Belum ada foto untuk aset ini.</div></div>
													@endif
												</div>
											</div>
										</div>
									</div>
									<!-- end modal foto -->
									
									@endforeach
									
                                </tbody>
                            </table>
							{{ $semua_aset->links() }} 
                        </div>
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
				var clicksAset = 0;

				$(".add-more-aset").click(function() {
					clicksAset += 1;
					if (clicksAset < 6) {
						var html = $(".copy-aset").html();
						$(".after-add-more-aset").after(html);
						document.getElementById("displayAset").innerHTML = clicksAset;
					} else {
						alert("Hanya dapat menambahkan maksimal 6 lampiran!");
					}
				});

				$("body").on("click", ".remove-aset", function() {
					clicksAset = document.getElementById("displayAset").innerHTML - 1;
					$(this).parents(".control-group").remove();
					document.getElementById("displayAset").innerHTML = clicksAset;
				});
			});
	</script>
@endpush