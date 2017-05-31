<?php
if (!empty($blocks['inner_top'])) {
    echo $blocks['inner_top'];
}
?>
<div class="clearfix"></div>
<div class="left-siderbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                if (!empty($cms['page_description'])) {
                    echo $cms['page_description'];
                }
                ?>
                <?php
                $urlencode_address = urlencode($available_location);
                ?>
                
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                
				<?php
                if (!empty($blocks['inner_right'])) {
                    echo $blocks['inner_right'];
                }
				
                ?>
                
            </div>
            
        </div>
    </div>
    
</div>
	<div id="location_map" class="contact_map"></div>

<script>


      function initMap() {
        var uluru = {lat: 11.5657387, lng: 104.9193093};
        var map = new google.maps.Map(document.getElementById('location_map'), {
          zoom: 4,
          center: uluru
        });

        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h4 id="firstHeading" class="firstHeading">Cambodia Indian Association</h4>'+
            '<div id="bodyContent">'+
            '<p>IOC Building, No.254, Monivong Blvd, <br />' +
            'Corner St.109, 6th Floor, <br />'+
            'Room No.007, Phnom Penh, <br />'+
            'Cambodia.'+               
            '</div>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          title: 'Uluru (Ayers Rock)'
        });
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgt4YQGp9JWQhxOyzy4_JAFdvXKHMZ-Kw&callback=initMap"
  type="text/javascript"></script>

<div class="clearfix"></div>

<div class="line_content">
<hr /></div>
<?php
if (!empty($blocks['inner_bottom'])) {
    echo $blocks['inner_bottom'];
}
?>
<div class="clearfix"></div>
<?php 
if(!empty($blocks['content_newsletter'])){
echo $blocks['content_newsletter']; 
}
?>
