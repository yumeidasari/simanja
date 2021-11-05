@extends('layouts.app', ['activePage' => 'wireless', 'titlePage' => __('Wireless->Import File')])

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
                        <h4 class="card-title ">{{ __('Import File .xls Wireless') }}</h4>
                        <p class="card-category">{{ __('') }}</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
							<div class="col-6">
							<!-- import Data -->
							 <form action="{{route('wireless.import')}}" method="post" enctype="multipart/form-data">
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

