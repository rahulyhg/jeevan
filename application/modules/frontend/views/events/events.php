
<div class="travel_program">
    <div class="container-fulid">
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 travel_location" id="tvr">
                <h3><em>Jeevanacharya Tour Plan</em></h3>
                <div id="map" style="height:460px">

                </div>
            </div>
        </div>
    </div>
</div>
<div class=" travel_content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3><em>Swamiji-Travel Program</em></h3>
                <p>Tentative Tour Programme of Jeevanacharya, watch and get connected with his WAY OF LIFE</p>
                <div class="wrapper scrollbar-dynamic ">
                    <div class="bs-example order">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Available Date</th>
                                        <th>Available Location</th>
                                        <th>Program and Destination</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($records as $details):
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo date('d M, Y', strtotime($details['start_date'])); ?></td>
                                            <td><?php echo date('d M, Y', strtotime($details['end_date'])); ?></td>
                                            <td><?php echo $details['available_date'] != 0 ? $details['available_date'] : '--'; ?></td>
                                            <td><?php echo $details['available_location'] ? $details['available_location'] : '--'; ?></td>
                                            <td><?php echo "<strong>" . $details['trip_name'] . "</strong>"; ?><br /><?php echo stripslashes(str_replace('|*|', ' >>> ', $details['destinations'])); ?></td>
                                            <td><a href="javascript:void(0)" onclick="loadmap(<?php echo $details['id']; ?>)">Route Map</a></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<div class="event_booking_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prg_booking_event">
                <h1>Program Booking</h1>

                <div class="page-header">				
                    <div class="pull-right form-inline">  
                        <div class="btn-group">
                            <button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
                            <button class="btn btn-default" data-calendar-nav="today">Today</button>
                            <button class="btn btn-primary" data-calendar-nav="next">Next >></button>
                        </div>
                        <!-- <div class="btn-group">
                                <button class="btn btn-warning" data-calendar-view="year">Year</button>
                                <button class="btn btn-warning active" data-calendar-view="month">Month</button>
                                <button class="btn btn-warning" data-calendar-view="week">Week</button>
                                <button class="btn btn-warning" data-calendar-view="day">Day</button>
                        </div> -->
                    </div>				
                    <h3></h3>

                </div>

                <div id="calendar"></div>

                <div class="page-header">				
                    <div class="pull-right form-inline">  
                        <div class="btn-group">
                            <button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
                            <button class="btn btn-default" data-calendar-nav="today">Today</button>
                            <button class="btn btn-primary" data-calendar-nav="next">Next >></button>
                        </div>
                        <!-- <div class="btn-group">
                                <button class="btn btn-warning" data-calendar-view="year">Year</button>
                                <button class="btn btn-warning active" data-calendar-view="month">Month</button>
                                <button class="btn btn-warning" data-calendar-view="week">Week</button>
                                <button class="btn btn-warning" data-calendar-view="day">Day</button>
                        </div> -->
                    </div>				

                </div>

                <div class="clearfix"></div>
                <br><br>
                <div id="disqus_thread"></div>

                <div class="modal fade" id="events-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width:700px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">GET SWAMIJI APPOINTMENT</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body" style="height: 600px">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<input type="hidden" name="start_lat" id="start_lat"/>
<input type="hidden" name="end_lat" id="end_lat"/>
<input type="hidden" name="start_long" id="start_long"/>
<input type="hidden" name="end_long" id="end_long"/>
<div class="clearfix"></div>
<?php
if (!empty($blocks['inner_bottom'])) {
    echo $blocks['inner_bottom'];
}
?>
<div class="clearfix"></div>
<?php
if (!empty($blocks['content_newsletter'])) {
    echo $blocks['content_newsletter'];
}
?>


<!--<script>
    (function ($) {
        $(window).on("load", function () {



            $(".order").mCustomScrollbar({
                setHeight: 430,
                theme: "dark-3"
            });
            $("get_value").mCustomScrollbar({
                setHeight: 180,
                theme: "dark-3"
            });


        });
    })(jQuery);
</script>-->


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
                $.ajax({
                    url: admin_url + '<?php echo '/getlattitude_longtitude'; ?>',
                    data: {'start_date': origin, 'end_date': destination},
                    dataType: 'json',
                    type: 'post',
                    success: function (output) {
                        var myLatLng = new google.maps.LatLng(0, 0);
                        var mapOptions = {
                            zoom: 2,
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

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB7xN19aOc0P7G4S9zP6N_uKywn7Vmeebs&callback=initMap">
</script>