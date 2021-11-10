@extends('layouts.app', ['activePage' => 'map', 'titlePage' => __('Peta Jaringan FO ')])

@section('content')
<div id="map"></div>
<!--div id="googleMap" style="width:100%;height:500px;"></div-->
@endsection

@push('js')
<!--script>
  $(document).ready(function() {
    // Javascript method's body can be found in assets/js/demos.js
    demo.initGoogleMaps();
  });
</script-->

<!--script>
        // fungsi initialize untuk mempersiapkan peta
        function initialize() {
        var propertiPeta = {
            center:new google.maps.LatLng(-2.884807, 108.241725),
            zoom:9,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        
        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
        }

        // event jendela di-load  
        google.maps.event.addDomListener(window, 'load', initialize);
    </script-->



<!--script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -6.917464, lng: 107.619123},
          zoom: 8		  
        });
		
		marker = new google.maps.Marker({
                position: {lat: -6.917464, lng: 107.619123},
                map: map,
				//animation:google.maps.Animation.BOUNCE,
				//icon:'images/tower_on.png',
                title:"Ini markerku",
            });
			
		google.maps.event.addListener(marker,'click',function() {
		var infowindow = new google.maps.InfoWindow({
		content:"Ini Info Window ku"
		});
		infowindow.open(map,marker);	
		});	
		
		var KMLbandung = new google.maps.KmlLayer({
		url: 'http://saptaji.com/geo/bandung1.kml',
		map: map
		});
      }
	  google.maps.event.addDomListener(window, 'load', initMap);
</script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnjlDXASsyIUKAd1QANakIHIM8jjWWyNU"
            type="text/javascript"></script-->
	
<!--https://earth.google.com/web/@-2.8840339,108.23913407,8.61856133a,1229.2649944d,30y,0h,0t,0r-->

  <!--script>

      function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          // lat dan lng sesuaikan dengan lokasi yang ada di file kml
          //karena kml saya membuat lokasi kabupaten tanah laut maka saya menggunakan lat dan lng kab. tanah laut
          center: {lat: -3.7990165, lng: 114.779605}
        });
        var ctaLayer = new google.maps.KmlLayer({
          
          //angka 0 pada link file kml kalian di ganti angka 1 agar file kmlnya bisa tampil.

          url: 'https://www.dropbox.com/s/i6k15ix7r6korjk/warna_kec_tanah_laut.shp.kml?dl=1',
          zoom:18,
          map: map
      });
      };

    </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">

    </script>
    <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCns0o8yq9Q6Z3sskLNzV6hfaPilFI5twU&callback=initMap">
    </script-->

<!--jaringan fo-->
<script>

      function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          // lat dan lng sesuaikan dengan lokasi yang ada di file kml
          //karena kml saya membuat lokasi kabupaten tanah laut maka saya menggunakan lat dan lng kab. tanah laut
          center: {lat: -2.884807, lng: 108.241725} 
        });
        var ctaLayer = new google.maps.KmlLayer({
          
          //angka 0 pada link file kml kalian di ganti angka 1 agar file kmlnya bisa tampil.

          url: 'https://www.dropbox.com/s/lim1h80voa5x2ui/map_fo_fix.kml?dl=1',
          zoom:18,
          map: map
      });
      };

    </script>
    <!--script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCns0o8yq9Q6Z3sskLNzV6hfaPilFI5twU&callback=initMap">
    </script-->
	<script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnjlDXASsyIUKAd1QANakIHIM8jjWWyNU&callback=initMap">
    </script>

@endpush
