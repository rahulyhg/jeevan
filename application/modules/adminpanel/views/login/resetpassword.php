<!DOCTYPE html>
<html>
<head>
    <title><?php  echo get_label('admin_title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='<?php echo  load_font('google_lato.css')?>' rel='stylesheet' type='text/css'>
    <link href='<?php echo  load_font('google_roboto_condensed.css')?>' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>font-awesome/font-awesome.min.css">
      <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>theme/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>theme/css/flat-blue.css">
    
     <link rel="stylesheet" type="text/css" href="<?php echo load_lib()?>theme/css/custom.css">
    <script>
      var ADMIN_URL =  "<?php echo admin_url();?>";
    </script>
</head>

<body class="flat-blue login-page">
    <div class="container">
        <div class="login-box">
            <div>
                <div class="login-form row">
                    <div class="col-sm-12 text-center login-header">
                      <?php /*?>  <i class="login-logo fa fa-connectdevelop fa-5x"></i> <?pph */?>
                       <h2>Admin Reset</h2>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="alert alert-danger log_alert" role="alert" style="display:none;">
</div>              
                        <div id="login_frm" style="">
                            <div class="login-body">
                                <div class="progress " id="login-progress" style="display:none;;">
                                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                        Reset Password...
                                    </div>
                                </div>

                                    <h2 class="login_title">Reset Password</h2>

                                   <?php echo form_open(admin_url('resetpassword/'.$key.''),'id="reset_form" autocomplete= "'.form_autocomplte().'" ');?>
										<input type="hidden" value="<?php echo $key; ?>" name="key">
                                        <div class="control">
                                         <?php echo  form_password('new_password','','class="form-control required" placeholder="New Password" minlength="'.PASSWORD_LENGHT.'" ');?>

                                        </div>
                                        
                                        <div class="control">
                                         <?php echo  form_password('confirm_password','','class="form-control required" placeholder="Confirm Password" minlength="'.PASSWORD_LENGHT.'" ');?>

                                        </div>
                                       
                                        <div class="login-button text-center">
                                        <?php echo form_submit('submit','Reset',' class="btn btn-info" id="reset_submit" ' )?>
                                           
                                        </div>
                                       
                                  <?php echo form_close();?>

                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Javascript Libs -->
    <script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="<?php echo load_lib()?>jquery/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo load_lib()?>bootstrap/js/bootstrap.min.js"></script>
     <script type="text/javascript" src="<?php echo admin_skin()?>js/login.js"></script>
  
</body>

</html>
