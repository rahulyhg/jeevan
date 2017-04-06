<style>
.card {
  display: inline-block;
  position: relative;
  width: 100%;
  margin: 25px 0;
  box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
  border-radius: 3px;
  color: rgba(0,0,0, 0.87);
  background: #fff;
}
.card .card-height-indicator {
  margin-top: 100%;
}
.card .title {
  margin-top: 0;
  margin-bottom: 5px;
}
.card .card-image {
  height: 60%;
  position: relative;
  overflow: hidden;
  margin-left: 15px;
  margin-right: 15px;
  margin-top: -30px;
  border-radius: 6px;
}
.card .card-image img {
  width: 100%;
  height: 100%;
  border-radius: 6px;
  pointer-events: none;
}
.card .card-image .card-title {
  position: absolute;
  bottom: 15px;
  left: 15px;
  color: #fff;
  font-size: 1.3em;
  text-shadow: 0 2px 5px rgba(33, 33, 33, 0.5);
}
.card .category:not([class*="text-"]) {
  color: #999999;
}
.card .card-content {
  padding: 15px 20px;
}
.card .card-content .category {
  margin-bottom: 0;
}
.card .card-header {
  box-shadow: 0 10px 30px -12px rgba(0, 0, 0, 0.42), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
  margin: -20px 15px 0;
  border-radius: 3px;
  padding: 15px;
  background-color: #999999;
}
.card .card-header .title {
  color: #FFFFFF;
}
.card .card-header .category {
  margin-bottom: 0;
  color: rgba(255, 255, 255, 0.62);
}
.card .card-header.card-chart {
  padding: 0;
  min-height: 160px;
}
.card .card-header.card-chart + .content h4 {
  margin-top: 0;
}
.card .card-header .ct-label {
  color: rgba(255, 255, 255, 0.7);
}
.card .card-header .ct-grid {
  stroke: rgba(255, 255, 255, 0.2);
}
.card .card-header .ct-series-a .ct-point,
.card .card-header .ct-series-a .ct-line,
.card .card-header .ct-series-a .ct-bar,
.card .card-header .ct-series-a .ct-slice-donut {
  stroke: rgba(255, 255, 255, 0.8);
}
.card .card-header .ct-series-a .ct-slice-pie,
.card .card-header .ct-series-a .ct-area {
  fill: rgba(255, 255, 255, 0.4);
}
.card .chart-title {
  position: absolute;
  top: 25px;
  width: 100%;
  text-align: center;
}
.card .chart-title h3 {
  margin: 0;
  color: #FFFFFF;
}
.card .chart-title h6 {
  margin: 0;
  color: rgba(255, 255, 255, 0.4);
}
.card .card-footer {
  margin: 0 20px 10px;
  padding-top: 10px;
  border-top: 1px solid #eeeeee;
}
.card .card-footer .content {
  display: block;
}
.card .card-footer div {
  display: inline-block;
}
.card .card-footer .author {
  color: #999999;
}
.card .card-footer .stats {
  line-height: 22px;
  color: #999999;
  font-size: 12px;
}
.card .card-footer .stats .material-icons {
  position: relative;
  top: 4px;
  font-size: 16px;
}
.card .card-footer h6 {
  color: #999999;
}
.card img {
  width: 100%;
  height: auto;
}
.card .category .material-icons {
  position: relative;
  top: 6px;
  line-height: 0;
}
.card .category-social .fa {
  font-size: 24px;
  position: relative;
  margin-top: -4px;
  top: 2px;
  margin-right: 5px;
}
.card .author .avatar {
  width: 30px;
  height: 30px;
  overflow: hidden;
  border-radius: 50%;
  margin-right: 5px;
}
.card .author a {
  color: #3C4858;
  text-decoration: none;
}
.card .author a .ripple-container {
  display: none;
}
.card .table {
  margin-bottom: 0;
}
.card .table tr:first-child td {
  border-top: none;
}
.card [data-background-color="purple"] {
  background: linear-gradient(60deg, #ab47bc, #8e24aa);
  box-shadow: 0 12px 20px -10px rgba(156, 39, 176, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(156, 39, 176, 0.2);
}
.card [data-background-color="blue"] {
  background: linear-gradient(60deg, #26c6da, #00acc1);
  box-shadow: 0 12px 20px -10px rgba(0, 188, 212, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(0, 188, 212, 0.2);
}
.card [data-background-color="green"] {
  background: linear-gradient(60deg, #66bb6a, #43a047);
  box-shadow: 0 12px 20px -10px rgba(76, 175, 80, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(76, 175, 80, 0.2);
}
.card [data-background-color="orange"] {
  background: linear-gradient(60deg, #ffa726, #fb8c00);
  box-shadow: 0 12px 20px -10px rgba(255, 152, 0, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(255, 152, 0, 0.2);
}
.card [data-background-color="red"] {
  background: linear-gradient(60deg, #ef5350, #e53935);
  box-shadow: 0 12px 20px -10px rgba(244, 67, 54, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(244, 67, 54, 0.2);
}
.card [data-background-color] {
  color: #FFFFFF;
}
.card [data-background-color] a {
  color: #FFFFFF;
}

.card-stats .title {
  margin: 0;
}
.card-stats .card-header {
  float: left;
  text-align: center;
}
.card-stats .card-header i {
  font-size: 36px;
  line-height: 56px;
  width: 56px;
  height: 56px;
}
.card-stats .card-content {
  text-align: right;
  padding-top: 10px;
}

.card-nav-tabs .header-raised {
  margin-top: -30px;
}
.card-nav-tabs .nav-tabs {
  background: transparent;
  padding: 0;
}
.card-nav-tabs .nav-tabs-title {
  float: left;
  padding: 10px 10px 10px 0;
  line-height: 24px;
}

.card-plain {
  background: transparent;
  box-shadow: none;
}
.card-plain .card-header {
  margin-left: 0;
  margin-right: 0;
}
.card-plain .content {
  padding-left: 5px;
  padding-right: 5px;
}
.card-plain .card-image {
  margin: 0;
  border-radius: 3px;
}
.card-plain .card-image img {
  border-radius: 3px;
}

.iframe-container {
  margin: 0 -20px 0;
}
.iframe-container iframe {
  width: 100%;
  height: 500px;
  border: 0;
  box-shadow: 0 10px 30px -12px rgba(0, 0, 0, 0.42), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}

.card-profile,
.card-testimonial {
  margin-top: 30px;
  text-align: center;
}
.card-profile .btn-just-icon.btn-raised,
.card-testimonial .btn-just-icon.btn-raised {
  margin-left: 6px;
  margin-right: 6px;
}
.card-profile .card-avatar,
.card-testimonial .card-avatar {
  max-width: 130px;
  max-height: 130px;
  margin: -50px auto 0;
  border-radius: 50%;
  overflow: hidden;
  box-shadow: 0 10px 30px -12px rgba(0, 0, 0, 0.42), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}
.card-profile .card-avatar + .content,
.card-testimonial .card-avatar + .content {
  margin-top: 15px;
}
.card-profile.card-plain .card-avatar,
.card-testimonial.card-plain .card-avatar {
  margin-top: 0;
}
.export-main{ display:none !important;}
</style>
<div class="side-body padding-top">

    		<div class="row">
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="orange">
									<i class="fa fa-thumbs-up"></i>
								</div>
								<div class="card-content">
									<p class="category">Events</p>
									<h3 class="title"><?php echo $event[0]['event_count']; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<a href="<?php echo admin_url('events'); ?>">View More</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="green">
									<i class="fa fa-users"></i>
								</div>
								<div class="card-content">
									<p class="category">Feedback</p>
									<h3 class="title"><?php echo $feedback[0]['feedback_count']; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<a href="<?php echo admin_url('feedback'); ?>">View More</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="red">
									<i class="fa fa-comment"></i>
								</div>
								<div class="card-content">
									<p class="category">Photo Of the Day</p>
									<h3 class="title"><?php echo $photo_oftheday[0]['photo_oftheday_count']; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<a href="<?php echo admin_url('photooftheday'); ?>">View More</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="blue">
									<i class="fa fa-book"></i>
								</div>
								<div class="card-content">
									<p class="category">Pages</p>
									<h3 class="title"><?php echo $cms_pages[0]['cms_pages_count']; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<a href="<?php echo admin_url('cmspage'); ?>">View More</a>
									</div>
								</div>
							</div>
						</div>
					</div>
           
        	<div class="clearfix"> </div>
     
    
    <div class="col-md-6">
    
    	<div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-bookmark"></span> Quick Shortcuts</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                          <a href="<?php echo admin_url('emailtemplates'); ?>" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>Email</a>
                          <a href="<?php echo admin_url('feedback'); ?>" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-bookmark"></span> <br/>Feedback</a>
                          <a href="<?php echo admin_url('newsletter'); ?>" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-signal"></span> <br/>Newsletter</a>
                          <a href="<?php echo admin_url('gallerycategories'); ?>" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-comment"></span> <br/>Media Gallery</a>
                        </div>
                        <div class="col-xs-6 col-md-6">
                          <a href="<?php echo admin_url('menugroups'); ?>" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Menus</a>
                          <a href="<?php echo admin_url('cmspage'); ?>" class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-file"></span> <br/>Pages</a>
                          <a href="<?php echo admin_url('blocks'); ?>" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-picture"></span> <br/>Blocks</a>
                          <a href="<?php echo admin_url('routeplan'); ?>" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-tag"></span> <br/>Route Plan</a>
                        </div>
                    </div>
                </div>
            </div>
    
    	<div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="fa fa-book"></span> Today Appointments</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="activity_box">
		        <div class="scrollbar">
                   
                   
                   <?php
				   if(!empty($appointments)){
					  
				   ?>
                   <div class="bs-example1 col-xs-12" data-example-id="contextual-table">
		    <table class="table">
		      <thead>
		        <tr>
		          <th>Event Name</th>
		          <th>User Name</th>
		          <th>Email</th>
		          <th>Phone</th>
                  <th>Appointment Date & Time</th>
		        </tr>
		      </thead>
              <?php
			   foreach($appointments as $appoint){
			  ?>
		      <tbody>
		        <tr class="active">
                  <td><?php echo $appoint['trip_name']; ?></td>
		          <td><?php echo $appoint['name']; ?></td>
		          <td><?php echo $appoint['email']; ?></td>
		          <td><?php echo $appoint['phone_no']; ?></td>
                  <td><?php echo $appoint['appointment_date'].' '.$appoint['appointment_start_time']; ?></td>
		        </tr>
		        
		      </tbody>
              <?php
			  }
			  ?>
		    </table>
		   </div>
                    <?php
					   
					}else{
						?>
                        <div class="activity-row">
                        <div class="col-xs-10 activity-desc">
                        	<h5>No Appointments</h5>
                        </div>
                        </div>
                        <?php
					}
					?>
	  		        </div>
		          </div>
            
                    </div>
                </div>
            </div>
    		
           
        
    </div>
    <div class="col-md-6">
  <?php $newsletter_chart = json_encode($newsletter); ?>
    <!-- Styles -->
	<style>
	.panel {margin-top:30px; }

#chartdiv {
	width		: 100%;
	height		: 400px;
	font-size	: 14px;
}							
</style>

<!-- Resources -->
<script src="<?php echo load_lib(); ?>theme/js/amcharts.js"></script>
<script src="<?php echo load_lib(); ?>theme/js/pie.js"></script>
<script src="<?php echo load_lib(); ?>theme/js/export.min.js"></script>
<link rel="stylesheet" href="<?php echo load_lib(); ?>theme/css/export.css" type="text/css" media="all" />
<script src="<?php echo load_lib(); ?>theme/js/none.js"></script>

<!-- Chart code -->
<script>
var chartData = <?php echo $newsletter_chart; ?>;
var chart = AmCharts.makeChart( "chartdiv", {
  "type": "pie",
  "theme": "none",
  "dataProvider": chartData,
  "titleField": "title",
  "valueField": "value",
  "labelRadius": 5,

  "radius": "42%",
  "innerRadius": "60%",
  "labelText": "[[title]]",
  "export": {
    "enabled": true
  }
} );
</script>
    
    <!-- HTML -->
    
    <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-bookmark"></span> Total Subscribe Charts</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div id="chartdiv"></div>
            
                    </div>
                </div>
            </div>
    
    
    
            
    </div>
    

</div>