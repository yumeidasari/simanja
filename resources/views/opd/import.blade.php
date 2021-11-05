@extends('layouts.app', ['activePage' => 'opd', 'titlePage' => __('Opd->Import File')])

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
                <div class="card">
                    <div class="card-header card-header-rose">
                        <h4 class="card-title ">{{ __('Import File .xls Opd') }}</h4>
                        <p class="card-category">{{ __('') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
							<div class="col-6">
							<!-- import Data -->
							 <form action="{{route('opd.import')}}" method="post" enctype="multipart/form-data">
							 @csrf
							  
                                <input type="file" name="file" >
								<input type="submit" value="Import" class="btn btn-success">
							  
							 </form>
							<!--------------->
                            </div>
                            
							
						</div>
						<hr>
						
                        
                        </div>
                    </div>
                </div> <!--end card-->
                
            </div>
        </div> <!--end row-->
    </div>  <!-- end container-fluid-->
</div> <!--end content-->

@endsection

