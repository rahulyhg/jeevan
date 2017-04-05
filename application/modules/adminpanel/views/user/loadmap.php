<div id="map" class="ro-map" style="width:100%;height:600px"></div>
<script type="text/javascript" src="<?php echo load_lib(); ?>theme/js/jquery.min.js" ></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7xN19aOc0P7G4S9zP6N_uKywn7Vmeebs&callback=initMap">
</script>
<script type="text/javascript">
    var admin_url = '<?php echo admin_url(); ?>';
    function loadmap(mapid) {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: {lat: -24.345, lng: 134.46}
        });
        var myLatlng = new google.maps.LatLng(51.503454, -0.119562);
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
            draggable: true,
            map: map,
            panel: document.getElementById('right-panel')
        });

        directionsDisplay.addListener('directions_changed', function () {
            computeTotalDistance(directionsDisplay.getDirections());
        });
        $.ajax({
            url: admin_url + '<?php echo $module . '/getroute_by_map_id'; ?>',
            data: {'map_id': mapid},
            dataType: 'json',
            type: 'post',
            success: function (output) {
                displayRoute("'" + output.startvalue + "'", "'" + output.endvalue + "'", directionsService,
                        directionsDisplay, output.destinations);
            }
        });
    }
    function initMap() {
        loadmap('<?php echo $map_id; ?>');
    }

    function displayRoute(origin, destination, service, display, destinations) {
        service.route({
            origin: origin,
            destination: destination,
            waypoints: destinations,
            travelMode: 'DRIVING',
            avoidTolls: true
        }, function (response, status) {
            if (status === 'OK') {
                display.setDirections(response);
            } else {
                $.ajax({
                    url: admin_url + '<?php echo $module . '/getlattitude_longtitude'; ?>',
                    data: {'start_date': origin, 'end_date': destination},
                    dataType: 'json',
                    type: 'post',
                    success: function (output) {
                        var myLatLng = new google.maps.LatLng(0, 0);
                        var mapOptions = {
                            zoom: 3,
                            mapTypeControl: false,
                            navigationControl: false,
                            scrollwheel: false,
                            streetViewControl: false,
                            zoomControl: false,
                            center: myLatLng,
                            draggable: true,
                            mapTypeId: google.maps.MapTypeId.TERRAIN
                        };
                        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
                        var directionsDisplay = new google.maps.DirectionsRenderer({
                            draggable: true,
                            map: map,
                            panel: document.getElementById('right-panel')
                        });

                        directionsDisplay.addListener('directions_changed', function () {
                            computeTotalDistance(directionsDisplay.getDirections());
                        });
                        var flightPlanCoordinates = [
                            {lat: output.start_lattitude, lng: output.start_longtitude},
                            {lat: output.end_lattitude, lng: output.end_longtitude},
                        ];
                        var lineSymbol = {
                            path: google.maps.SymbolPath.FORWARD_CLOSED_ARROW
                        };
                        var marker1 = new google.maps.Marker({
                            position: {lat: output.start_lattitude, lng: output.start_longtitude},
                            map: map,
                            animation: google.maps.Animation.BOUNCE,
                            title: 'EXPRESS LIVE!'
                        });
                        var marker2 = new google.maps.Marker({
                            position: {lat: output.end_lattitude, lng: output.end_longtitude},
                            map: map,
                            animation: google.maps.Animation.BOUNCE,
                            title: 'EXPRESS LIVE!'
                        });
                        var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
                        var flightPath = new google.maps.Polyline({
                            path: flightPlanCoordinates,
                            geodesic: true,
                            draggable: true,
                            strokeColor: '#3399ff',
                            strokeOpacity: 3.0,
                            strokeWeight: 6
                        });
                        flightPath.setMap(map);
                    }
                });
            }
        });
    }

    function computeTotalDistance(result) {
        var total = 0;
        var myroute = result.routes[0];
        for (var i = 0; i < myroute.legs.length; i++) {
            total += myroute.legs[i].distance.value;
        }
        total = total / 1000;
        document.getElementById('total').innerHTML = total + ' km';
    }
</script>