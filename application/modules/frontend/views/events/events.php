<div class="about_webcame">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h5><a href="index.html">Home</a> <span class="coloum">|</span> <span>Program</span></h5>
			</div>
		</div>
	</div>
</div>

<div class="travel_program">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 travel_content">
				<h3>Swamiji-Travel Program</h3>
				<p>Tentative Tour Programme of Jeevanacharya, watch and get connected with his WAY OF LIFE</p>
				<div class="wrapper scrollbar-dynamic">
				<div class="bs-example">
					<table class="table table-bordered">
						<thead style="background-color: #390004;">
							<tr>
								<th>S.No</th>
								<th>Available Date</th>
								<th>Location</th>
								<th>Program and Destination</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
						 <?php 
			                $i = 1;
			                foreach ($records as $details): ?>
			                    <tr>
			                        <td><?php echo $i; ?></td>
			                        <td><?php echo $details['available_date']; ?></td>
			                        <td><?php echo $details['available_location']; ?></td>
			                        <td><?php echo "<strong>".$details['trip_name'] ."</strong>"; ?><br /><?php echo $details['plan_details']; ?></td>
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
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 travel_location" id="tvr">
				<h3>Location</h3>
				  <div id="map" style="height:300px">

       			 </div>
			</div>
		</div>
	</div>
</div>
<div class="event_booking_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
					
					
					<div class="clearfix"></div>
	<br><br>
			<div id="disqus_thread"></div>
			
			<div class="modal fade" id="events-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
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
<div class="clearfix"></div>
<div class="line_content"> <hr></div>
<div class="clearfix"></div>
<div class="news_letter">
	<div class="container">
		<div class="row" >
        	
            <?php echo $blocks['content_newsletter']; ?>
            
			
            
		</div>
	</div>
</div>
	

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
            url: admin_url + '<?php echo $module.'/getroute_by_map_id';?>',
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