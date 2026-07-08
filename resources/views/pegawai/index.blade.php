@extends('layouts.app', ['activePage' => 'pegawai', 'titlePage' => __('Data Pegawai')])

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
                        <h4 class="card-title ">{{ __('Data Pegawai') }}</h4>
                        <p class="card-category">{{ __('Kelola data pegawai untuk pilihan Penanggung Jawab Aset') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a rel="tooltip" href="{{url('pegawai/create')}}" class="btn btn-sm btn-primary">
									<i class="material-icons">person_add</i>
									<div class="ripple-container"></div>
								</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
										<th>No.</th>
                                        <th>Nama Pegawai</th>
                                        <th>NIP</th>
                                        <th>Bidang</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($semua_pegawai as $no => $record)
									<tr>
										<td>{{++$no + ($semua_pegawai->currentPage()-1) * $semua_pegawai->perPage()}}</td>
										<td>{{ $record->nama }}</td>
										<td>{{ $record->nip }}</td>
										<td>{{ $record->bidang }}</td>
										<td class="td-actions text-right">
											<a rel="tooltip" href='{{url("pegawai/$record->id/edit")}}' class="btn btn-warning btn-link">
												<i class="material-icons">edit</i>
												<div class="ripple-container"></div>
											</a>
											<a rel="tooltip" href='#' class="btn btn-danger btn-link" data-toggle="modal" data-target="#modalHapusPegawai{{ $record->id }}">
												<i class="material-icons">delete</i>
												<div class="ripple-container"></div>
											</a>
										</td>
									</tr>
									<!-- modal hapus pegawai -->
									<div class="modal fade" id="modalHapusPegawai{{ $record->id }}" tabindex="-1" aria-labelledby="modalHapusPegawai" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="card">
													<div class="card-header card-header-rose">
														<h4 class="card-title ">{{ __('Delete Pegawai') }}</h4>
													</div>
												</div>
												<div class="modal-body">
													<h4 class="text-center">Apakah anda yakin ingin menghapus pegawai : <span>{{ $record->nama }} ?</span></h4>
												</div>
												<div class="modal-footer">
													<form action="{{url("pegawai/$record->id")}}" method="post">
													@csrf
													@method('delete')
														<button type="submit" class="btn btn-primary">Hapus Pegawai!</button>
														<button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
													</form>
												</div>
											</div>
										</div>
									</div>
									<!-- end modal-->
									@endforeach
                                </tbody>
                            </table>
							{!! $semua_pegawai->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection