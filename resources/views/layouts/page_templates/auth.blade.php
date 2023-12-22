<div class="wrapper ">
  @include('layouts.navbars.sidebar')
  <div class="main-panel">
    @include('layouts.navbars.navs.auth')
    @yield('content')
	@include('sweetalert::alert')
	@include('layouts.footers.auth')
  </div>
  
</div>