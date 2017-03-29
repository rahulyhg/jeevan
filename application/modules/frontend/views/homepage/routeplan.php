<link rel="stylesheet" href="<?php echo skin_url(); ?>css/style.css">
<link rel="stylesheet" href="<?php echo skin_url(); ?>css/bootstrap.min.css">
<div class="col-xs-12">
    <div class="col-xs-6">
        <div id="map" style=" height: 500px">

        </div>
    </div>
    <div class="col-xs-6">
        <table border="1">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Trip Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $details): ?>
                    <tr>
                        <td style="padding:10px"><?php echo $details['id']; ?></td>
                        <td style="padding:10px"><?php echo $details['plan_details']; ?></td>
                        <td><a href="javascript:void(0)" onclick="loadmap(<?php echo $details['id']; ?>)">View</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    var FRONTEND_URL = '<?php echo frontend_url(); ?>';
</script>
<script src="<?php echo skin_url(); ?>js/jquery-3.1.1.min.js"></script>
<script src="<?php echo skin_url(); ?>js/bootstrap.min.js"></script>
<script type="text/javascript">
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
            url: FRONTEND_URL + 'getroute_by_map_id',
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
        loadmap();
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
                alert('Could not display directions due to: ' + status);
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
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7xN19aOc0P7G4S9zP6N_uKywn7Vmeebs&callback=initMap">
</script>