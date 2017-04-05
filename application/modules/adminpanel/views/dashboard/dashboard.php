<div class="side-body padding-top">
<div class="container">
	<div class="row">
    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<div class="col-md-3 col-sm-6 col-xs-12 widget">
            	<a href="<?php echo admin_url('events'); ?>">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-thumbs-up icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php echo $event[0]['event_count']; ?></strong></h5>
                      <span>Events</span>
                    </div>
                </div></a>
        	</div>
        	<div class="col-md-3 col-sm-6 col-xs-12 widget">
            	<a href="<?php echo admin_url('feedback'); ?>">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-users user1 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php echo $feedback[0]['feedback_count']; ?></strong></h5>
                      <span>Feedback</span>
                    </div>
                </div></a>
        	</div>
        	<div class="col-md-3 col-sm-6 col-xs-12 widget">
            	<a href="<?php echo admin_url('photooftheday'); ?>">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-comment user2 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php echo $photo_oftheday[0]['photo_oftheday_count']; ?></strong></h5>
                      <span>Photo Of the Day</span>
                    </div>
                </div></a>
        	</div>
        	<div class="col-md-3 col-sm-6 col-xs-12 widget">
            	<a href="<?php echo admin_url('cmspage'); ?>">
        		<div class="r3_counter_box">
                    <i class="pull-left fa fa-book dollar1 icon-rounded"></i>
                    <div class="stats">
                      <h5><strong><?php echo $cms_pages[0]['cms_pages_count']; ?></strong></h5>
                      <span>Pages</span>
                    </div>
                </div></a>
        	 </div>
        	<div class="clearfix"> </div>
      </div>
    </div>
    <div class="row">
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
</div>
</div>