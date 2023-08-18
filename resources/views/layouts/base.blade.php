<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth scroll-py-20	">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        <link rel="icon" type="image/x-icon" href="/favicon.ico">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
      @yield('body')

      {{-- Show alert box when successfully update something --}}
      @if (session('status') === 'updated')
          <div
              x-data="{ show: true }"
              x-show="show"
              x-transition
              x-init="setTimeout(() => show = false, 2000)"
              class="flex items-center justify-between fixed top-0 w-full z-50 bg-green-500 px-20 py-6 text-white"
          >
              {{ __('Saved.') }}
              <button @click="show = false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
              </button>
          </div>
      @endif

      <!-- CK Editor -->
      <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
      <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });

        // Initialize google map api (setup places autocomplete and map)
        function initMap() {
          const map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 13.8476, lng: 100.5696 },
            zoom: 13,
            mapTypeControl: false,
          });
          const input = document.getElementById('search-location');
          const autocomplete = new google.maps.places.Autocomplete(input);

          // Bind the map's bounds (viewport) property to the autocomplete object,
          // so that the autocomplete requests use the current map bounds for the
          // bounds option in the request.
          autocomplete.bindTo("bounds", map);

          const infowindow = new google.maps.InfoWindow();
          const infowindowContent = document.getElementById("infowindow-content");

          infowindow.setContent(infowindowContent);

          const marker = new google.maps.Marker({
            map,
            anchorPoint: new google.maps.Point(0, -29),
          });

          // Set default location based on input value
          const defaultLocationName = input.value;
          const geocoder = new google.maps.Geocoder();
          
          geocoder.geocode({ address: defaultLocationName }, (results, status) => {
            if (status === google.maps.GeocoderStatus.OK) {
              const defaultLocation = results[0].geometry.location;
              
              map.setCenter(defaultLocation);
              marker.setPosition(defaultLocation);
              marker.setVisible(true);
            } else {
              console.error('Geocode was not successful for the following reason: ' + status);
            }
          });

          autocomplete.addListener("place_changed", () => {
            infowindow.close();
            marker.setVisible(false);

            const place = autocomplete.getPlace();

            if (!place.geometry || !place.geometry.location) {
              // User entered the name of a Place that was not suggested and
              // pressed the Enter key, or the Place Details request failed.
              window.alert(
                "No details available for input: '" + place.name + "'"
              );
              return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
              map.fitBounds(place.geometry.viewport);
            } else {
              map.setCenter(place.geometry.location);
              map.setZoom(17);
            }

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            infowindowContent.classList.remove('hidden'); // Show info window content
            infowindowContent.children["place-name"].textContent = place.name;
            infowindowContent.children["place-address"].textContent =
              place.formatted_address;
            infowindow.open(map, marker);
          });
        }

        window.initMap = initMap;
      </script>

      <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZI3OSBUbfl09saa47KfiShRUFq4z6Gm8&callback=initMap&libraries=places&v=weekly"
        defer
      ></script>

    </body>
</html>
