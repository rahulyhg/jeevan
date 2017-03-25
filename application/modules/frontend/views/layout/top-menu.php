<nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-expand-toggle">
                            <i class="fa fa-bars icon"></i>
                        </button>
                      <ol class="breadcrumb navbar-breadcrumb">
                            <li class="active"><a href="<?php echo frontend_url().$module;?>"><?php echo $module_labels;?></a></li>
                          <?php if(isset($breadcrumb)) { ?>    <li class="active"><?php echo $breadcrumb;?></li> <?php }  ?>
                        </ol>
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-th icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <?php /*<button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
						<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-comments-o"></i></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="title">
                                    Notification <span class="badge pull-right">1</span>
                                </li>
                                <li class="message">
                                    No new notification
                                </li>
                            </ul>
                        </li> <?php */ ?>
                          <li class="dropdown danger">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-star-half-o"></i> <?php echo $this->session->userdata('user_credit_points');?> </a>
                            <ul class="dropdown-menu danger  animated fadeInDown">
                                <li class="title">
                                    Your Credit Points : <span class="pull-right"><?php echo $this->session->userdata('user_credit_points');?></span>
                                </li>
                                <li>
                                   <?php /* <ul class="list-group notifications">
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge">1</span> <i class="fa fa-exclamation-circle icon"></i> new registration
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge success">1</span> <i class="fa fa-check icon"></i> new orders
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge danger">2</span> <i class="fa fa-comments icon"></i> customers messages
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item message">
                                                view all
                                            </li>
                                        </a>
                                    </ul><?php */ ?>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown profile">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $this->session->userdata('user_name');?> <span class="caret"></span></a>
                            <ul class="dropdown-menu animated fadeInDown">
                               <li class="profile-img">
									<?php 
								       if($this->session->userdata('user_profile_image') != '')
									   {
									 
									?>
                                    <img src="<?php echo media_url().$this->session->userdata('user_folder_name')."/". get_label('user_folder_name')."/".$this->session->userdata('user_profile_image');?>" class="profile-img">
								<?php
									  }
									  else
									  {
								?>		
									<img src="<?php echo media_url().'no-user-photo.png';?>" class="profile-img">
								<?php }	?>								
                                </li> 
                                <li>
                                    <div class="profile-info">
                                        <h4 class="username"><?php echo $this->session->userdata('user_name');?></h4>
                                        <p><?php echo $this->session->userdata('user_email_address');?></p>
										<p>Your Referral Code [<?php echo $this->session->userdata('user_referral_code');?>]</p>
                                        <div class="btn-group margin-bottom-2x" role="group">
                                        
                                          <a href="<?php echo frontend_url().$module.'/edit/'.encode_value($this->session->userdata('user_id'));?>									  
										  " class="btn btn-default" ><i class="fa fa-user"></i> Profile</a>
                                            <a href="<?php echo frontend_url()."logout"?>" class="btn btn-default" ><i class="fa fa-sign-out"></i> Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>